package cn.edu.hrbeu.stuMg.SubmitCont;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
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
import com.wabacus.system.intercept.AbsInterceptorDefaultAdapter;
import com.wabacus.system.serveraction.IServerAction;
import com.wabacus.util.UUIDGenerator;

public class updateMemAndTeaAttendState   implements IServerAction {
	
    /**
     * 针对组件通过ajax调用服务器端方法
     */
    public String executeSeverAction(ReportRequest rrequest,IComponentConfigBean ccbean,List<Map<String,String>> lstData,Map<String,String> mCustomizedData)
    {
        //rrequest.getWResponse().getMessageCollector().success("调用服务器端方法成功");//向前台提示一条信息，这里还可以终止后续处理
        printLstParams(lstData);//打印客户端传过来的参数
        
        if(lstData==null||lstData.size()==0) return "没有传入数据";
        Connection conn=Config.getInstance().getDataSource("").getConnection();//取配置的默认数据源的连接
        PreparedStatement pstmt=null;
        String Sum_Pro_ID =null; //作品编号
        String Sum_Mem_ID=null; //成员编号
        String Sum_Ind_Name =null;//成员姓名
        String Sum_Ind_Tel =null; //联系方式
        String Sum_Ind_Dep  =null; 
        String Sum_Ind_Class  =null; 
        String Sum_Ind_Major  =null; 
        String Sum_Ind_Email =null; 
        String Sum_Work =null;  
        String team_mem_role =null; 
        
        try
        {
            for(Map<String,String> mParams:lstData)
            {//将传入的每条数据插入数据库中
                String memid=mParams.get("memid");//从客户端取传过来项目成员表中id
                String memtype=mParams.get("tag");//从客户端取传过来的成员标记，是老师还是学学生
                String statetype=mParams.get("state");//
                
                if(memid==null||memid.trim().equals("")) continue;
                if(memtype==null||memtype.trim().equals("")) continue;
                if(statetype==null||statetype.trim().equals("")) continue;
                
                if(memtype.equals("学生"))
                {//
                	ResultSet rs=null;
        			pstmt = conn.prepareStatement("update t_teaminfo set Team_Status_Join=? where team_mem_id=?");
		    		pstmt.setString(1, statetype);
		    		pstmt.setString(2, memid);
		    		pstmt.executeUpdate();				
                    pstmt.close();
                    
                    pstmt = conn.prepareStatement("select t.team_pro_id,t.Team_Mem_Work,t.team_mem_role,m.mem_id,m.mem_name,d.dep_name,m.mem_tel,m.mem_class,m.mem_major,m.mem_email from t_teaminfo t left join t_memberinfo m on t.team_mem_num=m.mem_id left join t_departmentinfo d on m.mem_dep_num = d.dep_id where   t.team_mem_id=?");
                    pstmt.setString(1, memid);
                    rs=pstmt.executeQuery();	
                    while(rs.next())
                    {
                    	    Sum_Pro_ID =  rs.getString(1);
                    	    Sum_Work =rs.getString(2); 
                            team_mem_role =rs.getString(3); 
                            Sum_Mem_ID= rs.getString(4);
                            Sum_Ind_Name =rs.getString(5);                            
                            Sum_Ind_Dep  =rs.getString(6);
                            Sum_Ind_Tel =rs.getString(7);
                            Sum_Ind_Class  =rs.getString(8);
                            Sum_Ind_Major  =rs.getString(9);
                            Sum_Ind_Email =rs.getString(10); 
                    } 
                    
                    rs.close();
                       
                    if(statetype.equals("是"))
                    {//添加总结
                    	if(team_mem_role.equals("队长"))
                    	{
                    		//	添加个人总结
		                    pstmt = conn.prepareStatement("insert into T_Summary (sum_id,sum_pro_id,sum_mem_id,sum_ind_name,sum_ind_tel,sum_ind_dep,sum_ind_class,sum_ind_major,sum_ind_email,sum_work,Sum_Status) values(?,?,?,?,?,?,?,?,?,?,?)");
		                    pstmt.setString(1,UUIDGenerator.generateID());
		                    pstmt.setString(2,Sum_Pro_ID);
		                    pstmt.setString(3,Sum_Mem_ID);
		                    pstmt.setString(4,Sum_Ind_Name);
		                    pstmt.setString(5,Sum_Ind_Tel);
		                    pstmt.setString(6,Sum_Ind_Dep);
		                    pstmt.setString(7,Sum_Ind_Class);
				    		pstmt.setString(8, Sum_Ind_Major);
				    		pstmt.setString(9, Sum_Ind_Email);
				    		pstmt.setString(10, Sum_Work);
				    		pstmt.setString(11, "未总结");
				    		pstmt.executeUpdate();				
		                    pstmt.close();
		                    
		                    // 添加团队总结

		                    pstmt = conn.prepareStatement("insert into T_SumTeam (sum_id,sum_pro_id,sum_mem_id,Sum_Cap_Name,Sum_Cap_Tel,Sum_Cap_Email,Sum_Status) values(?,?,?,?,?,?,?)");
		                    pstmt.setString(1,Sum_Pro_ID);
		                    pstmt.setString(2,Sum_Pro_ID);
		                    pstmt.setString(3,Sum_Mem_ID);
		                    pstmt.setString(4,Sum_Ind_Name);
		                    pstmt.setString(5,Sum_Ind_Tel);		             
				    		pstmt.setString(6, Sum_Ind_Email);
				    		
				    		pstmt.setString(7, "未总结");
				    		pstmt.executeUpdate();				
		                    pstmt.close();
                    	}
                    	else
                    	{
                    		pstmt = conn.prepareStatement("insert into T_Summary (sum_id,sum_pro_id,sum_mem_id,sum_ind_name,sum_ind_tel,sum_ind_dep,sum_ind_class,sum_ind_major,sum_ind_email,sum_work,Sum_Status) values(?,?,?,?,?,?,?,?,?,?,?)");
 		                    pstmt.setString(1,UUIDGenerator.generateID());
 		                    pstmt.setString(2,Sum_Pro_ID);
 		                    pstmt.setString(3,Sum_Mem_ID);
 		                    pstmt.setString(4,Sum_Ind_Name);
 		                    pstmt.setString(5,Sum_Ind_Tel);
 		                    pstmt.setString(6,Sum_Ind_Dep);
 		                    pstmt.setString(7,Sum_Ind_Class);
 				    		pstmt.setString(8, Sum_Ind_Major);
 				    		pstmt.setString(9, Sum_Ind_Email);
 				    		pstmt.setString(10, Sum_Work);
 				    		pstmt.setString(11, "未总结");
 				    		pstmt.executeUpdate();				
 		                    pstmt.close();
                    	}
	                    
                    }
                    else
                    {//删除总结
                    	 pstmt = conn.prepareStatement("delete from T_Summary where  sum_pro_id=? and sum_mem_id=? ");
                         pstmt.setString(1, Sum_Pro_ID);
                         pstmt.setString(2, Sum_Mem_ID);
                         pstmt.executeUpdate();				
 	                     pstmt.close();	                     
	 	                
                    	
                    }
                     
                    return "插入学生成功";
                }
            	else
                {//删除总结
            		pstmt = conn.prepareStatement("update t_teamteainfo set Team_Status_Join=? where team_tea_id=?");
		    		pstmt.setString(1, statetype);
		    		pstmt.setString(2, memid);
		    		int i =pstmt.executeUpdate();		
		    		System.out.println("IIIIIIIIIIIIIIIIIIIIIII:"+i);
                    pstmt.close();
                    return "插入教师成功";
                }
            }
            return "插入数据成功";
        }catch(Exception e)
        {
            e.printStackTrace();
            return "设置失败";
        }finally
        {
            WabacusAssistant.getInstance().release(conn,null);
        }
    }

    private void printLstParams(List<Map<String,String>> lstData)
    {
        if(lstData==null||lstData.size()==0)
        {
            System.out.println("无参数");
        }else
        {
            System.out.print("客户端传入参数列表：：：");
            for(Map<String,String> mParams:lstData)
            {
                StringBuffer paramBuf=new StringBuffer();
                for(Entry<String,String> entryTmp:mParams.entrySet())
                {
                    paramBuf.append("[paramname:"+entryTmp.getKey()+";paramvalue:"+entryTmp.getValue()+"]");
                }
                System.out.print("{"+paramBuf.toString()+"};");
            }
            System.out.println(" ");
        }
    }

	@Override
	public String executeServerAction(HttpServletRequest arg0,
			HttpServletResponse arg1, List<Map<String, String>> arg2) {
		// TODO Auto-generated method stub
		return null;
	}
}
