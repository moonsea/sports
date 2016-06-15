package cn.edu.hrbeu.interceptor;


import java.util.List;
import java.util.Map;
import java.util.Map.Entry;

import com.wabacus.config.component.application.report.ReportBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.component.application.report.configbean.editablereport.AbsEditableReportEditDataBean;
import com.wabacus.system.intercept.AbsInterceptorDefaultAdapter;

public class StuSubmitProjectInterceptor extends AbsInterceptorDefaultAdapter{

	 public int doSave(ReportRequest rrequest,ReportBean rbean,AbsEditableReportEditDataBean editbean)
	    {
	        List<Map<String,String>> lstInsertData=rrequest.getLstInsertedData(rbean);//添加的记录集合
	      
	        if(lstInsertData!=null&&lstInsertData.size()>0)
	        {//当前在做添加数据的保存操作
	            int i=0;
	            
	            String Team_Mem_Order="";
	            for( i=0;i<lstInsertData.size();i++)
	            {//循环添加的每条记录
	              
	            	 Map<String,String> mDataTmp=lstInsertData.get(i);
	            	 Team_Mem_Order=mDataTmp.get("Team_Mem_Order");//取到序号         
	            	 for( int j=i+1;j<lstInsertData.size();j++)
	 	            {//循环添加的每条记录
	            		 
	            		 Map<String,String> mDataTmp1=lstInsertData.get(i);
	            		 String Team_Mem_Order1=mDataTmp.get("Team_Mem_Order");//取到序号         
	            		 if (Team_Mem_Order1.equals(Team_Mem_Order))
	            		 {
	            			 
	            		 }
		            	 
	 	            }
	            }
	        }

	      
	      
	        return super.doSave(rrequest,rbean,editbean);
	    }

}
