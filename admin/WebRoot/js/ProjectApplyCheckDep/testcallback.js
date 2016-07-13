
function testAfterSaveCallback(paramsObj)
{
	//alert('已保存的页面ID:::'+paramsObj.pageid+';;;报表ID:::'+paramsObj.reportid);
	//var reportguid=getComponentGuidById(paramsObj.pageid,paramsObj.reportid);
	//var dataObjArr=WX_ALL_SAVEING_DATA[reportguid];//得到已保存的数据
	//printSavingData(dataObjArr);
	parent.location.reload();
}

function refTab(pageid,reportid)
{	
	parent.location.href='/sports/admin/ShowReport.wx?PAGEID='+pageid+'&tp1_selectedIndex='+reportid;
}