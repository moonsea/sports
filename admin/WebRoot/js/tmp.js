function openNewWindow()
{
	window.open ('/eduSys/ShowReport.wx?PAGEID=UselessPage', 'newwindow','resizable=yes,location=yes');
	//window.location.href='/eduSys/ShowReport.wx?PAGEID=UselessPage';
	//wx_winpage('/eduSys/ShowReport.wx?PAGEID=UselessPage',"添加学生",800,400);	
}

function addStudent()
{
	wx_confirm("确认添加吗？","添加",null,null,function(input)
		{
		if(input=='ok')
		{
			invokeServerActionForReportData('UselessPage','report1','cn.edu.hrbeu.Invoke.classManage.AddStudent',true,{name:'SELECTEDROW',value:true},testBeforeInokeCallBackMethod1,Mycallback);	
		}
		else
		{

			return;
		}
			}		
	);

}


function testBeforeInokeCallBackMethod1(datasArray)
{
	if(datasArray==null||datasArray.length==0) 
	{
		alert('请先选择！');
		return false;//没有取到报表数据，则不调用后台操作
	}
	return true;
}

function Mycallback()
{
//	window.location.href='/eduSys/ShowReport.wx?PAGEID=DianmingPage';
	//refreshComponentDisplay('DianmingPage','report3');
	//alert('refesh');
	//parent.refreshComponentDisplay('DianmingPage',null,true);
	window.opener.searchReportData('DianmingPage','report3');
	window.close();
	//refreshPageDisplay('DianmingPage',null);
	//refreshComponentDisplay('DianmingPage',null,true);
	//refreshComponentDisplay(datasObj.pageid,null);//刷新整个页面
}

function testonload(pageid,reportid)
{
	alert('加载完报表页面ID：'+pageid+'；报表ID：'+reportid);
}