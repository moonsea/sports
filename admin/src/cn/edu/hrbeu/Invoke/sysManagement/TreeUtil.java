package cn.edu.hrbeu.Invoke.sysManagement;

import java.util.Iterator;
import java.util.List;

import cn.edu.hrbeu.pojo.Operation;
/**
* @CopyRright (c)2011-2012   <哈尔滨工程大学>                         
* @Project                   <电力等级保护安全测评平台 >                                          
* @Comments  <此类用来实现树的生成>                                          
* @JDK version used      <JDK1.6>                                                      
* @Author        <唐滨>                
* @Create Date  <2011-07-01>
* @Modified By                                       
* @Modified Date                                 
* @Why & What is modified    
* @Version  <v2.1>                      
*/ 
public class TreeUtil {
	/**
	* 
	* 根据输入的list生成一棵树	
	* 
	* @param  	list 操作集合
	* 			
	* @return String 返回树                                               
	* 
	*/ 
	public static String listToJSON(List<Operation> list){
		StringBuffer sb = new StringBuffer();
		if ((list == null)||(list.size() <= 0)) {
			return "";
		}
		sb.append("[");
		Iterator<Operation> it = list.iterator();
		while (it.hasNext()) {
			Operation operation = (Operation) it.next();
			sb.append("{\"id\":\""+operation.getOperationID());
			sb.append("\",\"name\":\""+operation.getOperationName());						
			sb.append("\",\"parent\":\""+operation.getParentID());
			sb.append("\",\"url\":\""+operation.getURL());
			sb.append("\",\"desc\":\""+operation.getOperationDescription());
			sb.append("\",\"icon\":\""+operation.getIcon());
			if(operation.isCheck())
			{
				sb.append("\",\"checked\":\""+"CHECKED");
			}
			else
			{
				sb.append("\",\"checked\":\""+"");
			}
			sb.append("\",\"remark\":\""+operation.getRemark());
			
			sb.append("\"},");
		}
		sb.deleteCharAt(sb.length()-1);
		sb.append("]");
		System.out.println("json:"+sb.toString());
		return sb.toString();
	}
}
