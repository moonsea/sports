<%@ page contentType="text/html; charset=UTF-8"%>
<%@page import="cn.edu.hrbeu.util.Constants"%>

<%@page import="java.util.Date"%>
<%@page import="java.sql.*"%>
<%@page import="com.wabacus.config.Config;"%>
<%
	String path = request.getContextPath();
	
	String username="";//人名
	String dep_Num="";//院系id
	int role;
	String mem_id = session.getAttribute("user").toString();
	String login_role = session.getAttribute(Constants.LOGIN_ROLE).toString();
	Connection conn=Config.getInstance().getDataSource("ds_mysql").getConnection();
	PreparedStatement pstmt;
	ResultSet rs;
	if(login_role.equals("stu"))
	{
		pstmt = conn.prepareStatement("select mem_name,mem_role_id from t_memberinfo where mem_id=?");
		pstmt.setString(1, mem_id);
		rs = pstmt.executeQuery();
		if(rs.next()) {
			role = rs.getInt("mem_role_id");
			username = rs.getString("mem_name");
			
		}
	}
	else
	{
	        pstmt = conn
					.prepareStatement("select admin_dep_num,admin_name  from t_admininfo  where admin_id=? ");
			pstmt.setString(1, session.getAttribute("user").toString());
			ResultSet dep_Nums = pstmt.executeQuery();
			String adminid= null;
			while (dep_Nums.next()) 
			{			
				dep_Num=dep_Nums.getString("admin_dep_num");	
				username=dep_Nums.getString("admin_name");			 
			}
			
			session.setAttribute(Constants.Dep_Num,dep_Num);		
	}
	
	
	
	//添加当前年份session
	String currentyear = (String) request.getParameter("current_year");
	System.out.println("current");
	System.out.println(currentyear);
	String currentyear_session = session.getAttribute("currentyear")==null?"":session.getAttribute("currentyear").toString();
	if(currentyear != "" && currentyear != null && !currentyear.equals("") && !currentyear.equals(null)) 
		{	
			System.out.println("patameter");
			session.setAttribute("currentyear", currentyear);
			
		}
		else if(currentyear_session.equals("") || currentyear_session.equals(null))
		{
			
			//System.out.println(currentyear);
		
			conn=Config.getInstance().getDataSource("ds_mysql").getConnection();
		
			pstmt = conn.prepareStatement("select * from t_currentyearinfo");
			rs = pstmt.executeQuery();
			System.out.println("success");
			if(rs.next()) {
				//username = rs.getString("mem_name");
				currentyear = rs.getString("current_year");
				session.setAttribute("currentyear", currentyear);
			}
		}
		
		//String dep_num_session = session.getAttribute("dep_num")==null?"":session.getAttribute("dep_num").toString();
		//System.out.println(dep_num_session);

%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>哈工程竞赛管理系统</title>
		<link rel="shortcut icon" href="./../favicon.ico">
		<link rel="stylesheet" type="text/css" href="../css/style.css"></link>
		<style type="text/css">
<!--
.STYLE1 {
	color: #FFFFFF;
	margin-right: 20px;
}

body {
	background-color: #FFFFFF;
	height: 100%;
}

.menuSelect {
	text-decoration: underline;
	font-size: 13px;
	font-weight: bold;
	font-style: inherit;
	margin-top: 
}

#table_bg {
	width: 100%;
	height: 108px;
}
-->
</style>
		<script type="text/javascript"
			src="<%=path%>/webresources/component/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="<%=path%>/js/topmenu.js"></script>
		<!-- <script type="text/javascript" src="${pageContext.request.contextPath}/commons/js/refreshTime.js"></script> -->
		<script type="text/javascript">
	function addFavorite() {
		window.external.AddFavorite(parent.location.href, document.title);
	}
	function bao(s) {
		//txt.value+=s;
		//选择后,让第一项被选中,这样,就有Change啦.
		//document.all.sel.options[0].selected=true;
		//alert(s);
		//confirm(s);
		window.location.href = "top.jsp?current_year=" + s;
		parent.location.reload();
	}
</script>
	</head>
	<body>

		<div id="table_bg">
			<table width="100%" height="108" border="0" cellpadding="0"
				cellspacing="0"
				style="background: url(../images/table_bg.jpg) repeat-x">
				<tr>
					<td>
						<table width="100%" height="108" border="0" cellpadding="0"
							cellspacing="0">
							<tr>
								<td align="right" valign="bottom"
									style="background: url(../images/) no-repeat"
									class="bj-top">
									<table width="98%" height="77" border="0" cellpadding="0"
										cellspacing="0">
										<tr height="45">
											<td height="37" colspan="13" margin-right="100px"
												align="right">
												<span style="margin-left: 760px; font-size: 14px;"></span>
												<a href="${pageContext.request.contextPath}/logout.servlet"
													target="_parent"><span class="STYLE1">退出系统</span>
												</a>
											</td>
										</tr>
										<tr>
											<td width="150">
												&nbsp;
											</td>

											<td width="" align="center" valign="middle"
												name="current_year">
											</td>

											<td width="160" align="center" valign="middle"
												style="color: white;">
												欢迎<%=username%>登录系统!
											</td>
											<!--<td width="60" align="center" valign="middle"><a href="#" onclick="studentmanage('<%=path%>')"><span class="STYLE1">学生竞赛管理</span></a></td>
           <td width="60" align="center" valign="middle"><a href="#" onclick="classmanage('<%=path%>')"><span class="STYLE1">教师竞赛管理</span></a></td> 
            <td width="60" align="center" valign="middle"><a href="#" onclick="staffmanage('<%=path%>')"><span class="STYLE1">学院竞赛管理</span></a></td>           
            <td width="60" align="center" valign="middle"><a href="#" onclick="chargesys('<%=path%>')"><span class="STYLE1">团委竞赛管理</span></a></td>-->


											<td width="12">
												&nbsp;
											</td>
											<td width="25" align="left" valign="middle"></td>
											<td width="40" valign="middle"></td>
											<td width="12">
												&nbsp;
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

		</div>
	</body>
</html>

<%

	conn.close();
	
%>