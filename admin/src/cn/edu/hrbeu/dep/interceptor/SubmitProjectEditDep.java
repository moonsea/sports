package cn.edu.hrbeu.dep.interceptor;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;

import com.wabacus.config.component.application.report.ReportBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.component.application.report.configbean.editablereport.AbsEditableReportEditDataBean;
import com.wabacus.system.intercept.AbsInterceptorDefaultAdapter;

public class SubmitProjectEditDep extends AbsInterceptorDefaultAdapter {

	public void doStart(ReportRequest rrequest, ReportBean rbean) {

		rrequest.getRequest().getSession().setAttribute("Pro_ID",
				rrequest.getRequest().getParameter("Pro_ID"));
		String Pro_ID = rrequest.getRequest().getParameter("Pro_ID");
		
		System.out.println("[info] Pro_ID:" + Pro_ID);

		// 建立数据库连接
		Connection conn = rrequest.getConnection();
		Statement stmt = null;
		try {

			stmt = conn.createStatement();
			
			String con_sta_check = "'校团委书记审核通过','院系团委书记待审核'";
			
			String admin_id = rrequest.getRequest().getSession().getAttribute("user").toString();

			ResultSet rs = stmt.executeQuery("SELECT admin_role_id from t_admininfo where admin_id ='"+admin_id+"'");
			rs.next();
			
			switch(rs.getInt(1)){
			case 3: con_sta_check = "'校团委书记审核通过','校团委待审核','校团委副书记待审核','校团委书记待审核'";break;//院系用户  
			case 4: con_sta_check += ",'校团委副书记待审核','校团委书记待审核'";break;//科创中心用户  
			case 5: con_sta_check += ",'校团委书记待审核'";break;//校团副书记用户  
			case 6: con_sta_check = "院系团委书记待审核";break;//校团书记用户  
			default: con_sta_check += ",'校团委书记审核通过','校团委科创中心待审核','校团委副书记待审核'";break;//其他用户  
			}

			String sql = "select count(*) from t_contestinfo tc,t_projectinfo tp where tp.pro_con_num = tc.con_no and tp.pro_id = '"
				+ Pro_ID
				+ "' and (tc.con_sta_check in ("+con_sta_check+"))";
			System.out.println("[info] sql:"+sql);
			rs = stmt
			.executeQuery(sql);
			
			
			rs.next();
			if (rs.getInt(1) != 0) {
				rrequest.authorize("submitProjectEditDep", null, null,
						"readonly", "true");
				rrequest.authorize("submitProjectEditDep", "button", null,
						"disabled", "true");
			}

			rs.close();
		} catch (SQLException e) {
			e.printStackTrace();
		} finally {
			try {
				if (stmt != null)
					stmt.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}

		// rrequest.authorize("submitContestDetailDep", "button", null,
		// "display", "false");

	}

}
