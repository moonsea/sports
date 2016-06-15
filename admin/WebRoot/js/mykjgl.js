/**
 * 从报表刷新主报表
 */
function myrefresh(){
	//alert("进入我的回调函数。。。");
	window.location.reload(); 
}

/**
 * 全部选中/不选中记录中的复选框
 */
function selectCheckBoxes(checkObj)
{
	var status=true;
	if(!checkObj.checked) status=false;
	var checkOptionObjsArr=document.getElementsByName('chkoption');
	if(checkOptionObjsArr&&checkOptionObjsArr.length>0)
	{
		for(var i=0;i<checkOptionObjsArr.length;i++)
		{
			checkOptionObjsArr[i].checked=status;
		}
	}
}

/**
 * 查看选中的单选框数据
 */
function viewSelectedRadioValues(method){
	var radioObjs=document.getElementsByName("radiooption");
	if(radioObjs){
		for(i=0;i<radioObjs.length;i=i+1){
			if(radioObjs[i].checked){
				//alert("选中："+radioObjs[i].value);
				ajaxRadio("/HGKJGL/hrbeu/kjgl/ajaxRadio.hq?", radioObjs[i].value, method);
				return true;
			}
		}
	}
	alert('没有选中值');
}

/**
 * 查看选中的所有复选框数据
 */
function viewSelectedCheckboxValues(method){
	var checkOptionObjsArr=document.getElementsByName('chkoption');
	var selectedvalues='';
	if(checkOptionObjsArr&&checkOptionObjsArr.length>0){
		for(var i=0;i<checkOptionObjsArr.length;i++){
			if(checkOptionObjsArr[i].checked){
				selectedvalues+=checkOptionObjsArr[i].value+',';
			}
		}
	}
	if(selectedvalues=='') {
		selectedvalues='没有选中值';
		alert(selectedvalues);
		return false;
	}
	//name="frmreport1"
	//var form = document.getElementsByName('frmreport1')[0];
	ajaxCheckbox("/HGKJGL/hrbeu/kjgl/ajaxCheckbox.hq?", selectedvalues, method);
}

/***************************************************************/
/*
 * Ajax
 */
//声明一个XHR对象变量，默认为false，表示没有XHR对象
var xhr = false;

//功能：创建一个跨浏览器的XMLHttpRequest对象
function createXHR(){
	try{
		xhr = new XMLHttpRequest();
	}catch(e){
		try{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e1){
			try{
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e2){
				xhr = false;
			}
		}
	}
	
	if(!xhr){
		alert("抱歉，您的浏览器版本太低，请升级后再访问本网站！");
	}
}

//功能：用Ajax提交用户设置radio信息
function ajaxRadio(url, params, method){
	ajaxCheckbox(url, params, method);
}

//功能：用Ajax提交用户设置checkbox信息
function ajaxCheckbox(url, params, method){
	//alert("进入我的ajax函数，设置权限。。。");
	createXHR();
	//设置要连接的url
	var ajaxUrl = url + "lhqparams="+encodeURI(encodeURI(params))+"&date="+new Date();
	if(method == 'userrole'){//设置用户角色
		ajaxUrl = ajaxUrl + "&method=userrole";
	}else if(method == 'roleunit'){//设置角色权限
		ajaxUrl = ajaxUrl + "&method=roleunit";
	}else if(method == 'rolefunction'){
		ajaxUrl = ajaxUrl + "&method=rolefunction";
	}else if(method == 'projectaudit'){//当前项目的审核信息
		ajaxUrl = ajaxUrl + "&method=projectaudit";
	}else if(method == 'awardaudit'){
		ajaxUrl = ajaxUrl + "&method=awardaudit";
	}else if(method == 'rationalproposal'){
		ajaxUrl = ajaxUrl + "&method=rationalproposal";
	}else if(method == 'rationalproposalAward'){
		ajaxUrl = ajaxUrl + "&method=rationalproposalAward";
	}
	//建立到服务器的连接
	xhr.open("GET",ajaxUrl,true);
	//设置服务器在完成处理后要回调的函数
	xhr.onreadystatechange = callback;
	//发送请求
	xhr.send(null);
}

//功能：回调函数
function callback(){
	if(xhr.readyState == 4 && xhr.status == 200){
		var text = xhr.responseText;
		alert(text);
	}
}

/***************************************************************/
//功能：删除指定用户
function deleteOne(url){
	if(window.confirm("你确定要删除吗？")){
		window.open(url,'','width=300,height=300,top=300,left=200');
	}
}
/*************************************************************/
function clearText(){
	//alert("进入我的clearText()函数。。。");
	var node = document.getElementById("report1_txtunitnumber");
	var text = node.value;
	//alert("text:" + text);
	if(text == "单位编号"){
		//alert();
		node.value = "";
	}
}

function inputInfo(){
	alert("进入我的inputInfo()函数。。。");
	var node = document.getElementById("report1_txtunitnumber");
	var text = node.value;
	alert("text:" + text);
	if(text == "单位编号"){
		this.value = "单位编号";
	}
}

///////////////////////////////////////////
/*
 * 模拟单击事件
 */
function doClick(linkId, e){   
    var fireOnThis = document.getElementById(linkId)
      if (document.createEvent){
        var evObj = document.createEvent('MouseEvents')
        evObj.initEvent( 'click', true, false )
        fireOnThis.dispatchEvent(evObj)
      }
      else if (document.createEventObject){
           fireOnThis.fireEvent('onclick')
      }
}
/////////////////////////////////////////////
/**
 * 打开权限功能树
 */
function selectDialog(roleId){
	//alert("roleId:" + roleId);
	var result=showModalDialog("/HGKJGL/authority.servlet?roleId=" + roleId + "&r="+Math.random(), window,"status:no;resizable:yes;dialogHeight:450px;dialogWidth:350px;unadorne:yes");
	if(typeof(result)=="undefined") result="";
	return result;
}

/**
 * 获得权限功能树中选中的项
 */
function getTreeSelectCheckbox(selectedvalues){
	//alert("我选择的有：" + selectedvalues);
	ajaxCheckbox("/HGKJGL/hrbeu/kjgl/ajaxCheckbox.hq?", selectedvalues, "rolefunction");
}
