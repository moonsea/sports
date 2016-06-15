function typePromptCallBack(textObj)
{
	if(textObj==null) return;
	var values = textObj.id.split("_")
	//wx_alert('选中的选项值：'+textObj.id);
	//执行此报表的搜索操作
	searchReportData(values[0],values[2]);
	/**
	 * 如果不想象上面一样写死要搜索的报表所在页面ID和报表本身ID（即这里的typepromptpage4和report1），可以从textObj.id中取到这两个值，因为框架为输入框分配的id中自动包括它所在的报表ID和报表所在的页面ID。
	 * 这对想写一个统一的功能非常有用，不需每个报表去写一个这种方法进行自动搜索。
	 */
}

function testInvokeCallbackMethod1(datasObj)
{
	refreshComponentDisplay(datasObj.pageid,null);
}