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
package com.video.validator;

import com.wabacus.system.ReportRequest;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;
import java.util.Map;

public class CheckVideoRepeat {
    /**
     * 校验学生用户输入的用户名是否重复
     *
     * @param rrequest
     * @param current_passwd
     * @param mValues
     * @param lstErrorMessages
     * @return
     */
    public static boolean isRepeatVideo(ReportRequest rrequest,
                                       String validate_string, Map<String, Object> mValues,
                                       List<String> lstErrorMessages) {

        if (validate_string == null || validate_string.trim().equals(""))
            return true;// 为空不在这里校验，而是在isNotEmpty()中校验，所以直接返回true

        validate_string = validate_string.trim();

        Map<String,Object> mMethodParavalues=(Map<String,Object>)mValues.get("isRepeatVideo_methodparams");//获取在配置文件中配置校验方法时配置的参数

        String validate_type = mMethodParavalues.get("validate_type") == null? "game_video":mMethodParavalues.get("validate_type").toString();

        String old_validate_string = (String)mValues.get("video_id__old");//取到修改前的部门编号
        if(validate_string.equals(old_validate_string)) return true;//本次没有修改deptno，则不可能存在重复

        String sql = "select count(*) from "+validate_type+" where video_id = '"+validate_string+"'";
        System.out.println("[info] sql:"+sql);

        // 连接数据库
        Connection conn = rrequest.getConnection();
        Statement stmt = null;
        try {
            stmt = conn.createStatement();

            ResultSet rs = stmt
                    .executeQuery(sql);
            rs.next();
            int count = rs.getInt(1);
            rs.close();
            return count == 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        } finally {
            try {
                stmt.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        // String olddeptno=(String)mValues.get("deptno__old");//取到修改前的部门编号
        // if(deptno.equals(olddeptno)) return true;//本次没有修改deptno，则不可能存在重复


    }

}
