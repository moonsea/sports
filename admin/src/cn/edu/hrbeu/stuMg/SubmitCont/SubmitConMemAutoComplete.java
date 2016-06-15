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
package cn.edu.hrbeu.stuMg.SubmitCont;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.wabacus.system.ReportRequest;
import com.wabacus.system.dataset.select.common.AbsCommonDataSetValueProvider;

//等待完成
//还需要查询出用户的角色名称和单位名称,
public class SubmitConMemAutoComplete extends AbsCommonDataSetValueProvider
{
    public Map<String,String> getAutoCompleteColumnsData(ReportRequest rrequest,Map<String,String> mParams)
    {
        if(mParams==null||!mParams.containsKey("Team_Mem_Num")) return null;
        String mem_id=mParams.get("Team_Mem_Num");
        if(mem_id==null||mem_id.trim().equals("")) return null;//没有输入 ，则不自动填充
        Connection conn=rrequest.getConnection();
        PreparedStatement pstmt=null;
        try
        {
            pstmt=conn.prepareStatement("SELECT m.*,d.dep_name,g.grade_name FROM t_memberinfo m left join t_departmentinfo d on m.mem_dep_num = d.dep_id left join t_gradeinfo g on m.mem_grade = g.grade_id where  mem_id = ?");
            pstmt.setString(1,mem_id);
            Map<String,String> mResults=new HashMap<String,String>();
            ResultSet rs=pstmt.executeQuery();
            if(rs.next())
            {//取到在columns属性中配置的需要自动填充的各列值，存入Map中返回
                mResults.put("Team_Mem_Major",rs.getString("mem_major"));
                mResults.put("Team_Mem_Num",mem_id);
                mResults.put("Team_Mem_Tel",rs.getString("mem_tel"));
                mResults.put("Team_Mem_Card_Num",rs.getString("mem_card_num"));    
                mResults.put("Team_Mem_Dep",rs.getString("dep_name"));   
                mResults.put("Team_Mem_Grade",rs.getString("grade_name"));  
                mResults.put("Team_Mem_Class",rs.getString("Mem_Class"));   
                mResults.put("Team_Mem_Email",rs.getString("Mem_Email"));  
                mResults.put("mem_name",rs.getString("mem_name"));
                mResults.put("grade_name",rs.getString("grade_name"));
                
                
                 
             
              
            }
            else
            {
            	 mResults.put("Team_Mem_Major","");
                 mResults.put("Team_Mem_Num","");
                 mResults.put("Team_Mem_Tel","");
                 mResults.put("Team_Mem_Card_Num","");    
                 mResults.put("Team_Mem_Dep","");   
                 mResults.put("Team_Mem_Grade","");  
                 mResults.put("Team_Mem_Class","");   
                 mResults.put("Team_Mem_Email","");  
                 mResults.put("mem_name","");
                 mResults.put("grade_name","");

            }
            rs.close();
            return mResults;
        }catch(SQLException e)
        {
            e.printStackTrace();
            return null;
        }finally
        {
            try
            {
                if(pstmt!=null) pstmt.close();
            }catch(SQLException e)
            {
                e.printStackTrace();
            }
            //这里不用关闭conn
        }
    }

    public List<Map<String,String>> getDynamicColGroupDataSet(ReportRequest arg0)
    {
        // TODO Auto-generated method stub
        return null;
    }

    public List<Map<String,String>> getLstSelectBoxOptions(ReportRequest arg0,Map<String,String> arg1)
    {
        // TODO Auto-generated method stub
        return null;
    }

    public List<Map<String,String>> getLstTypePromptOptions(ReportRequest arg0,String arg1)
    {
        // TODO Auto-generated method stub
        return null;
    }

}

