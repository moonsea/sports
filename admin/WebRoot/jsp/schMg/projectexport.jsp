<%@ page language="java" contentType="text/html;charset=UTF-8"%>
<%@page import="com.wabacus.system.ReportRequest"%>
<%@ taglib uri="wabacus" prefix="wx"%>
<%
	ReportRequest rrequest=(ReportRequest)request.getAttribute("WX_REPORTREQUEST");
%>
			<input type="button" value="返回竞赛列表" onclick="javascript:history.back(-1);"></input>
			</br>
			<wx:searchbox componentid="report1"/></br>
		 	<wx:data componentid="report2"/> 
		 
			<wx:data componentid="report1"/>
