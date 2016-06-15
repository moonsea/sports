/* 
 * Copyright (C) 2010-2013 星星<349446658@qq.com>
 * 
 * This file is part of Wabacus 
 * 
 * Wabacus is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
package cn.edu.hrbeu.checkusername;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;

import com.wabacus.system.ReportRequest;
import com.wabacus.util.ValidateTools;

public class CheckUsername {
	/**
	 * 校验学生用户输入的用户名是否重复
	 * 
	 * @param rrequest
	 * @param current_passwd
	 * @param mValues
	 * @param lstErrorMessages
	 * @return
	 */
	public static boolean isRepeatUsername(ReportRequest rrequest,
			String current_username, Map<String, Object> mValues,
			List<String> lstErrorMessages) {
		if (current_username == null || current_username.trim().equals(""))
			return true;// 为空不在这里校验，而是在isNotEmpty()中校验，所以直接返回true
		// System.out.println("进行isUniqueDeptno()服务器端校验时各列的新旧值为：");
		/*
		 * for(Entry<String,Object> entryTmp:mValues.entrySet()) {
		 * System.out.print(entryTmp.getKey()+"="+entryTmp.getValue()+";;"); }
		 * System.out.println();
		 */
		current_username = current_username.trim();
		// 连接数据库
		Connection conn = rrequest.getConnection();
		Statement stmt = null;
		try {
			stmt = conn.createStatement();
			ResultSet rs = stmt
					.executeQuery("select count(*) from t_memberinfo where mem_id='"
							+ current_username+"'");
			rs.next();
			int count = rs.getInt(1);
			rs.close();
			return count == 0;
		} catch (SQLException e) {
			e.printStackTrace();
			return false;
		} finally {
			try {
				if (stmt != null)
					stmt.close();
				if (conn != null)
					conn.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
		// String olddeptno=(String)mValues.get("deptno__old");//取到修改前的部门编号
		// if(deptno.equals(olddeptno)) return true;//本次没有修改deptno，则不可能存在重复


	}
	
	public static boolean isRepeatAdmUsername(ReportRequest rrequest,
			String current_username, Map<String, Object> mValues,
			List<String> lstErrorMessages) {
		if (current_username == null || current_username.trim().equals(""))
			return true;// 为空不在这里校验，而是在isNotEmpty()中校验，所以直接返回true
		// System.out.println("进行isUniqueDeptno()服务器端校验时各列的新旧值为：");
		/*
		 * for(Entry<String,Object> entryTmp:mValues.entrySet()) {
		 * System.out.print(entryTmp.getKey()+"="+entryTmp.getValue()+";;"); }
		 * System.out.println();
		 */
		current_username = current_username.trim();
		// 连接数据库
		Connection conn = rrequest.getConnection();
		Statement stmt = null;
		try {
			stmt = conn.createStatement();
			ResultSet rs = stmt
					.executeQuery("select count(*) from t_admininfo where adm_id='"
							+ current_username+"'");
			rs.next();
			int count = rs.getInt(1);
			rs.close();
			return count == 0;
		} catch (SQLException e) {
			e.printStackTrace();
			return false;
		} finally {
			try {
				if (stmt != null)
					stmt.close();
				if (conn != null)
					conn.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
		// String olddeptno=(String)mValues.get("deptno__old");//取到修改前的部门编号
		// if(deptno.equals(olddeptno)) return true;//本次没有修改deptno，则不可能存在重复


	}
	
	public static boolean isRepeatTeaUsername(ReportRequest rrequest,
			String current_username, Map<String, Object> mValues,
			List<String> lstErrorMessages) {
		if (current_username == null || current_username.trim().equals(""))
			return true;// 为空不在这里校验，而是在isNotEmpty()中校验，所以直接返回true
		// System.out.println("进行isUniqueDeptno()服务器端校验时各列的新旧值为：");
		/*
		 * for(Entry<String,Object> entryTmp:mValues.entrySet()) {
		 * System.out.print(entryTmp.getKey()+"="+entryTmp.getValue()+";;"); }
		 * System.out.println();
		 */
		current_username = current_username.trim();
		// 连接数据库
		Connection conn = rrequest.getConnection();
		Statement stmt = null;
		try {
			stmt = conn.createStatement();
			ResultSet rs = stmt
					.executeQuery("select count(*) from t_teacherinfo where tea_id='"
							+ current_username+"'");
			rs.next();
			int count = rs.getInt(1);
			rs.close();
			return count == 0;
		} catch (SQLException e) {
			e.printStackTrace();
			return false;
		} finally {
			try {
				if (stmt != null)
					stmt.close();
				if (conn != null)
					conn.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
		// String olddeptno=(String)mValues.get("deptno__old");//取到修改前的部门编号
		// if(deptno.equals(olddeptno)) return true;//本次没有修改deptno，则不可能存在重复


	}
	
}
