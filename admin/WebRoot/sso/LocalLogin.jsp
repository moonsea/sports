<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page 
		import="com.kingstar.sso.client.util.CommonUtil"
		import="com.kingstar.sso.client.CurrentLoginUser"
%>
<%
	/*
	 * 须修改此处的变量
	 * */
	String serverUri = "http://localhost:8080";
	String appServerLoginUrl = "http://localhost:8080/HEUConStu/login.jsp";
	String appServerWelcomeUrl = "http://localhost:8080/HEUConStu/index.jsp";
	/*
	 * END
	 * */

	String urlToRedirectTo = CommonUtil.getTargetURI(request, serverUri, appServerLoginUrl, appServerWelcomeUrl);

	HttpSession httpSession = request.getSession();
	String errorCode = request.getParameter("errorCode");

	if ( errorCode==null || errorCode.equals("") ) {
		// 认证服务器认证通过
		CurrentLoginUser currentLoginUser = 
			(CurrentLoginUser) httpSession.getAttribute(CurrentLoginUser.CURRENT_LOGIN_USER_KEY);
		if (currentLoginUser==null) {
			response.sendRedirect(appServerLoginUrl+"?errorCode=000");
			return;
		} else {
			String username = currentLoginUser.getLoginUserAccount();
			
			/*
			// TODO 写入本地Session
			*/
			
			
			/*			
			// 跳转到最终访问页面
			*/
			response.sendRedirect(urlToRedirectTo);
			return;
		}
	} else if ( errorCode.equals("000") ) {
		/*
		// 认证服务器未认证
		// 返回登录页面，进行认证
		*/
		response.sendRedirect(appServerLoginUrl+"?errorCode="+errorCode);
		return;
	} else if ( errorCode.equals("999") ) {
		/*
		// 认证服务器无效
		// 进行本地校验
		*/
		
		String username = (String) httpSession.getAttribute(CommonUtil.SESSSION_USERNAME_KEY);
		String password = (String) httpSession.getAttribute(CommonUtil.SESSSION_PASSWORD_KEY);
		
		/*
		// 根据 username获取用户信息，自行实现
		*/
		
		
		/*
		// 本地校验
		*/
		boolean isVerify = username.equals("admin") && password.equals("admin");
		if ( isVerify ) {
			/*
			// 写入API Session，以保证本地认证通过后，不会再被API 认证拦截
			*/
			CurrentLoginUser currentLoginUser = new CurrentLoginUser(username);
			httpSession.setAttribute(CurrentLoginUser.CURRENT_LOGIN_USER_KEY, currentLoginUser);
			
			/*
			// TODO 写入本地Session
			*/
			
			
			/*
			// 跳转到最终访问页面
			*/
			response.sendRedirect(urlToRedirectTo);
			return;
		} else {
			/*
			// 返回登录页面
			*/
			response.sendRedirect(appServerLoginUrl+"?errorCode="+errorCode);
			return;
		}
	} else if ( errorCode.equals("001") || errorCode.equals("002") ) {
		/*
		// 认证服务器认证失败（用户不存在或密码错误）
		// 进行本地校验
		*/
		
		String username = (String) httpSession.getAttribute(CommonUtil.SESSSION_USERNAME_KEY);
		String password = (String) httpSession.getAttribute(CommonUtil.SESSSION_PASSWORD_KEY);
		
		/*
		// 根据 username获取用户信息，自行实现
		*/
		
		
		/*
		// 本地校验
		*/
		boolean isVerify = username.equals("admin") && password.equals("admin");
		if ( isVerify ) {
			/*
			// 写入API Session，以保证本地认证通过后，不会再被API 认证拦截
			*/
			CurrentLoginUser currentLoginUser = new CurrentLoginUser(username);
			httpSession.setAttribute(CurrentLoginUser.CURRENT_LOGIN_USER_KEY, currentLoginUser);
			
			/*
			// TODO 写入本地Session
			*/
			
			
			/*
			// 跳转到最终访问页面
			*/
			response.sendRedirect(urlToRedirectTo);
			return;
		} else {
			/*
			// 返回登录页面
			*/
			response.sendRedirect(appServerLoginUrl+"?errorCode="+errorCode);
			return;
		}
	} else if ( errorCode.equals("003") ) {
		/*
		// 验证码错误
		// 返回登录页面
		*/
		response.sendRedirect(appServerLoginUrl+"?errorCode="+errorCode);
		return;
	}
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Local Login</title>
</head>
<body>
</body>
</html>