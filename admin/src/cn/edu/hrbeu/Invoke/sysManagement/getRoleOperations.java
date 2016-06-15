package cn.edu.hrbeu.Invoke.sysManagement;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import cn.edu.hrbeu.pojo.Operation;

import com.wabacus.config.Config;
import com.wabacus.config.component.IComponentConfigBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.assistant.WabacusAssistant;
import com.wabacus.system.serveraction.IServerAction;

public class getRoleOperations implements IServerAction{

	
	/**
     * 与框架无关的ajax调用
     */
    public String executeServerAction(HttpServletRequest request,HttpServletResponse response,List<Map<String,String>> lstData)
    {
		String parentId ="";
		String roleId = "";
		if(lstData==null||lstData.size()==0)
        {
			System.out.println("没有取到数据");
			return "";
        }else
        {
            for(Map<String,String> mParams:lstData)
            {                
            	parentId = mParams.get("root");
            	roleId = mParams.get("roleId");    
            }
        }
		return getTreeNode(parentId,roleId);
	}
	
	
	/**
	* 
	* 以下为系统操作权限菜单	
	* 
	* @param  	parentid 父节点ID
	* @param 	roleid 角色ID
	* 
	* @return String 返回树节点集合
	*                  	                                                 
	* 
	*/ 
	public String getTreeNode(String parentid,String roleid)
	{
		System.out.println("取到的roleid："+roleid);
		/**获取数据库连接和sql语句声明*/
		Connection con = Config.getInstance().getDataSource("ds_mysql").getConnection();

		List<Operation> treelist = new ArrayList <Operation>();
		try {
			//读取整个权限树
			String sql = "select A.OperationID,A.OperationName,A.icon,A.URL,A.ParentID from operation A left join operation B on A.OperationID=B.parentId group by A.OperationID ";
			ResultSet rs=null;

			PreparedStatement pstmt;
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			Operation tn;
			while(rs.next()){
				tn = new Operation();
				tn.setOperationID(rs.getString("OperationID"));
				tn.setOperationName(rs.getString("OperationName"));
				tn.setParentID(rs.getString("parentId"));
				tn.setIcon(rs.getString("icon"));			
				tn.setURL(rs.getString("URL"));
				treelist.add(tn);
			}
			rs.close();

			//读取该角色具有的权限
			sql = "select * from roleoperationmapping where roleId = ?";
			pstmt =con.prepareStatement(sql);
			pstmt.setString(1,roleid);			
			rs = pstmt.executeQuery();
			while(rs.next()){
				String operationId =rs.getString("OperationID");
				for(int i=0;i<treelist.size();i++)
				{
					if(operationId.equals(treelist.get(i).getOperationID()))
					{
						treelist.get(i).setCheck(true);
					}
				}
			}
			rs.close();

			pstmt.close();
			

		} catch (SQLException e) {
			e.printStackTrace();
		}
		finally
        {
            WabacusAssistant.getInstance().release(con,null);
        }
		String treeStr  = TreeUtil.listToJSON(treelist);
		System.out.println(treeStr);
		return treeStr;
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
