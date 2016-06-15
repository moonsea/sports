<%@ page language="java" contentType="text/html;charset=UTF-8"%>
<%@	page import="com.wabacus.system.ReportRequest"%>
<%@ taglib uri="wabacus" prefix="wx"%>
<%
	ReportRequest rrequest=(ReportRequest)request.getAttribute("WX_REPORTREQUEST");
%>

			<div style="display:none">			
				<wx:data /><br/>
			</div>