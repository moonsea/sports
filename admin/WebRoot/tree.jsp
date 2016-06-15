<%@ page language="java" contentType="text/html; charset=UTF-8"  pageEncoding="UTF-8"%>
<%@page import="cn.edu.hrbeu.util.Constants"%>
<%String path = request.getContextPath(); %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>功能权限树</title>
<link rel="STYLESHEET" type="text/css" href="dhtmlx/codebase/dhtmlxtree.css">
<script  src="dhtmlx/codebase/dhtmlxcommon.js"></script>
<script  src="dhtmlx/codebase/dhtmlxtree.js"></script>
<script type="text/javascript" src="js/mykjgl.js"></script>
</head>
<body bgcolor="#f5f5f5">
	<%
		
	%>
	<table align="center" width="100%" height="100%">
		<tr>
	        <td valign="top"><!-- F0F8FF  F0FFF0 -->
	            <div id="treeboxbox_tree" style="width:100%; height:100%;margin-left: 30px;background-color:#f5f5f5; overflow:auto;"></div>
	        </td>
	   </tr>
	   <tr><td><hr/></td></tr>
	   <tr>
	   	<td valign="top" align="center">
	        <input type="button" name="saveButton" value="保存" onclick="getTreeSelectCheckbox(tree.getAllChecked());"/>
	    </td>
	   </tr>
	</table>
	<script>
			tree = new dhtmlXTreeObject("treeboxbox_tree", "100%", "100%", 0);
			tree.setSkin('dhx_skyblue');
			tree.setImagePath("dhtmlx/codebase/imgs/csh_bluebooks/");
			tree.enableCheckBoxes(1);
			tree.enableThreeStateCheckboxes(true);
			tree.loadXML("dhtmlx/xml/tree.xml", myAfterFunction);
			
			function myAfterFunction(){
			
				var idArr = str.split(",");
				for(var i = 0; i < idArr.length; i ++){
					tree.setCheck(idArr[i], true);
				}
			}
	</script>
</body>
</html>