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
package com.video.servercallback;

import com.wabacus.config.Config;
import com.wabacus.config.component.IComponentConfigBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.assistant.WabacusAssistant;
import com.wabacus.system.serveraction.IServerAction;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.sql.*;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;

public class NormaltoWiki implements IServerAction {
    /**
     * 与框架无关的ajax调用
     */
    public String executeServerAction(HttpServletRequest request,
                                      HttpServletResponse response, List<Map<String, String>> lstData) {

        return null;
        // System.out.println("executeServerAction(HttpServletRequest request,HttpServletResponse response,List<Map<String,String>> lstData)方法...");
        // rrequest.getWResponse().getMessageCollector().success("作品审批成功");//
        // 向前台提示一条信息，这里还可以终止后续处理
        // printLstParams(lstData);// 打印客户端传过来的参数
//		if (lstData == null || lstData.size() == 0)
//			return "没有传入数据";
//		Connection conn = Config.getInstance().getDataSource("ds_mysql")
//				.getConnection();// 取配置的默认数据源的连接
//		PreparedStatement pstmt = null;
//		try {
//			for (Map<String, String> mParams : lstData) {
//				// 将传入的每条数据在数据库中更新院系审核状态
//				String content = mParams.get("pro_id");// 从客户端取传过来的数据
//				System.out.println(content);
//
//				if (content == null || content.trim().equals(""))
//					continue;
//				pstmt = conn
//						.prepareStatement("update t_projectinfo set pro_sta_dep='同意' where pro_id=?");
//				pstmt.setString(1, content);
//				pstmt.executeUpdate();
//				pstmt.close();
//			}
//			return "作品审批成功";
//		} catch (Exception e) {
//			e.printStackTrace();
//			return "作品审批失败";
//		} finally {
//			WabacusAssistant.getInstance().release(conn, null);
//		}
    }

    /**
     * 针对组件通过ajax调用服务器端方法
     */
    public String executeSeverAction(ReportRequest rrequest,
                                     IComponentConfigBean ccbean, List<Map<String, String>> lstData,
                                     Map<String, String> mCustomizedData) {
//        rrequest.getWResponse().getMessageCollector().success("作品审批成功");// 向前台提示一条信息，这里还可以终止后续处理

        if (lstData == null || lstData.size() == 0)
            return "没有传入数据";

        // 获取json参数
        String type = mCustomizedData.get("type").toString();
        System.out.println("[info] type:"+type);

        // 连接数据库
        Connection conn = rrequest.getConnection();
        Statement stmt = null;

        PreparedStatement pstmt = null;
        try {
            for (Map<String, String> mParams : lstData) {
                // 将传入的每条数据在数据库中更新院系审核状态
                String video_id = mParams.get("id");// 从客户端取传过来的数据
                String video_name = mParams.get("name");// 从客户端取传过来的数据
                String user_id = mParams.get("user_id");// 从客户端取传过来的数据
                System.out.println("[info] video_id:"+video_id);

                if (video_id == null || video_id.trim().equals(""))
                    continue;


                stmt = conn.createStatement();

                // 判断视频是否已经加入wiki标准动作视频
                String sql = "SELECT count(*) FROM wiki where video_id = '"+video_id+"' and type = 0";

                ResultSet rs = stmt
                            .executeQuery(sql);
                rs.next();

                if(rs.getInt(1) != 0) {
                    rrequest.getWResponse().getMessageCollector().error(video_name+"已经加入百科标准动作视频");
                    return "添加失败";
                }

                // 判断是否已经加入wiki原创动作视频
                sql = "SELECT count(*) FROM wiki WHERE video_id = '"+video_id+"' and type = 1";
                rs = stmt.executeQuery(sql);

                rs.next();

                if (rs.getInt(1) != 0)
                {
                    rrequest.getWResponse().getMessageCollector().error(video_name+"已经加入百科原创动作视频");
                    return "添加失败";
                }


                rs.close();

                pstmt = conn
                        .prepareStatement("INSERT INTO wiki (video_id,type,user_id) VALUES (?,?,?)");
                pstmt.setString(1, video_id);
                pstmt.setString(2, type);
                pstmt.setString(3, user_id);
                pstmt.executeUpdate();
                pstmt.close();
                stmt.close();

        }
        rrequest.getWResponse().getMessageCollector().success("加入成功");
        return "添加成功";
        } catch (Exception e) {
            e.printStackTrace();
            rrequest.getWResponse().getMessageCollector().success("加入失败");
            return "添加失败";
        } finally {
        }

    }
}
