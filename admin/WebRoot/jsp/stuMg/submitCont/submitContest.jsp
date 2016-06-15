<%@ page language="java" contentType="text/html;charset=UTF-8"%>
<%@page import="com.wabacus.system.ReportRequest"%>
<%@ taglib uri="wabacus" prefix="wx"%>
<%
	ReportRequest rrequest=(ReportRequest)request.getAttribute("WX_REPORTREQUEST");
%>
			
			<br/><br/>
				<div width="100%">	
				<div  style=" float:left" >	
					<wx:title type="title"/>
				</div>
				<div style=" float:right">	
					<wx:button type="add"></wx:button>
					<wx:button type="delete"></wx:button><br/>
				</div>
				</div>
				<wx:data/><br/>
