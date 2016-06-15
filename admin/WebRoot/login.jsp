<%@ page contentType="text/html; charset=UTF-8" %>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>报名系统</title>
<script type="text/javascript">
var times=0;
$(document).ready(function(){

	  $("#loginForm").validate({
	    rules: {
				username: {
					required:true
				},
				password: {
					required:true
				}/*注释掉验证码
				validateword: {
					required:true
	    		}*/
	    },
	    messages: {
	      username: "<br>&nbsp;<font color='#FF0000'>请输入用户名！</font>",
	      password: "<br>&nbsp;<font color='#FF0000'>请输入密码！</font>"
	      //validateword: "<br>&nbsp;<font color='#FF0000'>请输入验证码！</font>" //注释掉验证码
	    }
	  });
});
function keySubmit()
{
     if (event.keyCode == 13)
     	loginMethod();
}
function loginMethod()
{
	if(document.loginForm.username.value==null||document.loginForm.username.value=="")
	{
		alert('请输入用户名！');
		return false;
	}
	if(document.loginForm.password.value==null||document.loginForm.password.value=="")
	{
		alert('请输入密码！');
		return false;
	}
	/* //注释掉验证码
	if(document.loginForm.validateword.value==null||document.loginForm.validateword.value=="")
	{
		alert('请输入验证码！');
		return false;
	}
	*/
	document.getElementById('loginForm').submit();
}
function cancelMethod()
{
	document.loginForm.username.value="";
	document.loginForm.password.value="";
	//document.loginForm.validateword.value="";//注释掉验证码
}
function refresh(obj)
{
	obj.src="auth.jpg?"+(times++);
}

function refreshSelf(){
	if(window.location.href!= window.parent.location.href){
	top.location="/HEUConStu/login.jsp";
	}
}
</script>
<!--  <link rel="shortcut icon" href="./favicon.ico">-->
<link href="./frameset/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="./frameset/js/jquery.js"></script>
<script src="./frameset/js/cloud.js" type="text/javascript"></script>

<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 
</head>

<body onkeydown="keySubmit()" onload="refreshSelf();" style="background-color:#1c77ac; background-image:url(images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">


<!--  <form action="login.jsp?action=login" method="post" id="loginForm" name="loginForm"> -->
<form action="login.jsp?action=login" method="post" id="loginForm" name="loginForm">
    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  
<div class="logintop">    
    <span>欢迎登录报名系统平台</span>    
    <ul>
    <li><a href="#">回首页</a></li>
    <li><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    </ul>    
    </div>
    
    <div class="loginbody">
    
    <span class="systemlogo2" style="display:block"></span> 
       
    <div class="loginbox">
    
    <ul>
    <li><input name="username" value="${requestScope.user}" type="text" class="loginuser" value="admin" onclick="JavaScript:this.value=''"/></li>
    <li><input name="password" type="password" class="loginpwd" value="密码" onclick="JavaScript:this.value=''"/></li>
    <li><input name="" type="button" class="loginbtn" value="登录"  onClick="loginMethod()" /><label><a href="#">  忘记密码？</a></label><label style="color: red;">
    <%

if(request.getAttribute("msg")!=null){
//out.print("<script>alert('"+request.getAttribute("msg")+"')</script>");
out.print(request.getAttribute("msg"));
}
%></label></li>
    </ul>  
    </div>  
    </div>
    <div class="loginbm">版权所有  2016 共青团哈尔滨工程大学委员会</div>
<input type="hidden" name="origin_uri" value="${requestScope.origin_uri}"/>
</form>
</body>
</html>
