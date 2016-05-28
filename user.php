<meta charset="utf-8"/>
<?php
	define("SPORTS","YES");
	include_once("includes/init.php");
	include_once("includes/functions.php");
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
				$password = md5($password);
				$sql = "INSERT INTO user(user_name,password,mobile) VALUES ('新注册用户','$password','$phone')";
				$db->query($sql);
				$ret['status'] = 1;
				$ret['error'] = 'SUCCESS';
				echo json_encode($ret);
				exit();
			}
		}
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
