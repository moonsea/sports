<?php
include("init.php");
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
function login($mobile,$password)
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
			$db = $GLOBALS['db'];
			$password = md5($password);
			$sql = "select count(*) from `user` where `mobile`='{$mobile}' and `password`='{$password}'";
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
function update_session($token,$user_id)
{
	$db = $GLOBALS['db'];
	$sql = "select count(*) from `sessions` where `sesskey`='{$token}'";
	if($db->get_var($sql) < 1)//第一次登录
	{
		$expiry = time()+2*60*60;
		$sql = "insert into sessions(sesskey,expiry,userid)values('$token','$expiry','$user_id')";
		$db->query($sql);
	}
	else//更新eixpiry时间
	{
		$expiry = time()+2*60*60;
		$sql = "update `sessions` set expiry='{$expiry}' where sesskey='{$token}'";
		$db->query($sql);
	}
}

//检查是否已经登录
function is_login($token,$user_id)
{
	$db = $GLOBALS['db'];
	$sql = "select `expiry` from `sessions` where `sesskey`='{$token}'";
	$expiry = $db->get_var($sql);
	if($expiry > time())
	{
		update_session($token,$user_id);
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
	$db = $GLOBALS['db'];
	$sql = "select * from `user` where `mobile`='{$phone}'";
	$ret = $db->get_row($sql);
	if($ret->img == "")
	{
		$ret->img = "http://placeholdit.imgix.net/~text?txtsize=26&txt=%E7%82%B9%E6%88%91%E4%B8%8A%E4%BC%A0&w=200&h=200";
	}
	return $ret;
}

//通过user_id获取用户详细信息
function get_user_info_by_id($user_id)
{
	$db = $GLOBALS['db'];
	$sql = "select * from `user` where `user_id`={$user_id}";
	$ret = $db->get_row($sql);
	if($ret->img == "")
	{
		$ret->img = "http://placeholdit.imgix.net/~text?txtsize=26&txt=%E7%82%B9%E6%88%91%E4%B8%8A%E4%BC%A0&w=200&h=200";
	}
	return $ret;
}

//检查手机号码是否已经存在
function check_phone_available($phone)
{
	$db = $GLOBALS['db'];
	$sql = "select count(*) from `user` where `mobile`='{$phone}'";
	$exit = $db->get_var($sql);
	if($exit > 0)
	{
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}
//获取我的关注
function get_favorite($user_id,$page=1,$page_size=12)
{
	$db = $GLOBALS['db'];
	$total = get_favorite_count($user_id);
	$max_page = ceil($total/$page_size);
	if($page > $max_page)
	{
		$page = $max_page;
	}
	if($page < 1)
	{
		$page = 1;
	}
	if($page_size < 12)
	{
		$page_size = 12;
	}
	$start = ($page-1)*$page_size;
	$sql = "select `atten_id` from favorite where `user_id`={$user_id} order by favo_id desc limit $start,$page_size";
	$results = $db->get_results($sql);
	$ret = array();
	foreach($results as $row)
	{
		$uid = $row->atten_id;
		$sql = "select `user_id`,`user_name`,`img` from `user` where user_id='{$uid}'";
		$item = $db->get_row($sql);
		if($item->img == "")
		{
			$item->img = "http://placeholdit.imgix.net/~text?txtsize=26&txt=%E7%82%B9%E6%88%91%E4%B8%8A%E4%BC%A0&w=200&h=200";
		}
		$ret[] = $item;
	}
	return $ret;
}
//获取我的关注的总人数
function get_favorite_count($user_id)
{
	$db = $GLOBALS['db'];
	$sql = "select count(*) from `favorite` where `user_id`={$user_id}";
	$ret = $db->get_var($sql);
	return $ret;
}
//获取我的粉丝
function get_follow($user_id,$page=1,$page_size=12)
{
	$db = $GLOBALS['db'];
	$total = get_favorite_count($user_id);
	$max_page = ceil($total/$page_size);
	if($page > $max_page)
	{
		$page = $max_page;
	}
	if($page < 1)
	{
		$page = 1;
	}
	if($page_size < 12)
	{
		$page_size = 12;
	}
	$start = ($page-1)*$page_size;
	$sql = "select `follow_user` from follow where `user_id`={$user_id} order by follow_id desc limit $start,$page_size";
	$results = $db->get_results($sql);
	$ret = array();
	foreach($results as $row)
	{
		$uid = $row->follow_user;
		$sql = "select `user_id`,`user_name`,`img` from `user` where user_id={$uid}";
		$item = $db->get_row($sql);
		if($item->img == "")
		{
			$item->img = "http://placeholdit.imgix.net/~text?txtsize=26&txt=%E7%82%B9%E6%88%91%E4%B8%8A%E4%BC%A0&w=200&h=200";
		}
		$ret[] = $item;
	}
	return $ret;
}
//获取我的粉丝总人数
function get_follow_count($user_id)
{
	$db = $GLOBALS['db'];
	$sql = "select count(*) from `follow` where `user_id`={$user_id}";
	$ret = $db->get_var($sql);
	return $ret;
}

//获取冠军币数量
function get_champion($user_id)
{
	$db = $GLOBALS['db'];
	$sql = "select `champion` from `user` where `user_id`={$user_id}";
	$ret = $db->get_var($sql);
	return $ret;
}

//获取用户所在俱乐部
function get_club($user_id,$page,$page_size)
{
	$db = $GLOBALS['db'];
	$total = get_club_count($user_id);
	$max_page = ceil($total/$page_size);
	if($page > $max_page)
	{
		$page = $max_page;
	}
	if($page < 1)
	{
		$page = 1;
	}
	if($page_size < 12)
	{
		$page_size = 12;
	}
	$start = ($page-1)*$page_size;
	$sql = "select `club_id` from join_club where user_id={$user_id} order by join_id desc limit $start,$page_size";
	$results = $db->get_results($sql);
	$ret = array();
	foreach($results as $item)
	{
		$club_id = $item->club_id;
		$sql = "select `club_id`,`club_name`,`img` from club where club_id='{$club_id}'";
		$item = $db->get_row($sql);
		if($item->img == "")
		{
			$item->img = "http://placeholdit.imgix.net/~text?txtsize=26&txt=%E7%82%B9%E6%88%91%E4%B8%8A%E4%BC%A0&w=200&h=200";
		}
		$ret[] = $item;
	}
	return $ret;
}

//获取用户所在俱乐部总数
function get_club_count($user_id)
{
	$db = $GLOBALS['db'];
	$sql = "select count(*) from join_club where user_id={$user_id}";
	$ret = $db->get_var($sql);
	return $ret;
}
//获取用户角色
function get_role($user_id)
{
	$db = $GLOBALS['db'];
	$sql = "select role from user where user_id={$user_id}";
	$role = $db->get_var($sql);
	if(!$role)
	{
		return -2;//尚未认证身份	
	}
	else
	{
		$sql = "select role_name from role where role_id={$role}";
		$role = $db->get_var($sql);
		return $role;
	}
}

?>














