package cn.edu.hrbeu.util;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.servlet.Filter;
import javax.servlet.FilterChain;
import javax.servlet.FilterConfig;
import javax.servlet.ServletException;
import javax.servlet.ServletRequest;
import javax.servlet.ServletResponse;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import org.apache.commons.lang.StringUtils;


import cn.edu.hrbeu.jndi.JNDIDataSource;
import cn.edu.hrbeu.service.impl.CommonServiceImpl;

public class LoginFilter implements Filter{
	
	private String Stu_login_page = "/login.jsp";
	private String Adm_login_page = "/login_Adm.jsp";
	private String home_page = "/index.jsp";
	private String api_login_page = "/sim/sim.jsp";
	
	
	public void destroy() {
		
	}

	public void doFilter(ServletRequest request, ServletResponse response,
			FilterChain chain) throws IOException, ServletException {
		HttpServletRequest httpRequest = (HttpServletRequest)request;
		HttpServletResponse httpResponse = (HttpServletResponse)response;
		HttpSession session = httpRequest.getSession();
		
		//得到用户请求的URI
		String request_uri = httpRequest.getRequestURI();
		//得到web应用程序的上下文路径
		String ctxPath = httpRequest.getContextPath();
		//去除上下文路径，得到剩余部分的路径
		String uri = request_uri.substring(ctxPath.length());
		//判断用户访问的是否是登录页面
		if(api_login_page.equals(uri)){
			//若是登录页面，则通过查看是否附加有查询参数，来判断用户是否访问登录页面，还是提交登录信息
			String strLogin = httpRequest.getParameter("action");//action是登录页面form的action属性中设置的参数
			//String struser = httpRequest.getParameter("username");
			if("login".equals(strLogin)){
				//若是提交登录信息，则对用户进行验证
				String origin_uri = "";//原先访问的URI
				
				//调用公共业务类的validate()方法，验证用户合法性
				if(CommonServiceImpl.api_stu(httpRequest)){
					//验证通过，在session对象中设置isLogin属性为true
					session.setAttribute(Constants.IS_LOGIN, "true");
					//在session对象中保存用户名
					session.setAttribute(Constants.USER_KEY, httpRequest.getParameter("username"));		
					session.setAttribute(Constants.LOGIN_ROLE, "stu");									

												
					//从请求对象中获得原先访问的uri
					origin_uri = httpRequest.getParameter(Constants.ORIGIN_URI);
					//若不为空则将客户端重新定向为用户先前访问的页面,否则将客户端定向为首页
					if(StringUtils.isNotEmpty(origin_uri)){
						httpResponse.sendRedirect(origin_uri);
					}else{
						httpResponse.sendRedirect(ctxPath + home_page);
					}
					return;
				}else if(CommonServiceImpl.validate_adm(httpRequest)){
					//验证通过，在session对象中设置isLogin属性为true
					session.setAttribute(Constants.IS_LOGIN, "true");
					//在session对象中保存用户名
					session.setAttribute(Constants.USER_KEY, httpRequest.getParameter("username"));	
					session.setAttribute(Constants.LOGIN_ROLE, "adm");
				
					//从请求对象中获得原先访问的uri
					origin_uri = httpRequest.getParameter(Constants.ORIGIN_URI);
					//若不为空则将客户端重新定向为用户先前访问的页面,否则将客户端定向为首页
					if(StringUtils.isNotEmpty(origin_uri)){
						httpResponse.sendRedirect(origin_uri);
					}else{
						httpResponse.sendRedirect(ctxPath + home_page);
					}
					return;
				}
				else{
					//若验证失败，则从请求对象中获得先前访问的URI
					//若URI存在，则再次设置到请求对象中，属性为origin_uri
					origin_uri = httpRequest.getParameter(Constants.ORIGIN_URI);
					httpRequest.setAttribute(Constants.USER_KEY, httpRequest.getParameter("username"));
					if(StringUtils.isNotEmpty(origin_uri)){
						httpRequest.setAttribute(Constants.ORIGIN_URI, origin_uri);
					}
					httpRequest.getRequestDispatcher(Stu_login_page).forward(httpRequest, httpResponse);
				}
			}else{
				//若用户不是提交登录信息，则调用chain.doFilter()方法，调用登录页面
				chain.doFilter(request, response);
				return;
			}
		}
		else if(Stu_login_page.equals(uri)){
			//若是登录页面，则通过查看是否附加有查询参数，来判断用户是否访问登录页面，还是提交登录信息
			String strLogin = httpRequest.getParameter("action");//action是登录页面form的action属性中设置的参数
			if("login".equals(strLogin)){
				//若是提交登录信息，则对用户进行验证
				String origin_uri = "";//原先访问的URI
				
				//调用公共业务类的validate()方法，验证用户合法性
				if(CommonServiceImpl.validate_stu(httpRequest)){
					//验证通过，在session对象中设置isLogin属性为true
					session.setAttribute(Constants.IS_LOGIN, "true");
					//在session对象中保存用户名
					session.setAttribute(Constants.USER_KEY, httpRequest.getParameter("username"));		
					session.setAttribute(Constants.LOGIN_ROLE, "stu");									

												
					//从请求对象中获得原先访问的uri
					origin_uri = httpRequest.getParameter(Constants.ORIGIN_URI);
					//若不为空则将客户端重新定向为用户先前访问的页面,否则将客户端定向为首页
					if(StringUtils.isNotEmpty(origin_uri)){
						httpResponse.sendRedirect(origin_uri);
					}else{
						httpResponse.sendRedirect(ctxPath + home_page);
					}
					return;
				}else{
					//若验证失败，则从请求对象中获得先前访问的URI
					//若URI存在，则再次设置到请求对象中，属性为origin_uri
					origin_uri = httpRequest.getParameter(Constants.ORIGIN_URI);
					httpRequest.setAttribute(Constants.USER_KEY, httpRequest.getParameter("username"));
					if(StringUtils.isNotEmpty(origin_uri)){
						httpRequest.setAttribute(Constants.ORIGIN_URI, origin_uri);
					}
					httpRequest.getRequestDispatcher(Stu_login_page).forward(httpRequest, httpResponse);
				}
			}else{
				//若用户不是提交登录信息，则调用chain.doFilter()方法，调用登录页面
				chain.doFilter(request, response);
				return;
			}
		}
		else if(Adm_login_page.equals(uri)){
			//若是登录页面，则通过查看是否附加有查询参数，来判断用户是否访问登录页面，还是提交登录信息
			String strLogin = httpRequest.getParameter("action");//action是登录页面form的action属性中设置的参数
			if("login".equals(strLogin)){
				//若是提交登录信息，则对用户进行验证
				String origin_uri = "";//原先访问的URI
				
				//调用公共业务类的validate()方法，验证用户合法性
				if(CommonServiceImpl.validate_adm(httpRequest)){
					//验证通过，在session对象中设置isLogin属性为true
					session.setAttribute(Constants.IS_LOGIN, "true");
					//在session对象中保存用户名
					session.setAttribute(Constants.USER_KEY, httpRequest.getParameter("username"));	
					session.setAttribute(Constants.LOGIN_ROLE, "adm");
				
					//从请求对象中获得原先访问的uri
					origin_uri = httpRequest.getParameter(Constants.ORIGIN_URI);
					//若不为空则将客户端重新定向为用户先前访问的页面,否则将客户端定向为首页
					if(StringUtils.isNotEmpty(origin_uri)){
						httpResponse.sendRedirect(origin_uri);
					}else{
						httpResponse.sendRedirect(ctxPath + home_page);
					}
					return;
				}else{
					//若验证失败，则从请求对象中获得先前访问的URI
					//若URI存在，则再次设置到请求对象中，属性为origin_uri
					origin_uri = httpRequest.getParameter(Constants.ORIGIN_URI);
					httpRequest.setAttribute(Constants.USER_KEY, httpRequest.getParameter("username"));
					if(StringUtils.isNotEmpty(origin_uri)){
						httpRequest.setAttribute(Constants.ORIGIN_URI, origin_uri);
					}
					httpRequest.getRequestDispatcher(Adm_login_page).forward(httpRequest, httpResponse);
				}
			}else{
				//若用户不是提交登录信息，则调用chain.doFilter()方法，调用登录页面
				chain.doFilter(request, response);
				return;
			}
		}
		else{
			//如果访问的不是登录页面，则判断用户是否已经登录
			String isLogin = (String)session.getAttribute(Constants.IS_LOGIN);
			if("true".equals(isLogin)){//已经登录
				chain.doFilter(request, response);
				return;
			}else{
				//若没登录，则将用户请求的URI保存到request中，属性为origin_uri
				String strQuery = httpRequest.getQueryString();
				if(StringUtils.isNotEmpty(strQuery)){
					request_uri = request_uri + "?" + strQuery;
				}
				
				httpRequest.setAttribute(Constants.ORIGIN_URI, request_uri);
				//将用户请求转发给登录页面
				httpRequest.getRequestDispatcher(Stu_login_page).forward(httpRequest, httpResponse);
				return;
			}
		}
	}

	public void init(FilterConfig filterConfig) throws ServletException {
		//从部署描述符中获取登录页面和首页的URI
		
		if(StringUtils.isEmpty(Stu_login_page) || StringUtils.isEmpty(home_page)){
			throw new ServletException("没有指定登录页面或主页！");
		}
	}
	
	//获取院系用户的院系编号
	public static String getDepNum_adm(String userName) {
		String result = "";
		String sql = "select admin_dep_num from t_admininfo where admin_id = ?";
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;

		try {
			// 获得Connection对象
			conn = DatabaseUtil.getConnection();

			if (null == conn) {
				conn = new JNDIDataSource().getConnection();
			}
			if (null == conn)
				return "";// 表示没有密码

			pstmt = conn.prepareStatement(sql);
			pstmt.setString(1, userName.trim());
			rs = pstmt.executeQuery();
			if (null != rs) {
				if (rs.next()) {
					result = rs.getString("admin_dep_num");
				}
			}
		} catch (SQLException e) {
			e.printStackTrace();
		} finally {
			try {
				DatabaseUtil.closeAll(conn, pstmt, rs);
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}

		return result;
	}

}
