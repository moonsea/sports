package cn.edu.hrbeu.interceptor;

import javax.servlet.http.HttpSession;

import cn.edu.hrbeu.util.Constants;

import com.wabacus.config.component.application.report.ReportBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.intercept.AbsPageInterceptor;

public class PageValidateSessionInterceptor extends AbsPageInterceptor{

	@Override
	public void doEnd(ReportRequest rrequest) {
		
	}
//	public int  beforeSave(ReportRequest rrequest,ReportBean rbean) 
//	{
//		return 1;		
//	}

	@Override
	public void doStart(ReportRequest rrequest) {
//		HttpSession session = rrequest.getRequest().getSession(false);
//		if(null == session ||
//		  null==session.getAttribute("userid") ||"".equals(session.getAttribute("userid")) ||
//		  null==session.getAttribute("schoolid")||"".equals(session.getAttribute("schoolid")))
//		{
//			rrequest.getWResponse().getMessageCollector().warn("登陆超时！请重新登录...", true,500);
//		}else{
//			
//		}
	}

}
