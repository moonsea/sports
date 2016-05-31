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

	/**
	 * 关注
	 * @var [type]
	 */
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

	/**
	 * 关注总数
	 * @var [type]
	 */
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

	/**
	 * 获取百科视频
	 * @var [type = '0' ： 获取标准动作视频]
	 * @var [type = '0' ： 获取原创动作视频]
	 */
	if($api == 'wiki')
	{

		$ret = array();

		$type = $_POST['type'];

		$ret['data'] = get_wiki_video($type);
		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();

	}

	/**
	 * 获取百科视频总数
	 * @var [type = '0' ： 获取标准动作视频]
	 * @var [type = '0' ： 获取原创动作视频]
	 */
	if($api == 'wiki_count')
	{
		$ret = $_POST['type'];

		$ret['data'] = get_wiki_video_count($type);

		$ret['status'] = '1';
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		ext();
	}

	/**
	 * 获取发现-体育明星-普通用户
	 * @var [`0`:普通用户,`1`:专家用户（体育明星）]
	 */
	if($api == ‘discovery’)
	{

		$ret = array();

		$type = $_POST['type'];

		$ret['data'] = get_user($type);
		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

	/**
	 * 获取发现用户列表总数
	 * @var [`0`:普通用户,`1`:专家用户（体育明星）]
	 */
	if($api == 'discovery_count')
	{
		$ret = array();
		$ret['status'] = '0';
		$ret['error'] = "数据获取失败";

		$type = $_POST['type'];

		$ret['data'] = get_user_count($type);

		$ret['status'] = '1';
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();

	}

	/**
	 * 获取首页-发现-俱乐部列表
	 * @var [type]
	 */
	if($api == 'dis_club')
	{
		$ret = array();
		$ret['status'] = '0';
		$ret['error'] = '数据获取失败';

		$ret['data'] = get_dis_club();

		$ret['status'] = '1';
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}

	/**
	 * 获取首页-发现-俱乐部总数
	 * @var [type]
	 */
	if($api == 'dis_club_count')
	{
		$ret = array();
		$ret['status'] = '0';
		$ret['error'] = '数据获取失败';

		$ret['data'] = get_dis_club_count();

		$ret['status'] = '1';
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}


/**
 * 功能函数
 */

/**
 * 获取关注视频列表
 * @param  [type]  $user_id   [当前登录用户id]
 * @param  integer $page      [页数]
 * @param  integer $page_size [每页大小description]
 * @return [type]             [description]
 */
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

	$sql = "SELECT a.user_id,a.user_name, a.img asd user_img, b.id as video_id, b.desc as video_desc, b.last_time as video_time, b.video_path ".
					" FROM user a LEFT JOIN video b on a.user_id = b.user_id ".
					" WHERE a.user_id IN ".
					" (SELECT atten_id FROM favorite WHERE user_id = '" .$user_id. "') ".
					" ORDER BY last_time DESC";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
 }

/**
 * 获取关注视频总数
 * @param  [type] $user_id [登陆用户id]
 * @return [type]          [description]
 */
function get_favorite_count($user_id)
{

	$sql = "SELECT count(*) FROM video WHERE user_id IN ";

	$sql .= " (SELECT atten_id FROM favorite WHERE user_id = '".$user_id."')";

	$count = $db->get_var($sql);

	return $count;

}

/**
 * 获取百科视频
 * @param  string $type [`0`:获取标准动作,`1`:获取原创动作]
 * @return [type]       [description]
 */
function get_wiki_video($type = '0')
{
	$db = $GLOBALS['db'];
	$total = get_wiki_video_count($type);
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

	$sql = "SELECT id ad video_id, name ad video_name, praise_count, desc as video_desc, video_path ".
					" FROM video ".
					" WHERE class_id = '".$type."' ".
					" ORDER BY praise_count DESC";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;

}

/**
 * 获取百科视频总数
 * @param  string $type [`0`:获取标准动作,`1`:获取原创动作]
 * @return [type]       [description]
 */
function get_wiki_video_count($type = ‘0’)
{
	$sql = "SELECT count(*) FROM video WHERE class_id = '".$type."'";

	$count = $db->get_var($sql);

	return $count;

}

/**
 * 获取用户列表
 * @param  string $type [`0`:普通用户,`1`:专家用户（体育明星）]
 * @return [type]       [description]
 */
function get_user($type = '0')
{

	$db = $GLOBALS['db'];
	$total = get_user_count($type);
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

	$sql = "SELECT user_id, user_name, img as user_img ".
					" FROM user ".
					" WHERE role = '".$type."' ".
					" ORDER BY user_id ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;

}

/**
 * 获取用户列表总数
 * @param  string $type [`0`:普通用户,`1`:专家用户（体育明星）]
 * @return [type]       [description]
 */
function get_user_count($type = '0')
{
	$sql = "SELECT count(*) FROM user WHERE role_id = '".$type."'";
	$count = $db->get_var($sql);

	return $count;
}

/**
 * 获取俱乐部列表
 * @return boolean [description]
 */
function get_dis_club()
{

	$db = $GLOBALS['db'];
	$total = get_dis_club_count();
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

	$sql = "SELECT club_id, club_name, img as club_img ".
					" FROM club ".
					" ORDER BY rank DESC ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;

}

/**
 * 获取俱乐部总数
 * @return boolean [description]
 */
function get_dis_club_count()
{
	$sql = "SELECT count(*) FROM club";
	$count = $db->get_var($sql);
	return $count;
}


?>
