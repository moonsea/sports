<meta charset="utf-8"/>
<?php

	/**
	 * 主页
	 */

	define("SPORTS","YES");
	include_once("includes/init.php");
	include_once("includes/functions.php");
	$api = $_REQUEST["act"];

	/**
	 *	精选
	 */
	if($api == "hot")
	{
		$ret = array();

		$sql = "select a.id as video_id,a.name as video_name, a.praise_count, count(b.comment_id) as comment_count, a.desc as video_desc ".
						"from video a left join comment b on a.id = b.video_id ";

		if($db->query($sql))
		{
			$ret['status'] = 1;
			$ret['error'] = 'SUCCESS';
			$ret['data'] = $db->get_results($sql);
		}
		else{
			$ret['status'] = 0;
			$ret['error'] = '数据获取失败';
			$ret['data'] = '';
		}
		echo json_encode($ret);
		exit();

	}

	//登录
	if($api == 'login')
	{
		$phone = $_POST['name'];
		$password = $_POST['password'];
		if(check_login($phone,$password))
		{
			$ret = array();
			$ret["status"] = 1;
			$ret["error"] = "SUCCESS";
			$ret["token"] = md5($phone);
			update_session($ret["token"]);
			$ret["data"] = get_user_info($phone);
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


?>
