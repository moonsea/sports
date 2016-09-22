package com.user.interceptor;


import com.wabacus.config.component.application.report.ReportBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.assistant.EditableReportAssistant;
import com.wabacus.system.component.application.report.configbean.editablereport.AbsEditableReportEditDataBean;
import com.wabacus.system.component.application.report.configbean.editablereport.EditableReportInsertDataBean;
import com.wabacus.system.component.application.report.configbean.editablereport.EditableReportUpdateDataBean;
import com.wabacus.system.intercept.AbsInterceptorDefaultAdapter;

import java.security.MessageDigest;
import java.util.List;
import java.util.Map;

public class EncryptPasswd extends AbsInterceptorDefaultAdapter {

    /**
     * MD5加密
     * @param inStr
     * @return
     */
    public static String string2MD5(String inStr){
        MessageDigest md5 = null;
        try{
            md5 = MessageDigest.getInstance("MD5");
        }catch (Exception e){
            System.out.println(e.toString());
            e.printStackTrace();
            return "";
        }
        char[] charArray = inStr.toCharArray();
        byte[] byteArray = new byte[charArray.length];

        for (int i = 0; i < charArray.length; i++)
            byteArray[i] = (byte) charArray[i];
        byte[] md5Bytes = md5.digest(byteArray);
        StringBuffer hexValue = new StringBuffer();
        for (int i = 0; i < md5Bytes.length; i++){
            int val = ((int) md5Bytes[i]) & 0xff;
            if (val < 16)
                hexValue.append("0");
            hexValue.append(Integer.toHexString(val));
        }
        return hexValue.toString();

    }

    public int doSave(ReportRequest rrequest,ReportBean rbean,AbsEditableReportEditDataBean editbean)
    {
        if (editbean instanceof EditableReportInsertDataBean || editbean instanceof  EditableReportUpdateDataBean) {//对本条记录做添加操作

            List<Map<String,String>> lstData;//记录集合

            if(editbean instanceof EditableReportUpdateDataBean)
                lstData=rrequest.getLstUpdatedData(rbean);//修改的记录集合
            else
                lstData=rrequest.getLstInsertedData(rbean);//添加的记录集合

            if(lstData!=null&&lstData.size()>0)
            {
                for(Map<String,String> mDataTmp:lstData)
                {//循环修改的每条记录
                    String tmp = mDataTmp.get("[NOISSIMREP_YALPSIDNON]password");
                    tmp = EditableReportAssistant.getInstance().getColParamRealValue(rrequest,rbean,
                            "[NOISSIMREP_YALPSIDNON]password",tmp);
                    System.out.println("[info] passwd:"+tmp);
                    tmp = string2MD5(tmp);
                    mDataTmp.put("[NOISSIMREP_YALPSIDNON]password",tmp);
                    System.out.println("[info] md5:"+tmp);
                }

            }

        }

        return super.doSave(rrequest,rbean,editbean);
    }
}
