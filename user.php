<?php
	error_reporting(0);
	include("includes/init.php");
	include("includes/functions.php");
	$api = $_POST["act"];
	
	//注册新用户
	if($api == "regist")
	{
		$ret = array();
		$phone = $_POST["phone"];
		$password = $_POST["password"];
		if(!check_phone($phone))
		{
			$ret["status"] = 0;
			$ret["error"] = "非法的手机号码";
			echo json_encode($ret);
			exit();
		}
		else
		{
			if(!check_password($password))
			{
				$ret["status"] = 0;
				$ret["error"] = "密码长度必须大于6位";
				echo json_encode($ret);
				exit();
			}
			else
			{
				if(check_phone_available($phone))
				{
					$password = md5($password);
					$sql = "INSERT INTO `user`(user_name,password,mobile) VALUES ('新注册用户','$password','$phone')";
					$db->query($sql);
					$ret['status'] = 1;
					$ret['error'] = 'SUCCESS';
					echo json_encode($ret);
					exit();
				}
				else
				{
					$ret["status"] = 0;
					$ret["error"] = "该手机号码已经注册了";
					echo json_encode($ret);
					exit();
				}
			}
		}
	}
	
	//登录
	if($api == 'login')
	{
		$phone = $_POST['name'];
		$password = $_POST['password'];
		if(login($phone,$password))
		{
			$ret = array();
			$ret["status"] = 1;
			$ret["error"] = "SUCCESS";
			$ret["token"] = md5($phone);
			$ret["data"] = get_user_info($phone);
			update_session($ret["token"],$ret['data']->user_id);
			echo json_encode($ret);
			exit();
		}
		else
		{
			$ret =array();
			$ret["status"] = 0;
			$ret["error"] = "登录失败";
			$ret["token"] = 0;
			$ret["data"] = 0;
			echo json_encode($ret);
			exit();
		}
	}
	//获取用户详细信息
	if($api == 'info')
	{
		$token = $_POST['token'];
		$user_id = $_POST['user_id'];
		$ret = array();
		if(is_login($token,$user_id))
		{
			$ret['status'] = "1";
			$ret['error'] = "SUCCESS";
			$ret['data'] = get_user_info_by_id($user_id);
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '登录超时或未登录';
			$ret['data'] = 0;
		}
		echo json_encode($ret);
		exit();
	}
	//我的关注
	if($api == 'favorite')
	{
		$token = $_POST['token'];
		$user_id = $_POST['user_id'];
		$page = $_POST['page'];
		$page_size = $_POST['page_size'];
		$ret = array();
		if(is_login($token,$user_id))
		{
			$ret['status'] = "1";
			$ret['error'] = "SUCCESS";
			$ret['data'] = get_favorite($user_id,$page,$page_size);
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '登录超时或未登录';
			$ret['data'] = -1;
		}
		echo json_encode($ret);
		exit();
	}
	//我的关注的总人数
	if($api == 'favorite_count')
	{
		$token = $_POST['token'];
		$user_id = $_POST['user_id'];
		$ret = array();
		if(is_login($token,$user_id))
		{
			$ret['status'] = "1";
			$ret['error'] = "SUCCESS";
			$ret['data'] = get_favorite_count($user_id);
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '登录超时或未登录';
			$ret['data'] = -1;
		}
		echo json_encode($ret);
		exit();
	}
	//我的粉丝
	if($api == 'follow')
	{
		$token = $_POST['token'];
		$user_id = $_POST['user_id'];
		$page = $_POST['page'];
		$page_size = $_POST['page_size'];
		$ret = array();
		if(is_login($token,$user_id))
		{
			$ret['status'] = "1";
			$ret['error'] = "SUCCESS";
			$ret['data'] = get_follow($user_id,$page,$page_size);
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '登录超时或未登录';
			$ret['data'] = -1;
		}
		echo json_encode($ret);
		exit();
	}
	//我的粉丝的总人数
	if($api == 'follow_count')
	{
		$token = $_POST['token'];
		$user_id = $_POST['user_id'];
		$ret = array();
		if(is_login($token,$user_id))
		{
			$ret['status'] = "1";
			$ret['error'] = "SUCCESS";
			$ret['data'] = get_follow_count($user_id);
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '登录超时或未登录';
			$ret['data'] = -1;
		}
		echo json_encode($ret);
		exit();
	}
	//获取冠军币
	if($api == 'get_champion')
	{
		$token = $_POST['token'];
		$user_id = $_POST['user_id'];
		$ret = array();
		if(is_login($token,$user_id))
		{
			$ret['status'] = "1";
			$ret['error'] = "SUCCESS";
			$ret['data'] = get_champion($user_id);
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '登录超时或未登录';
			$ret['data'] = -1;
		}
		echo json_encode($ret);
		exit();
	}
	//获取用户等级
	if($api == 'get_level')
	{
		$user_id = $_POST['user_id'];
		$sql = "select `rank` from user where user_id='{$user_id}'";
		$rank = $db->get_var($sql);
		$ret = array();
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';
		$ret['data'] = $rank;
		echo json_encode($ret);
		exit();
	}
	//获取用户所在俱乐部
	if($api == 'get_club')
	{
		$user_id = $_POST['user_id'];
		$page = $_POST['page'];
		$page_size = $_POST['page_size'];
		$ret = array();
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';
		$ret['data'] = get_club($user_id,$page,$page_size);
		echo json_encode($ret);
		exit();
	}
	//获取用户所在俱乐部的总数
	if($api == 'get_club_count')
	{
		$user_id = $_POST['user_id'];
		$ret = array();
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';
		$ret['data'] = get_club_count($user_id);
		echo json_encode($ret);
		exit();
	}
	//获取用户角色
	if($api == 'get_role')
	{
		$user_id = $_POST['user_id'];
		$ret = array();
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';
		$ret['data'] = get_role($user_id);
		echo json_encode($ret);
		exit();
	}
?>














