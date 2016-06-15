package cn.edu.hrbeu.interceptor;

import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Types;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import javax.servlet.http.HttpServletRequest;

import org.apache.commons.fileupload.FileItem;

import cn.edu.hrbeu.jndi.JNDIDataSource;
import cn.edu.hrbeu.util.DatabaseUtil;
import cn.edu.hrbeu.util.ReadExcelData;
import com.wabacus.system.intercept.AbsFileUploadInterceptor;


public class StudentImport extends AbsFileUploadInterceptor
{
	
    public boolean beforeDisplayFileUploadInterface(HttpServletRequest request,Map<String,String> mFormAndConfigValues,PrintWriter out)
    {
		if(mFormAndConfigValues!=null){//失败界面 不做处理
    		out.println("<script language='javascript'>");
			out.println("this.document.getElementsByName('fileuploadform')[0].onsubmit=function(){return confirm('确认要导入?')}");
			out.println("</script>");
            out.println("注意文件格式和内容，导入已有的记录将会覆盖原来的数据！");
    		
    	}else{//第一次出现的界面 需要把小区编号从request中取出来 放到表单里面
    		out.println("<script language='javascript'>");
			out.println("this.document.getElementsByName('fileuploadform')[0].onsubmit=function(){return confirm('确认要导入?')}");
			out.println("</script>");
            out.println("注意文件格式和内容，导入已有的记录将会覆盖原来的数据！");
    	}
    	return true;
    }

    public boolean beforeFileUpload(HttpServletRequest request,FileItem fileitemObj,Map<String,String> mFormAndConfigValues,PrintWriter out)
    {
        return true;//表示由框架自动完成文件上传功能
    }

    /**
     * 所有文件上传后的成功/失败提示信息，如果返回空，则系统自动给出提示信息
     * @throws SQLException 
     */
    @SuppressWarnings("null")
    ArrayList<String> gradename = new ArrayList();
	ArrayList<String> gradeid = new ArrayList();
	public boolean getGradelist() throws SQLException	
    {
    	Connection conn = DatabaseUtil.getConnection();
    	PreparedStatement pstmt=null;
		ResultSet rs =null;
		
		try{
    		pstmt = conn.prepareStatement("SELECT * FROM t_gradeinfo");
    		rs = pstmt.executeQuery();
    		int i =0;
    		while(rs.next())
    		{
    			//name[i]= rs.getString("grade_name");
    			String tmpname= rs.getString("grade_name");
    			gradename.add(tmpname);
    			//id[i]= rs.getString("grade_id");
    			String tmpid= rs.getString("grade_id");
    			gradeid.add(tmpid);
    			i++;
    		}
    	}catch(Exception e){
			e.printStackTrace();
			return false;
		}finally{
			try{
				rs.close();
				pstmt.close();
				conn.close();
			}catch(Exception e){
				e.printStackTrace();
			}
		}
		return true;
    }
	
	 	ArrayList<String> depname = new ArrayList();
		ArrayList<String> depid = new ArrayList();
		public boolean getDeplist() throws SQLException	
	    {
	    	Connection conn = DatabaseUtil.getConnection();
	    	PreparedStatement pstmt=null;
			ResultSet rs =null;
			
			try{
	    		pstmt = conn.prepareStatement("SELECT * FROM t_departmentinfo");
	    		rs = pstmt.executeQuery();
	    		int i =0;
	    		while(rs.next())
	    		{
	    			String tmpname= rs.getString("dep_name");
	    			depname.add(tmpname);
	    			String tmpid= rs.getString("dep_id");
	    			depid.add(tmpid);
	    			i++;
	    		}
	    	}catch(Exception e){
				e.printStackTrace();
				return false;
			}finally{
				try{
					rs.close();
					pstmt.close();
					conn.close();
				}catch(Exception e){
					e.printStackTrace();
				}
			}
			return true;
	    }
    
   
    public boolean beforeDisplayFileUploadPrompt(HttpServletRequest request,List lstFieldItems,Map<String,String> mFormAndConfigValues,
            String failedMessage,PrintWriter out)
    {
    	
    	if(failedMessage!=null&&!failedMessage.trim().equals(""))//上传失败 交给框架处理
        {//如果上传失败
            return true;
        }else{//上传成功 自己解析excel文件 再判断是否导入成功
        	String path = mFormAndConfigValues.get("SAVEPATH");
            String name=mFormAndConfigValues.get("NEWFILENAME");
            String filename = path+name+".xls";
            
            try {
            	String[][] estate = ReadExcelData.getData(filename);
            	if (estate==null)
            	{
            		out.println("<script language='javascript'>");
            		out.println("alert('导入失败，请重新检查文件格式和内容!')");
					out.println("</script>");
					out.println("<script language='javascript'>");
					out.println("window.parent.refreshComponentDisplay('member_manage_student_dep',null);");
					out.println("</script>");
					return false;
            	}
				try{
					Connection conn = DatabaseUtil.getConnection();
					if(null == conn){
						conn = new JNDIDataSource().getConnection();
					}
					conn.setAutoCommit(false);
					PreparedStatement pstmt=null;
					ResultSet rs =null;
					

					try {	
						getGradelist();
						getDeplist();
						int rows = estate.length;
						for(int i=0;i<rows;i++)//从第一行读 第0行是标题
						{	
							try{
								pstmt = conn.prepareStatement("SELECT * FROM t_memberinfo WHERE mem_id = ?");
								pstmt.setString(1,estate[i][0]);
								rs = pstmt.executeQuery();
								if(rs.next()){//已存在了，update一下
									pstmt = conn.prepareStatement("UPDATE t_memberinfo SET mem_name=?,mem_passwd=?,mem_class=?,mem_grade=?,mem_dep_num=?,mem_major=?,mem_tel=?,mem_card_num=?,mem_email=?,mem_remark=? WHERE mem_id=?");
									pstmt.setString(1,estate[i][1]);
									pstmt.setString(2,estate[i][2]);
									pstmt.setString(3,estate[i][3]);
									String tmpgrade = null;
									for(int ii=0;ii<gradename.size();ii++)
									{	
										if(gradename.get(ii).equals(estate[i][4]))
										tmpgrade = gradeid.get(ii);
									}
									
									String tmpdep = null;
									for(int ii=0;ii<depname.size();ii++)
									{	
										if(depname.get(ii).equals(estate[i][5]))
										tmpdep = depid.get(ii);
									}
									pstmt.setString(4,tmpgrade);
									pstmt.setString(5,tmpdep);
									pstmt.setString(6,estate[i][6]);
									pstmt.setString(7,estate[i][7]);
									pstmt.setString(8,estate[i][8]);
									pstmt.setString(9,estate[i][9]);
									pstmt.setString(10,estate[i][10]);
									pstmt.setString(11,estate[i][0]);
								
									pstmt.executeUpdate();
								}else{
									pstmt = conn.prepareStatement("INSERT INTO t_memberinfo (mem_name,mem_passwd,mem_class,mem_grade,mem_dep_num,mem_major,mem_tel,mem_card_num,mem_email,mem_id,mem_role_id,mem_remark) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
									pstmt.setString(1,estate[i][1]);
									pstmt.setString(2,estate[i][2]);
									pstmt.setString(3,estate[i][3]);
									String tmpgrade = null;
									for(int ii=0;ii<gradename.size();ii++)
									{	
										if(gradename.get(ii).equals(estate[i][4]))
										tmpgrade = gradeid.get(ii);
									}
									
									String tmpdep = null;
									for(int ii=0;ii<depname.size();ii++)
									{	
										if(depname.get(ii).equals(estate[i][5]))
										tmpdep = depid.get(ii);
									}
									pstmt.setString(4,tmpgrade);
									pstmt.setString(5,tmpdep);
									pstmt.setString(6,estate[i][6]);
									pstmt.setString(7,estate[i][7]);
									pstmt.setString(8,estate[i][8]);
									pstmt.setString(9,estate[i][9]);
									pstmt.setString(10,estate[i][0]);
									pstmt.setInt(11,1);
									pstmt.setString(12,estate[i][10]);
									pstmt.executeUpdate();
								}
							}catch(Exception e){
								e.printStackTrace();
								conn.rollback();
								out.println("<script language='javascript'>");
			            		out.println("alert('导入失败，第"+(i+1)+"条记录数据不合法，请重新检查文件格式和内容!')");
								out.println("</script>");
								//out.println("导入失败，第"+(i+1)+"条记录数据不合法，请重新检查文件格式和内容!");
								out.println("<script language='javascript'>");
								out.println("window.parent.refreshComponentDisplay('member_manage_student_dep',null);");
								out.println("</script>");
								return false;
							}
						
						}
						conn.setAutoCommit(true);
						out.println("<script language='javascript'>");
	            		out.println("alert('上传成功，导入成功!')");
						out.println("</script>");
						//out.println("上传成功，导入成功!");
						out.println("<script language='javascript'>");
						out.println("window.parent.refreshComponentDisplay('member_manage_student_dep',null);");
						out.println("</script>");
					}catch(SQLException e){
							e.printStackTrace();
							conn.rollback();
							out.println("<script language='javascript'>");
		            		out.println("alert('导入失败，请重新检查文件格式和内容!')");
							out.println("</script>");
							//out.println("导入失败，请重新检查文件格式和内容!");
							out.println("<script language='javascript'>");
							out.println("window.parent.refreshComponentDisplay('member_manage_student_dep',null);");
							out.println("window.parent.closePopupWin(2);");
							out.println("</script>");
					}finally{
				 		try {
							if(pstmt != null)
							{
								pstmt.close();
							}
							conn.close();
						} catch (SQLException e) {
							e.printStackTrace();
						}
				 	}
				}catch(Exception e)
				{	
					out.println("<script language='javascript'>");
            		out.println("alert('导入失败，请重新检查文件格式和内容!')");
					out.println("</script>");
					//out.println("导入失败，请重新检查文件格式和内容!");
					out.println("<script language='javascript'>");
					out.println("window.parent.refreshComponentDisplay('member_manage_student_dep',null);");
					out.println("</script>");
					e.printStackTrace();
				}
				
			} catch (FileNotFoundException e) {
				out.println("<script language='javascript'>");
        		out.println("alert('导入失败，请重新检查文件格式和内容!')");
				out.println("</script>");
				//out.println("导入失败，请重新检查文件格式和内容!");
				out.println("<script language='javascript'>");
				out.println("window.parent.refreshComponentDisplay('member_manage_student_dep',null);");
				out.println("</script>");
				e.printStackTrace();
			} catch (IOException e) {
				out.println("<script language='javascript'>");
        		out.println("alert('导入失败，请重新检查文件格式和内容!')");
				out.println("</script>");
				//out.println("导入失败，请重新检查文件格式和内容!");
				out.println("<script language='javascript'>");
				out.println("window.parent.refreshComponentDisplay('member_manage_student_dep',null);");
				out.println("</script>");
				e.printStackTrace();
			}
        }
    	return false;
    }
    

}
