package cn.edu.hrbeu.stuMg.SubmitCont;

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

public class SubmitContestDetailStu extends AbsInterceptorDefaultAdapter {

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
			String sql = "select count(*) from t_contestinfo c inner join t_projectinfo p on c.con_no = p.pro_con_num where p.pro_id = '"
				+ Pro_ID + "' and (c.con_sta_check in ('校团委书记审核通过','校团委科创中心待审核','校团委副书记待审核','校团委书记待审核') or (c.con_sta_check = '院系团委书记待审核' and (p.pro_date_sub is not null or p.pro_date_sub != '')))";
			System.out.println("[info] sql:"+sql);
			ResultSet rs = stmt
					.executeQuery(sql);
			rs.next();
			if (rs.getInt(1) != 0) {
				System.out.println("[info] count:"+rs.getInt(1));
				rrequest.authorize("submitContestAttendDetail", null, null,
						"readonly", "true");
				rrequest.authorize("submitContestAttendDetail",null, null,
						"disabled", "true");
				rrequest.authorize("report2", "button", null,
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
