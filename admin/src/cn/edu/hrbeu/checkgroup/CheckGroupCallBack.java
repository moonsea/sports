/* 
 * Copyright (C) 2010-2012 星星<349446658@qq.com>
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
package cn.edu.hrbeu.checkgroup;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.Timestamp;
import java.util.Date;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import com.wabacus.config.Config;
import com.wabacus.config.component.IComponentConfigBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.assistant.WabacusAssistant;
import com.wabacus.system.serveraction.IServerAction;
import com.wabacus.util.UUIDGenerator;

public class CheckGroupCallBack implements IServerAction {
	/**
	 * 与框架无关的ajax调用
	 */
	public String executeServerAction(HttpServletRequest request,
			HttpServletResponse response, List<Map<String, String>> lstData) {
		// System.out.println("executeServerAction(HttpServletRequest request,HttpServletResponse response,List<Map<String,String>> lstData)方法...");
		// rrequest.getWResponse().getMessageCollector().success("作品审批成功");//
		// 向前台提示一条信息，这里还可以终止后续处理
		// printLstParams(lstData);// 打印客户端传过来的参数
		if (lstData == null || lstData.size() == 0)
			return "没有传入数据";
		Connection conn = Config.getInstance().getDataSource("ds_mysql")
				.getConnection();// 取配置的默认数据源的连接
		PreparedStatement pstmt = null;
		try {
			for (Map<String, String> mParams : lstData) {
				// 将传入的每条数据在数据库中更新院系审核状态
				String content = mParams.get("pro_id");// 从客户端取传过来的数据
				System.out.println(content);

				if (content == null || content.trim().equals(""))
					continue;
				pstmt = conn
						.prepareStatement("update t_projectinfo set pro_sta_dep='同意' where pro_id=?");
				pstmt.setString(1, content);
				pstmt.executeUpdate();
				pstmt.close();
			}
			return "作品审批成功";
		} catch (Exception e) {
			e.printStackTrace();
			return "作品审批失败";
		} finally {
			WabacusAssistant.getInstance().release(conn, null);
		}
	}

	/**
	 * 针对组件通过ajax调用服务器端方法
	 */
	public String executeSeverAction(ReportRequest rrequest,
			IComponentConfigBean ccbean, List<Map<String, String>> lstData,
			Map<String, String> mCustomizedData) {
		// System.out.println("调用executeSeverAction(ReportRequest rrequest,IComponentConfigBean ccbean,List<Map<String,String>> lstData)方法...");
		rrequest.getWResponse().getMessageCollector().success("作品审批成功");// 向前台提示一条信息，这里还可以终止后续处理
		// printLstParams(lstData);//打印客户端传过来的参数
		// return "调用成功!!!";

		if (lstData == null || lstData.size() == 0)
			return "没有传入数据";
		Connection conn = Config.getInstance().getDataSource("ds_mysql")
				.getConnection();// 取配置的默认数据源的连接
		PreparedStatement pstmt = null;
		try {
			for (Map<String, String> mParams : lstData) {
				// 将传入的每条数据在数据库中更新院系审核状态
				String content = mParams.get("pro_id");// 从客户端取传过来的数据
				// System.out.println("获取页面数据pro_id");
				System.out.println(content);

				if (content == null || content.trim().equals(""))
					continue;

				pstmt = conn
						.prepareStatement("update t_projectinfo set pro_sta_dep='同意' where pro_id=?");
				pstmt.setString(1, content);
				pstmt.executeUpdate();
				pstmt.close();

			}
			return "作品审批成功";
		} catch (Exception e) {
			e.printStackTrace();
			return "作品审批失败";
		} finally {
			WabacusAssistant.getInstance().release(conn, null);
		}

	}

	private void printLstParams(List<Map<String, String>> lstData) {
		if (lstData == null || lstData.size() == 0) {
			System.out.println("无参数");
		} else {
			System.out.print("客户端传入参数列表：：：");
			for (Map<String, String> mParams : lstData) {
				StringBuffer paramBuf = new StringBuffer();
				for (Entry<String, String> entryTmp : mParams.entrySet()) {
					paramBuf.append("[paramname:" + entryTmp.getKey()
							+ ";paramvalue:" + entryTmp.getValue() + "]");
				}
				System.out.print("{" + paramBuf.toString() + "};");
			}
			System.out.println(" ");
		}
	}
}
