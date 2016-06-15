//查看各年竞赛详情
function showContestYearDetail(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=contest_year_detail&con_year='+proid,width:700,height:500,title:'竞赛详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//学院获奖认定已通过
function showdep2AwardsCheckOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_update_dep_2&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//学院获奖认定未通过
function showdepAwardsCheckOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_update_dep&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团书记获奖认定已通过
function show3rd2AwardsCheckOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_update_sch_3rd_2&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团书记获奖认定未通过
function show3rdAwardsCheckOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_update_sch_3rd&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团副书记获奖认定已通过
function show2nd2AwardsCheckOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_update_sch_2nd_2&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团副书记获奖认定未通过
function show2ndAwardsCheckOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_update_sch_2nd&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团老师获奖认定已通过
function show1st2AwardsCheckOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_update_sch_1st_2&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团老师获奖认定未通过
function show1stAwardsCheckOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_update_sch_1st&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//查看申请作品详情
function showProDetailOperation(proid)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=submitContestDetail&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//查看申请作品详情
function showProDetailSchOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=submitContestDetail1&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}


//学生查看申请作品详情
function showProDetailStuOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=submitContestDetail_Stu&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//查看申请作品详情,加入获奖信息
function showProAwardsDetailOperation(proid)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=submitContestDetailAwards&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//院系查看申请作品详情
function showProDepDetailOperation(proid)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=submitProjectEditDep&Pro_ID='+proid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//查看竞赛详情
function showConDetailOperation(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=contest_detail&Con_No='+conno,width:700,height:500,title:'竞赛详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//院系查看竞赛申报信息详情，不可编辑
function showDepConApplyDetailOperation(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=submitContestDetailDep&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//院系竞赛申报信息详情未审核
function showConApplyDetailOperation(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_dep_con&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//院系竞赛申报信息详情已审核
function showConApplyDetailOperation2(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_dep_con2&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//团委查看竞赛申报信息详情，无修改权限
function showSchConApplyDetailOperation(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团老师查看竞赛申报信息详情未审核
function show1stConApplyDetailOperation(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_1st&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团老师查看竞赛申报信息详情，未通过审核
function show1stConApplyDetailOperation2(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_1st2&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团老师查看竞赛申报信息详情，已通过审核
function show1stConApplyDetailOperation3(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_1st3&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团老师查看经费报销信息详情审核已通过
function show1st2FundApplyDetailOperation(conno)
{		
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=fund_update_sch_1st_2&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团老师查看经费报销信息详情审核未通过
function show1stFundApplyDetailOperation(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=fund_update_sch_1st&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}



//校团副书记查看经费报销信息详情审核已通过
function show2nd2FundApplyDetailOperation(conno)
{ 
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=fund_update_sch_2nd_2&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团副书记查看经费报销信息详情审核未通过
function show2ndFundApplyDetailOperation(conno)
{ 

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=fund_update_sch_2nd&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团书记查看经费报销信息详情审核通过
function show3rd2FundApplyDetailOperation(conno)
{ 
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=fund_update_sch_3rd_2&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团书记查看经费报销信息详情审核未通过
function show3rdFundApplyDetailOperation(conno)
{ 
	
	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=fund_update_sch_3rd&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团副书记查看竞赛申报信息详情未审核
function show2ndConApplyDetailOperation(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_2nd&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团副书记查看竞赛申报信息详情已审核
function show2ndConApplyDetailOperation2(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_2nd2&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团副书记查看竞赛申报信息详情审核已通过
function show2ndConApplyDetailOperation3(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_2nd3&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校团记查看竞赛申报信息详情
function show3rdConApplyDetailOperation(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_3rd&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//校团记查看竞赛申报信息详情
function show3rdConApplyDetailOperation2(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_3rd2&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

function show3rdConApplyDetailOperation3(conno)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=project_apply_sch_con_3rd3&Con_No='+conno,width:700,height:500,title:'竞赛申报详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//提交参赛申请
function submitProjectAttend(proid)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=submitContestAttendDetail&Pro_ID='+proid,width:750,height:500,title:'参赛申请',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

//校验两次输入密码是否一致
function validatePassswdChangeInput(pageid,reportid,dataObjArr)
{
	for(var i=0;i<dataObjArr.length;i++)
	{
		dataObjTmp=dataObjArr[i];
		if(dataObjTmp['WX_TYPE']=='delete') continue;//当前是在做删除操作
		var passwd=dataObjTmp['mem_passwd'];
		var passwd_confirm=dataObjTmp['passwd_confirm'];		
		if(passwd!=passwd_confirm)
		{//两次输入的密码不一致
			wx_alert('两次输入的密码不一致');
			return WX_SAVE_TERMINAT;
		}
	}
	return WX_SAVE_CONTINUE;
}

//查看获奖认定书
function showProDetailAwardsPrint(proid)
{		

	ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=awards_author_print_sch&Pro_ID='+proid,width:700,height:500,title:'获奖认定书',handler:null,maxBtn:true,minBtn:true,iframe:true})
}

function testInvokeCallbackMethod1()
{	

}
//自动计算小计值

function coutValue(node)
{

	var tr1 = node.parentNode.parentNode.parentNode.parentNode;  

	var tdid3 = tr1.cells[3].id;
	var valueid3 = tdid3.substr(0, tdid3.length-3)+tdid3.substr(tdid3.length-1);
	var tdid4 = tr1.cells[4].id;
	var valueid4 = tdid4.substr(0, tdid4.length-3)+tdid4.substr(tdid4.length-1);
	var tdid5 = tr1.cells[5].id;      
	var valueid5 = tdid5.substr(0, tdid5.length-3)+tdid5.substr(tdid5.length-1);
	//alert("tdid5:"+valueid5);
	var value3  = document.getElementById(valueid3);
	var value4  = document.getElementById(valueid4);
	var value5  = document.getElementById(valueid5);
	var countval = value3.value * value4.value;
	//  alert(countval);  

	value5.value =countval;
	//  alert(tr1.cells[0].childNodes[0].value); //获取的方法一  

}

function saveReport1()
{
	saveEditableReportData({pageid:'submitContestAttendDetail',savingReportIds:[{reportid:'report1',updatetype:'save'}]});
}


//学生添加作品内容重复判断
function SubmitStuProBeforeSaveCheck(pageid,reportid ,dataObjArr)
{
	var dataObjTmp; 
	//判断作者顺序是否存在重复
	for(var i=0;i<dataObjArr.length;i++) 
	{   dataObjTmp=dataObjArr[i];
		var operation_type = dataObjTmp['WX_TYPE'];
		//alert(operation_type);
		if(operation_type=="add")
		{
			var order1=dataObjTmp['Team_Mem_Order'];
		    for(var j=i+1;j<dataObjArr.length;j++) 
			{   dataObjTmp=dataObjArr[j]; 
		        var order2=dataObjTmp['Team_Mem_Order'];
		        if(order2==order1)
		        {        	
		        	alert("作者顺序存在重复，请修改后提交！");
		        	return WX_SAVE_TERMINAT;
		        }	      
			}	
		}
	                  
	}
	
	//判断作者是否存在重复
	for(var i=0;i<dataObjArr.length;i++) 
	{   dataObjTmp=dataObjArr[i];   
		var operation_type = dataObjTmp['WX_TYPE'];
		if(operation_type=="add")
		{
			var order1=dataObjTmp['Team_Mem_Num'];
		    for(var j=i+1;j<dataObjArr.length;j++) 
			{   dataObjTmp=dataObjArr[j]; 
		        var order2=dataObjTmp['Team_Mem_Num'];
		        if(order2==order1)
		        {        	
		        	alert("作者存在重复，请修改后提交！");
		        	return WX_SAVE_TERMINAT;
		        }	      
			}	
		}
		              
	}
	//队长只能有一个，并且必须存在，添加时进行校验
	var mem_role="";
	//alert(dataObjArr.length);
	if(dataObjArr.length)
	{
		for(var i=0;i<dataObjArr.length;i++) 
		{   dataObjTmp=dataObjArr[i];   
			var operation_type = dataObjTmp['WX_TYPE'];
			if(operation_type=="add")
			{
				var role1=dataObjTmp['Team_Mem_Role'];
			    if(role1=="队长")
			    {
			    	mem_role = "队长";
				    for(var j=i+1;j<dataObjArr.length;j++) 
					{   dataObjTmp=dataObjArr[j]; 
				        var order2 = dataObjTmp['Team_Mem_Role'];
				        if(order2==role1)
				        {        	
				        	alert("队长只能有一个，请修改后提交！");
				        	return WX_SAVE_TERMINAT;
				        }	      
					}     
			    }
			}
		}
		if(mem_role=="")
		{
			alert("请添加一名队长，修改后提交！");
			return WX_SAVE_TERMINAT;
		}
	}
	/*
	else
	{
		dataObjTmp=dataObjArr[0];
		alert(dataObjTmp);
		var operation_type = dataObjTmp['WX_TYPE'];
		alert(operation_type);
		if(operation_type=="add")
		{
			alert("请添加或者选择一名学生成员，修改后提交！");
			return WX_SAVE_TERMINAT;
		}
	}
	*/
	
	return WX_SAVE_CONTINUE;
	// WX_SAVE_IGNORE   WX_SAVE_TERMINAT WX_SAVE_CONTINUE
}

//学生添加作品内容重复判断
function SubmitTeaProBeforeSaveCheck(pageid,reportid ,dataObjArr)
{
	var dataObjTmp; 
	//判断作者顺序是否存在重复
	for(var i=0;i<dataObjArr.length;i++) 
	{   dataObjTmp=dataObjArr[i];   
	    var order1=dataObjTmp['Team_Tea_Order'];
	    for(var j=i+1;j<dataObjArr.length;j++) 
		{   dataObjTmp=dataObjArr[j]; 
	        var order2=dataObjTmp['Team_Tea_Order'];
	        if(order2==order1)
	        {        	
	        	alert("教师顺序存在重复，请修改后提交！");
	        	return WX_SAVE_TERMINAT;
	        }	      
		}              
	}
	
	//判断教师是否存在重复
	for(var i=0;i<dataObjArr.length;i++) 
	{   dataObjTmp=dataObjArr[i];   
	    var order1=dataObjTmp['Team_Tea_Num'];
	    for(var j=i+1;j<dataObjArr.length;j++) 
		{   dataObjTmp=dataObjArr[j]; 
	        var order2=dataObjTmp['Team_Tea_Num'];
	        if(order2==order1)
	        {        	
	        	alert("教师存在重复，请修改后提交！");
	        	return WX_SAVE_TERMINAT;
	        }	      
		}              
	}
	
	
	return WX_SAVE_CONTINUE;
	// WX_SAVE_IGNORE   WX_SAVE_TERMINAT WX_SAVE_CONTINUE
}
