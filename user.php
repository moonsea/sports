<?php
	error_reporting(0);
	header("content-Type:text/html;charset=utf=8");
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
	//修改密码
	if($api == 'set_psw')
	{
		$user_id = $_POST['user_id'];
		$psw = $_POST['psw'];
		$token = $_POST['token'];
		if(is_login($token,$user_id))
		{
			if(check_pass_psw($user_id,$psw))
			{
				$psw_new = $_POST['psw_new'];
				$psw_new_confirm = $_POST['psw_new_confirm'];
				if($psw_new == $psw_new_confirm)
				{
					if(check_password($psw_new))
					{
						if(update_psw($user_id,$psw_new))
						{
							$ret['status'] = "1";
							$ret['error'] = "SUCCESS";
							$ret['data'] = 1;
						}
						else
						{
							$ret['status'] = "0";
							$ret['error'] = "服务器忙，请稍后重试";
							$ret['data'] = 0;
						}
					}
					else
					{
						$ret['status'] = "0";
						$ret['error'] = "新密码长度小于6位";
						$ret['data'] = 0;
					}
				}
				else
				{
					$ret['status'] = "0";
					$ret['error'] = "两次密码不一致";
					$ret['data'] = 0;
				}
			}
			else
			{
				$ret['status'] = "0";
				$ret['error'] = "原始密码错误";
				$ret['data'] = 0;
			}
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
	//意见反馈
	if($api=='feedback')
	{
		$user_id = $_POST['user_id'];
		$content = $_POST['content'];
		$ret = array();
		if($user_id>0 && strlen($content)>0)
		{
			$add_time = time();
			$sql = "insert into feedback(user_id,content,add_time,status)values($user_id,'$content','$add_time',0)";
			if($db->query($sql))
			{
				$ret['status'] = 1;
				$ret['error'] = 'SUCCESS';
				$ret['data'] = 1;
			}
			else
			{
				$ret['status'] = 0;
				$ret['error'] = '服务器忙，请稍后重试';
				$ret['data'] = 0;
			}
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '反馈信息不能为空';
			$ret['data'] = 0;
		}
		echo json_encode($ret);
		exit();
	}
	//关于项目
	if($api == 'about')
	{
		$ret = array();
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';
		$ret['data'] = '我是项目的介绍信息我是项目的介绍信息我是项目的介绍信息我是项目的介绍信息我是项目的介绍信息我是项目的介绍信息';
		echo json_encode($ret);
		exit();
	}
	//退出账户
	if($api == 'logout')
	{
		$user_id = $_POST['user_id'];
		$token = $_POST['token'];
		$ret = array();
		if(is_login($token,$user_id))
		{
			$sql = "update sessions set expiry=0 where userid={$user_id} and sesskey='{$token}'";
			if($db->query($sql))
			{
				$ret['status'] = 1;
				$ret['error'] = 'SUCCESS';
				$ret['data'] = 1;
			}
			else
			{
				$ret['status'] = 0;
				$ret['error'] = '服务器忙，请稍后重试';
				$ret['data'] = 0;
			}
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '您尚未登录或登录超时';
			$ret['data'] = 0;
		}
		echo json_encode($ret);
		exit();
	}
	//获取关注关系
	if($api == 'get_follow_realtion')
	{
		$user_id = $_POST['user_id'];
		$follow = $_POST['follow'];
		$ret = array();
		if(get_follow_relation($user_id,$follow))
		{
			$ret['status'] = 1;
			$ret['error'] = 'SUCCESS';
			$ret['data'] = 1;//已关注
		}
		else
		{
			$ret['status'] = 1;
			$ret['error'] = 'SUCCESS';
			$ret['data'] = 0;//未关注
		}
		echo json_encode($ret);
		exit();
	}


?>
