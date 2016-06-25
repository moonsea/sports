<?php
error_reporting(0);
include("includes/init.php");
include("includes/functions.php");
$api = $_POST["act"];

//关注
if($api == 'follow')
{
	$user_id = $_POST['user_id'];
	$follow = $_POST['follow'];
	$token = $_POST['token'];
	$ret = array();
	if(is_login($token,$user_id))
	{
		if($follow > 0)
		{
			if($follow == $user_id)
			{
				$ret['status'] = 0;
				$ret['error'] = '您不能关注自己';
				$ret['data'] = 0;
			}
			else
			{
				$sql = "insert into favorite(user_id,atten_id)values($user_id,$follow)";
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
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '参数违法';
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
//获取百科收录数
if($api == 'wiki')
{
	$user_id = $_POST['user_id'];
	$sql = "select count(*) from wiki where user_id={$user_id}";
	$ret = array();
	$ret['status']	= 1;
	$ret['error'] = 'SUCCESS';
	$ret['data'] = $db->get_var($sql);
	echo json_encode($ret);
	exit();
}
//更新头像
if($api == 'update_logo')
{
	$user_id = $_POST['user_id'];
	$token = $_POST['token'];
	$user_img = $_POST['user_img'];
	$ret = array();
	if(is_login($token,$user_id))
	{
		$sql = "update user set img='{$user_img}' where user_id={$user_id}";
		if($db->query($sql))
		{
			$ret['status'] = 1;
			$ret['error'] = 'SUCCESS';
			$ret['data'] = 1;
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '服务器忙，请稍后再试';
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
//更新用户名和签名
if($api == 'update_nick')
{
	$user_id = $_POST['user_id'];
	$token = $_POST['token'];
	$nick = $_POST['nick'];
	$sign = $_POST['sign'];
	$ret = array();
	if(is_login($token,$user_id))
	{
		$sql = "update user set `user_name`='{$nick}',`desc`='{$sign}' where user_id={$user_id}";
		if($db->query($sql))
		{
			$ret['status'] = 1;
			$ret['error'] = 'SUCCESS';
			$ret['data'] = 1;
		}
		else
		{
			$ret['status'] = 0;
			$ret['error'] = '服务器忙，请稍后再试';
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
//举报
if($api == 'report')
{
	$video_id = $_POST['video_id'];
	$sql = "insert into report(video_id)values('$video_id')";
	$db->query($sql);
	$ret = array();
	$ret['status'] = 1;
	$ret['error'] = 'SUCCESS';
	$ret['data'] = 1;
	echo json_encode($ret);
	exit();
}
//获取视频
if($api == 'del')
{
	$video_id = $_POST['video_id'];
	$user_id = $_POST['user_id'];
	$token = $_POST['token'];
	$ret = array();
	if(is_login($token,$user_id))
	{
		$sql = "delete from `video` where id='$video_id' and user_id='$user_id'";
		$db->query($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';
		$ret['data'] = 1;
	}
	else
	{
		$ret['status'] = 0;
		$ret['error'] = '尚未登录或登录超时';
		$ret['data'] = 0;
	}
	echo json_encode($ret);
	exit();
}

?>













