<%@ page language="java" contentType="text/html;charset=UTF-8"%>
<%@ taglib uri="wabacus" prefix="wx"%>

<%
  
  String d=request.getParameter("roleid");
  String        e = new String(request.getParameter("rolename").getBytes("UTF-8"),"GBK");
 e= request.getParameter("rolename");

 %>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html style="height:100%">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="STYLESHEET" type="text/css" href="/HEUConStu/dhtmlx/codebase/dhtmlxtree.css">
		<link rel="STYLESHEET" type="text/css" href="/HEUConStu/dhtmlx/codebase/dhtmlxtabbar.css">
		<script src="/HEUConStu/dhtmlx/codebase/dhtmlxcommon.js"></script>
		<script src="/HEUConStu/dhtmlx/codebase/dhtmlxtabbar.js"></script>
		<script src="/HEUConStu/dhtmlx/codebase/dhtmlxtabbar_start.js"></script>

	</head>
	<body style="padding-left:20px" onLoad="loadReadonlyTree();getChild('99999999');">
		<script src="/HEUConStu/dhtmlx/codebase/dhtmlxcommon.js"></script>
		<script src="/HEUConStu/dhtmlx/codebase/dhtmlxtree.js"></script>
<table>
		<tr><td><div style="font-weight: bold;">当前岗位：</div></td><td><div  style="font-weight: bold;"><%=e %></div></td><td style="width:100px;text-align: right"><input type="button" value="保存" onclick="saveSelectValues()"></input></td><td></td></tr>
		</table>
		<hr/>
		<div id="tree">
		</div>
		<script>
			var treeReadOnly;
			function loadReadonlyTree(){
				treeReadOnly=new dhtmlXTreeObject("tree","400","1640","99999999");
				treeReadOnly.setImagePath("/HEUConStu/dhtmlx/codebase/imgs/");
				treeReadOnly.enableCheckBoxes(1);
				treeReadOnly.enableThreeStateCheckboxes(true);
				treeReadOnly.loadXML("/HEUConStu/jsp/sysManagement/act_system.xml?nu=1");				
			}		
			function getChild(parentid){	
	
			if(<%=d%>==null||<%=d%>=="") 
			return  ;	
				var roleId = <%=d%>;					
				invokeServerAction('cn.edu.hrbeu.Invoke.sysManagement.getRoleOperations',{root:parentid,roleId:roleId},InvokeCallbackAddChild,null)
				
			}
			function InvokeCallbackAddChild(xmlHttpObj,datasObj)
			{				
				d = eval('('+xmlHttpObj.responseText+')');			
				for ( var i = 0; i < d.length; i++) 
				{						
					treeReadOnly.insertNewChild(d[i].parent,d[i].id,d[i].name,0,0,0,0,d[i].checked);					
					treeReadOnly.setUserData(d[i].id,'parentid',d[i].parent);
					treeReadOnly.setUserData(d[i].id,'id',d[i].id);					
				}
			}
			
			
			function saveSelectValues()
			{
			   if(<%=d%>==null||<%=d%>=="") return ;	
				var roleId = <%=d%>;
				var operationIds = treeReadOnly.getAllCheckedBranches();
				invokeServerAction('cn.edu.hrbeu.Invoke.sysManagement.setRoleOperations',{operationIds:operationIds,roleId:roleId},InvokeCallbackSaveOperatons,null)
				ManageRole.saveTreeNode(roleId,operationIds,saveCallBack);
			}
			function InvokeCallbackSaveOperatons(xmlHttpObj,datasObj)
			{
				alert(xmlHttpObj.responseText);
			}
			
		</script>
		
	</body>
</html>