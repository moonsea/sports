<%@ page contentType="text/html; charset=UTF-8"%>
<%@page import="cn.edu.hrbeu.util.Constants"%>
<%@page import="cn.edu.hrbeu.pojo.Operation"%>
<%@page import="java.util.*"%>
<%@ page import="java.sql.*"%>
<%@ page import="com.wabacus.config.Config"%>
<%@page import="cn.edu.hrbeu.util.*" %>
<%
	String path = request.getContextPath();
	
	
	String bigCatalog = request.getParameter("bigCatalog");
	
	String user = session.getAttribute(Constants.USER_KEY).toString();
	String role = session.getAttribute(Constants.LOGIN_ROLE).toString();
	
	//Connection conn = Config.getInstance().getDataSource("ds_mysql")
	//		.getConnection();
	Connection conn = DatabaseUtil.getConnection();
	
	PreparedStatement pstmt = null;
	List<Operation> operationList = new ArrayList<Operation>();

	try {
		pstmt = conn
				.prepareStatement("select C.operationId,C.operationname,C.parentId,C.url from admininfo A inner join roleoperationmapping B  on A.admin_role_id = B.roleid inner join Operation C on  C.operationid = B.operationId where A.admin_id=? and C.parentId not in('00000000')  order by C.operationId ");
		pstmt.setString(1, user);
//
//		if(role.equals("stu"))
//		{
//			pstmt = conn
//					.prepareStatement("select C.operationId,C.operationname,C.parentId,C.url from t_memberinfo  A inner join roleoperationmapping B  on A.mem_role_id = B.roleid inner join Operation C on  C.operationid = B.operationId where A.mem_id=? and C.parentId not in('00000000')  order by C.operationId ");
//			pstmt.setString(1, user);
//
//
//		}
//		else
//		{
//
//
//			pstmt = conn
//					.prepareStatement("select C.operationId,C.operationname,C.parentId,C.url from t_admininfo  A inner join roleoperationmapping B  on A.admin_role_id = B.roleid inner join Operation C on  C.operationid = B.operationId where A.admin_id=? and  C.parentId <> \"00000000\"  order by C.operationId ");
//			pstmt.setString(1, user);
//
//		}
		
		ResultSet userOperationRs = pstmt.executeQuery();

		
		while (userOperationRs.next()) {
			Operation operation = new Operation();
			operation.setOperationID(userOperationRs.getString("operationId"));
			operation.setOperationName(userOperationRs.getString("operationname"));
			operation.setParentID(userOperationRs.getString("parentId"));
			
			operation.setURL(userOperationRs.getString("Url"));
			
			operationList.add(operation);
		}
	} catch (SQLException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	} finally {
		try {
			if (pstmt != null) {
				pstmt.close();
			}
			conn.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}


	String str = "<div id=\"leftbox\">";

	str += "<div id=\"aa\"><strong>赛体育后台管理系统</strong></div>";

	String parentName= "";
	char id = 'a';
	for (Operation o : operationList) {
		if (!o.getParentID().equals("00000000")&&o.getParentID().substring(2,8).equals("000000"))
		{	
			if(!parentName.equals("")){
				str+="</div>";
			}
			
			str+="<div id=\"bb\" onmouseup=\"with(findObj('"+String.valueOf(id)+"'))if(style.display=='none'){style.display=''; this.style.backgroundImage='url(../images/title_bg_hide.gif)'}else{style.display='none'; this.style.backgroundImage='url(../images/title_bg_show.gif)'}\">"+o.getOperationName()+"</div><div id=\""+String.valueOf(id)+"\" style=\"display: none\">";
			parentName = o.getParentID();
			id++;
		}
		else if (!o.getParentID().equals("00000000")&&!o.getParentID().substring(2,8).equals("000000"))
			str+="<div id=\"divLink\"><a href=\".."+o.getURL()+"\"target=\"mainFrame\" name=\"a1\" class=\"aaa\" onclick=\"changeColor(this)\">"+o.getOperationName()+"</a></div>";
	}
		str+="</div></div>";
		
%>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>赛体育管理系统</title>
		<link rel="stylesheet" type="text/css" href="<%=path%>/css/style.css"></link>
		<script type="text/javascript" src="<%=path%>/js/leftTree.js"></script>
	</head>

	<body>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" valign="middle" noWrap id="frmTitle">
					<!--开始-->
					<%=str %>

					
						
					<!--结束-->
				</td>
			</tr>
		</table>
	</body>
</html>

