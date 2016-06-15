
function relRoleAndOperation()
{
		
   invokeServerAction('cn.edu.hrbeu.Invoke.sysManagement.getRoleOperations',{actiontype:'clear'},testInvokeCallbackMethod2,null)
	
	//获取学生的编号
//	var stuDatasObj=getEditableReportColValues('StudentClassRelPage','report1',null);
//	var classDatasObj=getEditableReportColValues('StudentClassRelPage','report2',null);
//	if(stuDatasObj==null)
//	{
//		wx_alert('请选择一位学生！');
//		return;
//	}
//	if(classDatasObj==null)
//	{
//		wx_alert('请选择一个班级！');
//		return;
//	}
//
//	var stuNo=stuDatasObj["stuid"].value==null?"":stuDatasObj["stuid"].value;
//	var classNo=classDatasObj["classid"].value==null?"":classDatasObj["classid"].value;
//	if(stuNo!=null&&stuNo!=""&&classNo!=null&&classNo!="")
//	{		
//		invokeServerActionForComponent('StudentClassRelPage',null,'cn.edu.hrbeu.Invoke.studentMg.stuClassRel',{txtstuNo:stuNo,txtclassNo:classNo},true,invokeCallbackMethod)
//	}
//	else
//	{
//		wx_alert('请重新选择学生和班级！');
//	}
	//invokeServerAction('com.wabacusdemo.TestServerCallBack1',{txtstuNo:stuNo,txtclassNo:classNo},testInvokeCallbackMethod2,null);
}

function testInvokeCallbackMethod2(xmlHttpObj,datasObj)
{
	alert(xmlHttpObj.responseText);//打印服务器端方法返回的字符串
	if(datasObj==null) return;
//	var datasObjArr=convertToArray(datasObj);
//	printInvokeParamsData(datasObjArr);
	//refreshComponentDisplay('invokeservermethod_alonepage1',null,true);
	//window.location.href='/WabacusDemo/ShowReport.wx?PAGEID=invokeservermethod_alonepage1';//刷新一下此页面，将新插入的记录显示出来
}

