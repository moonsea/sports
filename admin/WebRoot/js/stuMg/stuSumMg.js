
//查看个人总结详情
function showSumIndDetailOperation(sumid)
{		
 
   ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=SumIndDetail&sum_id='+sumid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
//查看团队总结详情
function showSumTeamDetailOperation(sumid)
{		
 
   ymPrompt.win({message:'/HEUConStu/ShowReport.wx?PAGEID=SumTeamDetail&sum_id='+sumid,width:700,height:500,title:'作品详情',handler:null,maxBtn:true,minBtn:true,iframe:true})
}
