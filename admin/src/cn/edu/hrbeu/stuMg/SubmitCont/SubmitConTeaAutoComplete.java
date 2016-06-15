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
public class SubmitConTeaAutoComplete extends AbsCommonDataSetValueProvider
{
    public Map<String,String> getAutoCompleteColumnsData(ReportRequest rrequest,Map<String,String> mParams)
    {
    	//System.out.println("complete");
    	//System.out.println(mParams.toString());
        //if(mParams==null||!mParams.containsKey("Team_Tea_Num")||!mParams.containsKey("lead_tea_id")) return null;
    	//System.out.println("complete");
        String tea_id=mParams.get("Team_Tea_Num");
    	//System.out.println(tea_id);
        if(tea_id==null||tea_id.trim().equals(""))
        {
        	tea_id=mParams.get("lead_tea_id");
        	//System.out.println(tea_id);
            if(tea_id==null||tea_id.trim().equals(""))
            	return null;//没有输入 ，则不自动填充
        }
        Connection conn=rrequest.getConnection();
        PreparedStatement pstmt=null;
        try
        {
            pstmt=conn.prepareStatement("SELECT t.*,d.dep_name FROM t_teacherinfo t left join t_departmentinfo d on t.tea_dep_num = d.dep_id where  tea_id = ?");
            pstmt.setString(1,tea_id);
            Map<String,String> mResults=new HashMap<String,String>();
            ResultSet rs=pstmt.executeQuery();
            if(rs.next())
            {//取到在columns属性中配置的需要自动填充的各列值，存入Map中返回
                mResults.put("team_tea_research",rs.getString("tea_research"));
                mResults.put("Team_Tea_Num",tea_id);
                mResults.put("lead_tea_id",tea_id);
                mResults.put("Team_Tea_Tel",rs.getString("tea_tel"));
                mResults.put("Team_Tea_Card_Num",rs.getString("tea_card_num"));    
                mResults.put("Team_Tea_Dep",rs.getString("dep_name"));   
                mResults.put("Team_Tea_Email",rs.getString("tea_email"));  
                mResults.put("tea_name",rs.getString("tea_name"));
               /* mResults.put("team_tea_title",rs.getString("tea_title"));*/
            }
            else
            {
            	 mResults.put("team_tea_research","");
                 mResults.put("Team_Tea_Num","");
                 mResults.put("lead_tea_id","");
                 mResults.put("Team_Tea_Tel","");
                 mResults.put("Team_Tea_Card_Num","");    
                 mResults.put("Team_Tea_Dep","");   
                 mResults.put("Team_Tea_Email","");  
                 mResults.put("tea_name","");
                /* mResults.put("team_tea_title","");*/
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

