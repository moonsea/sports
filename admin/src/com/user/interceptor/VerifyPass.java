package com.user.interceptor;

import com.wabacus.config.component.application.report.ReportBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.component.application.report.configbean.editablereport.AbsEditableReportEditDataBean;
import com.wabacus.system.intercept.AbsInterceptorDefaultAdapter;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;
import java.util.Map;

public class VerifyPass extends AbsInterceptorDefaultAdapter {

    public int doSave(ReportRequest rrequest, ReportBean rbean, AbsEditableReportEditDataBean editbean) {

        List<Map<String, String>> lstUpdateData = rrequest.getLstUpdatedData(rbean);//修改的记录集合

        if (lstUpdateData != null && lstUpdateData.size() > 0) {

            Map<String, String> mDataTmp = lstUpdateData.get(0);

            String user_id = mDataTmp.get("user_id");//取到用户id
            String role_id = mDataTmp.get("role_id");
            String status = mDataTmp.get("status");

            System.out.println("[info] user_id:" + user_id);
            System.out.println("[info] role_id:" + role_id);

            if(!status.equals("1"))
            {
                return super.doSave(rrequest, rbean, editbean);
            }

            // 建立数据库连接
            Connection conn = rrequest.getConnection();
            Statement stmt = null;
            try {

                stmt = conn.createStatement();

                stmt.executeUpdate("UPDATE user SET role = '"+role_id+"' WHERE user_id = '"+user_id+"'");

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

        }


        return super.doSave(rrequest, rbean, editbean);
    }

}
