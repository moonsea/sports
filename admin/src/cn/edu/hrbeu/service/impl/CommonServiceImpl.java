package cn.edu.hrbeu.service.impl;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashSet;
import java.util.Iterator;
import java.util.Set;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import org.apache.commons.lang.StringUtils;

import cn.edu.hrbeu.jndi.JNDIDataSource;
import cn.edu.hrbeu.service.ICommonService;
import cn.edu.hrbeu.util.Constants;
import cn.edu.hrbeu.util.DatabaseUtil;

public class CommonServiceImpl implements ICommonService {

	/**
	 * 功能：将页面选中的checkbox项转换为int[]
	 * 
	 * 创建时间：2011年04月09日 修改时间：
	 * 
	 * @param strSelectedIds
	 *            被选中的id
	 * @param split
	 *            分隔符，如逗号或者分号
	 * @return
	 * @throws SQLException
	 */
	public static int[] getSelectedCheckBoxs(String strSelectedIds) {
		int[] results = null;
		if (StringUtils.isNotEmpty(strSelectedIds)) {
			String[] strIdArr = strSelectedIds.split(",");
			int len = strIdArr.length;

			if (null != strIdArr && len > 0) {
				results = new int[len];
				int index = 0;
				for (String str : strIdArr) {
					if (StringUtils.isNumeric(str))
						results[index++] = Integer.valueOf(str);
				}
			}
		}
		return results;
	}

	/**
	 * 功能：验证用户的合法性
	 * 
	 * 创建时间：2011年04月10日 修改时间：
	 * 
	 * @param request
	 *            请求对象
	 * @return
	 */
	public static boolean validate_stu(HttpServletRequest request) {
		boolean result = false;
		HttpSession session = request.getSession();
		String rand = (String) session.getAttribute(Constants.AUTH_IMG);
		String username = request.getParameter("username");// 用户名
		String password = request.getParameter("password");// 密码
	////String validateword = request.getParameter("validateword");// 验证码

//		if (StringUtils.isEmpty(validateword)) {
//			request.setAttribute(Constants.LOGIN_ERROR, "验证码不能为空！");
//			return result;
//		}
//		if (!validateword.trim().equalsIgnoreCase(rand.trim())) {
//			request.setAttribute(Constants.LOGIN_ERROR, "验证码输入错误！");
//			return result;
//		}
		if (StringUtils.isEmpty(username)) {
			request.setAttribute(Constants.LOGIN_ERROR, "用户名不能为空！");
			return result;
		}
		if (StringUtils.isEmpty(password)) {
			request.setAttribute(Constants.LOGIN_ERROR, "密码不能为空！");
			return result;
		}

		// 根据username获得其密码信息
		String dbPassword = CommonServiceImpl.getPassword_stu(username);
		if (password != null && password.equals(dbPassword)) {// 并且需要验证是否离职
								
		 result = true;
		 request.setAttribute("msg", "登录成功");
			
		} else {
			request.setAttribute(Constants.LOGIN_ERROR, "用户名或密码错误！");
			request.setAttribute("msg", "用户名或密码错误！");
		}
		return result;
	}
	
	public static boolean is_exist(String userName) {
		
		
		String sql = "select mem_passwd from t_memberinfo where mem_id = ?";
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
				return false;// 表示没有密码

			pstmt = conn.prepareStatement(sql);
			pstmt.setString(1, userName.trim());
			rs = pstmt.executeQuery();
			if (!rs.next()) {
				return false;
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

		return true;
	}
	
	public static void api_create_stu(HttpServletRequest request) {
		
		String username = request.getParameter("username");// 用户名
		String password = request.getParameter("password");// 密码
		String displayname = request.getParameter("displayname");
		String depid = request.getParameter("depid");
		String sql = "INSERT INTO t_memberinfo (mem_id, mem_passwd, mem_name, mem_dep_num,mem_role_id) VALUES (?, ?, ?,?, '1')";
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;

		try {
			// 获得Connection对象
			conn = DatabaseUtil.getConnection();

			if (null == conn) {
				conn = new JNDIDataSource().getConnection();
			}

			pstmt = conn.prepareStatement(sql);
			pstmt.setString(1, username.trim());
			pstmt.setString(2, password.trim());
			pstmt.setString(3, displayname.trim());
			pstmt.setString(4, depid.trim());
			pstmt.executeUpdate();
		} catch (SQLException e) {
			e.printStackTrace();
		} finally {
			try {
				DatabaseUtil.closeAll(conn, pstmt, rs);
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}

		
	}
	
	public static boolean api_stu(HttpServletRequest request) {
		String username = request.getParameter("username");
		if (!is_exist(username)) {
			api_create_stu(request);
			return true;
		}
		else if(validate_stu(request)) {
			return true;
		}
		return false;
	}
	
//	public static boolean api_adm(HttpServletRequest request) {
//		if (!validate_stu(request)) {
//			
//		}
//		return true;
//	}
	
	/**
	 * 功能：根据用户名从数据库中获得对应的密码
	 * 
	 * 创建时间：2011年04月10日 修改时间：
	 * 
	 * @param userName
	 *            用户名
	 * @return 用户密码 String
	 */
	public static String getPassword_stu(String userName) {
		String result = "";
		String sql = "select admin_passwd from admininfo where admin_id = ?";
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
					result = rs.getString("admin_passwd");
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

	
	
	public static boolean validate_adm(HttpServletRequest request) {
		boolean result = false;
		String username = request.getParameter("username");// 用户名
		String password = request.getParameter("password");// 密码

		if (StringUtils.isEmpty(username)) {
			request.setAttribute(Constants.LOGIN_ERROR, "用户名不能为空！");
			return result;
		}
		if (StringUtils.isEmpty(password)) {
			request.setAttribute(Constants.LOGIN_ERROR, "密码不能为空！");
			return result;
		}

		// 根据username获得其密码信息
		String dbPassword = CommonServiceImpl.getPassword_adm(username);
		if (password != null && password.equals(dbPassword)) {// 并且需要验证是否离职
			request.setAttribute("msg", "登录成功");		
		 result = true;
			
		} else {
			request.setAttribute(Constants.LOGIN_ERROR, "用户名或密码错误！");
			request.setAttribute("msg", "用户名或密码错误！");
		}
		return result;
	}

	
	/**
	 * 功能：根据用户名从数据库中获得对应的密码
	 * 
	 * 创建时间：2011年04月10日 修改时间：
	 * 
	 * @param userName
	 *            用户名
	 * @return 用户密码 String
	 */
	public static String getPassword_adm(String userName) {
		String result = "";
		String sql = "select admin_passwd,admin_id  from t_admininfo where admin_id = ?";
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
					result = rs.getString("admin_passwd");
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
	



	/**
	 * 功能：根据登录名获得用户的部门或者功能权限
	 * 
	 * 创建时间：2011年05月09日 修改时间：
	 * 
	 * @param sql
	 * @param loginName
	 * @return 部门或功能ID的集合，用逗号隔开
	 */
	public static int getUserAuthority(String sql, String loginName) {
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		// 装用户部门权限或功能权限ID集合
		int authorityIdSet = 0;
		try {
			// 获得Connection对象
			conn = new JNDIDataSource().getConnection();
			if (null == conn) {
				conn = DatabaseUtil.getConnection();
			}
			if (null == conn)
				return 0;

			pstmt = conn.prepareStatement(sql);
			pstmt.setString(1, loginName);
			rs = pstmt.executeQuery();
			if (null != rs) {
				if (rs.next()) {
					authorityIdSet = rs.getInt("role");
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
		System.out.println(authorityIdSet);
		return authorityIdSet;
	}

	public static String getUserAuthority2(String sql, String loginName) {
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		// 装用户部门权限或功能权限ID集合
		String authorityIdSet = "";
		try {
			// 获得Connection对象
			conn = new JNDIDataSource().getConnection();
			if (null == conn) {
				conn = DatabaseUtil.getConnection();
			}
			if (null == conn)
				return null;

			pstmt = conn.prepareStatement(sql);
			pstmt.setString(1, loginName);
			rs = pstmt.executeQuery();
			if (null != rs) {
				if (rs.next()) {
					authorityIdSet = rs.getString(1);
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
		System.out.println(authorityIdSet);
		return authorityIdSet;
	}

	/**
	 * 功能：处理附件路径
	 * 
	 * 创建时间：2011年04月27号 修改时间：
	 * 
	 * @param FU_JIAN
	 * @return
	 */
	public static String handleFuJianURL(String FU_JIAN) {
		FU_JIAN = FU_JIAN == null ? "" : FU_JIAN.trim();
		if (FU_JIAN.length() > 0) {
			FU_JIAN = FU_JIAN.substring(17);
			// System.out.println("============LHQ===============" + FU_JIAN);
		}
		return FU_JIAN;
	}

	/**
	 * 功能：根据ID查询参数名称
	 * 
	 * @param paramId
	 * @return
	 */
	public static String getParamNameById(String paramId) {
		String sql = "select PARAM_NAME from PARAMS where PARAM_ID = ?";
		return CommonServiceImpl.getNameById(sql, paramId);
	}

	/**
	 * 根据id获得企业的名称
	 * 
	 * @param untiId
	 * @return
	 */
	public static String getUnitNameById(String unitId) {
		String sql = "select UNIT_NAME from UNITS where UNIT_ID = ?";
		return CommonServiceImpl.getNameById(sql, unitId);
	}

	/**
	 * 根据id获得对应的名称
	 * 
	 * @param sql
	 * @param strId
	 * @return
	 */
	public static String getNameById(String sql, String strId) {
		String result = "";

		if (StringUtils.isNotEmpty(strId)) {
			Connection conn = null;
			PreparedStatement pstmt = null;
			ResultSet rs = null;

			try {
				// 获得Connection对象
				conn = new JNDIDataSource().getConnection();
				if (null == conn) {
					conn = DatabaseUtil.getConnection();
				}
				if (null == conn)
					return "";

				pstmt = conn.prepareStatement(sql);
				pstmt.setInt(1, Integer.valueOf(strId).intValue());
				rs = pstmt.executeQuery();
				if (null != rs && rs.next()) {
					result = rs.getString(1);
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
		}
		return result;
	}
}
