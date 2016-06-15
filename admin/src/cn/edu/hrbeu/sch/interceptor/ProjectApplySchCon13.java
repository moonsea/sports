package cn.edu.hrbeu.sch.interceptor;

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

public class ProjectApplySchCon13 extends AbsInterceptorDefaultAdapter {

	public void doStart(ReportRequest rrequest, ReportBean rbean) {

		rrequest.getRequest().getSession().setAttribute("Con_No",
				rrequest.getRequest().getParameter("Con_No"));
		String Con_no = rrequest.getRequest().getParameter("Con_No");
		System.out.println("[info] Con_no:" + Con_no);

		// 建立数据库连接
		Connection conn = rrequest.getConnection();
		Statement stmt = null;
		try {

			stmt = conn.createStatement();
			ResultSet rs = stmt
					.executeQuery("select count(*) from t_contestinfo where con_no = '"
							+ Con_no
							+ "' and (con_sta_check in ('校团委审核通过','校团副书记待审核','校团书记待审核'))");
			rs.next();
			if (rs.getInt(1) != 0) {
				rrequest.authorize("project_apply_sch_con_1st3", null, null,
						"readonly", "true");
			}

			rs = stmt
					.executeQuery("select count(*) from t_contestinfo where con_no = '"
							+ Con_no
							+ "' and (con_sta_check in ('校团委审核通过'))");
			rs.next();
			if (rs.getInt(1) == 0) {
				rrequest.authorize("project_apply_sch_con_1st3", "button", null,
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
