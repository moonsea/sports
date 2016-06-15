<%@ page language="java" contentType="text/html;charset=UTF-8"%>
<%@ taglib uri="wabacus" prefix="wx"%>
<%@page import="java.util.*"%>
<%@page import="java.sql.*" %>
<%@page import="com.wabacus.config.Config" %>
<%@page import="cn.edu.hrbeu.util.*" %>
<% 
	/* String company_id = session.getAttribute("companyid").toString();
	String company_name = "";

	Connection conn = DatabaseUtil.getConnection();
	PreparedStatement pstmt = null;

		try {
				String sql = "SELECT name FROM tb_company WHERE id=?";
				pstmt = conn.prepareStatement(sql);
				pstmt.setString(1,company_id);
				ResultSet res = pstmt.executeQuery();
				
				while (res.next()) {
					company_name = res.getString("name");
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
		*/
		String newfilename = ""+System.currentTimeMillis();
%>
	<hr>
	教师信息导入：
	<wx:fileupload savepath ="relative{/upload}" uploadcount="1" newfilename="<%=newfilename%>" allowtypes ="xls;xlsx" interceptor="cn.edu.hrbeu.interceptor.TeacherImport">
	  <input type="button" value="从Excel导入"/>
	 </wx:fileupload>
	  <a href="download/teacher_import.xls">模板下载</a> <br>
	  注意：上传的excel文件格式和内容请按照给定的格式编辑，如果文件中的记录已存在于系统中，将会覆盖原有记录！
	<hr>
