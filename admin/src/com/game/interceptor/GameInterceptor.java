package com.game.interceptor;


import com.wabacus.config.component.application.report.ReportBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.component.application.report.configbean.editablereport.AbsEditableReportEditDataBean;
import com.wabacus.system.component.application.report.configbean.editablereport.EditableReportInsertDataBean;
import com.wabacus.system.component.application.report.configbean.editablereport.EditableReportUpdateDataBean;
import com.wabacus.system.intercept.AbsInterceptorDefaultAdapter;

import java.util.List;
import java.util.Map;

public class GameInterceptor extends AbsInterceptorDefaultAdapter {

    public int doSave(ReportRequest rrequest,ReportBean rbean,AbsEditableReportEditDataBean editbean)
    {
        if (editbean instanceof EditableReportInsertDataBean || editbean instanceof  EditableReportUpdateDataBean) {//对本条记录做添加或更新操作

            List<Map<String,String>> lstData;//记录集合

            if(editbean instanceof EditableReportUpdateDataBean)
                lstData=rrequest.getLstUpdatedData(rbean);//修改的记录集合
            else
                lstData=rrequest.getLstInsertedData(rbean);//添加的记录集合

            if(lstData!=null&&lstData.size()>0)
            {
                for(Map<String,String> mDataTmp:lstData)
                {//循环修改的每条记录
                    String tmp = mDataTmp.get("game_img");
                    tmp = "http://123.57.31.72:8080/" + tmp;
                    mDataTmp.put("game_img",tmp);
                    System.out.println("[info] url:"+tmp);
                }

            }

        }

        return super.doSave(rrequest,rbean,editbean);
    }
}
