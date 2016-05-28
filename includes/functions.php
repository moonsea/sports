<?php
// define("SPORTS","YES");
include_once("init.php");

//检查手机号码是否合法
function check_phone($phonenumber)
{
	if(preg_match("/^1[34578]{1}\d{9}$/",$phonenumber))
	{
    	return TRUE;
	}
	else
	{
		return FALSE;
	}
}
//检查密码长度是否大于六位
function check_password($password)
{
	if(strlen($password) > 5)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

//检查用户登录账户密码是否匹配
function check_login($mobile,$password)
{
	if(!check_phone($mobile))
	{
		return FALSE;
	}
	else
	{
		if(!check_password($password))
		{
			return FALSE;
		}
		else
		{
			$password = md5($password);
			$sql = "select count(*) from user where mobile=$mobile and password=$password";
			if($db->get_var($sql))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
}

//更新sessions
function update_session($token)
{
	$sql = "select count(*) from sessions where sesskey='$token'";
	if(!$db->get_var($sql))//第一次登录
	{
		$expiry = time()+2*60*60;
		$sql = "insert into sessions(sesskey,expiry)values('$token','$expiry')";
		$db->query($sql);
	}
	else//更新eixpiry时间
	{
		$expiry = time()+2*60*60;
		$sql = "update sessions set expiry='$expiry' where sesskey='$token'";
		$db->query($sql);
	}
}

//检查是否已经登录
function is_login($token)
{
	$sql = "select expiry from sessions where sesskey='$token'";
	$expiry = $db->get_var($sql);
	if($expiry > time())
	{
		return TURE;
	}
	else
	{
		return FALSE;
	}
}

//获取用户详细信息
function get_user_info($phone)
{
	$sql = "select * from user where mobile='$phone'";
	$ret = $db->get_row($sql);
	if($ret->img = "")
	{
		$ret->img = "http://placeholdit.imgix.net/~text?txtsize=26&txt=%E7%82%B9%E6%88%91%E4%B8%8A%E4%BC%A0&w=200&h=200";
	}
	return $ret;
}


?>
