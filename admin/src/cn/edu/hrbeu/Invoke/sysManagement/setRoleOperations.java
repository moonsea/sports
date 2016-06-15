package cn.edu.hrbeu.Invoke.sysManagement;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.List;
import java.util.Map;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import com.wabacus.config.Config;
import com.wabacus.config.component.IComponentConfigBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.serveraction.IServerAction;

public class setRoleOperations implements IServerAction{

	
	/**
     * 与框架无关的ajax调用
     */
    public String executeServerAction(HttpServletRequest request,HttpServletResponse response,List<Map<String,String>> lstData)
    {
		String operationIds ="";
		String roleId = "";
		if(lstData==null||lstData.size()==0)
        {
			System.out.println("没有取到数据");
			return "";
        }else
        {
            for(Map<String,String> mParams:lstData)
            {                
            	operationIds = mParams.get("operationIds");
            	roleId = mParams.get("roleId");    
            }
        }
		return saveTreeNode(roleId,  operationIds);
	}

	/**
	* 
	* 保存角色权限赋值	
	* 
	* @param  	operationids 操作ID
	* @param	roleid 角色ID
	* 
	* @return String 返回树节点集合
	*                  	                                                 
	* 
	*/
	public String saveTreeNode(String roleid, String operationids)
	{
		if(roleid==null||roleid=="")
		{
			return "没有获取到权限id，请重新进入权限管理进行设置";
		}

		if(operationids==null||operationids=="")
		{
			return "没有需要保存的权限";
		}

		String [] operationIds = operationids.trim().split(",");
		/**获取数据库连接和sql语句声明*/
		Connection conn = Config.getInstance().getDataSource("ds_mysql").getConnection();

		PreparedStatement pstmt = null;
		Boolean rs=null;
		try {
			conn.setAutoCommit(false);

			//先删除原来与该角色id 对应的所有operate
			String sql = "delete from roleoperationmapping where roleid= ?";
			pstmt = conn.prepareStatement(sql);
			pstmt.setString(1, roleid);					
			rs = pstmt.execute();	

			//插入角色设置的新的操作
			for(int i=0;i<operationIds.length;i++)
			{
				sql = "insert into roleoperationmapping (RoleID,OperationID) values(?,?)";
				pstmt = conn.prepareStatement(sql);
				pstmt.setString(1, roleid);
				pstmt.setString(2, operationIds[i]);				
				rs = pstmt.execute();			
			}

			conn.commit();
			conn.setAutoCommit(true);


		}catch(Exception e)
		{
			e.printStackTrace();
		}finally
		{
			if(pstmt!=null)
			{
				try
				{					
					pstmt.close();

				}catch(SQLException e)
				{
					e.printStackTrace();
				}

			}
			if(conn!=null)
			{
				try
				{
					conn.close();

				}catch(SQLException e)
				{
					e.printStackTrace();
				}

			}
		}

		return "设置成功";
	}	
	
    public void executeSeverAction(ReportRequest rrequest,IComponentConfigBean ccbean,List<Map<String,String>> lstData)
    {
		
	}

	@Override
	public String executeSeverAction(ReportRequest arg0,
			IComponentConfigBean arg1, List<Map<String, String>> arg2,
			Map<String, String> arg3) {
		// TODO Auto-generated method stub
		return null;
	}

	
}
