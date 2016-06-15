/* 
 * Copyright (C) 2010-2011 星星(wuweihua)<349446658@qq.com>
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
package cn.edu.hrbeu.intercept;

import cn.edu.hrbeu.util.Constants;

import com.wabacus.config.component.application.report.ReportBean;
import com.wabacus.system.ReportRequest;
import com.wabacus.system.intercept.AbsInterceptorDefaultAdapter;

public class PsdCheck2 extends AbsInterceptorDefaultAdapter
{
    /**
     * 只覆写父类的加载数据前置动作
     */
    public Object beforeLoadData(ReportRequest rrequest,ReportBean rbean,Object typeObj,String sql)
    {
    	String loginname=rrequest.getRequest().getSession().getAttribute(Constants.USER_KEY).toString();
    	System.out.println(loginname);
		if(!"".equals(loginname)&&loginname!=null){
			sql = sql.replaceAll("%mycondition%","login_name="+'"'+loginname+'"');
			System.out.println(sql);
		}else{
			sql = sql.replaceAll("%mycondition%","1=1");
		}
		return sql;
    }

}

