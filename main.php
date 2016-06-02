<?php
	error_reporting(0);

	/**
	 * 主页
	 */

	define("SPORTS","YES");
	include_once("includes/init.php");
	include_once("includes/functions.php");
	$api = $_REQUEST["act"];
	$db = $GLOBALS['db'];

	/**
	 *	精选-用户视频
	 */
	if($api == "hot_user")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$page = $_POST['page'];
 		$page_size = $_POST['page_size'];

		$ret['data'] = get_hot_user($page,$page_size);//$db->get_results($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';
		// var_dump($db->get_results($sql));
		// exit();

		echo json_encode($ret);
		exit();

	}

	/**
	 * 获取精选-比赛视频
	 * @var [type]
	 */
	if($api == "hot_game")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$page = $_POST['page'];
 		$page_size = $_POST['page_size'];

		$ret['data'] = get_hot_game($page,$page_size);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit()	;

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
 			$ret['data'] = get_fav($user_id,$page,$page_size);
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
 			$ret['data'] = get_fav_count($user_id);
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

		$page = $_POST['page'];
 		$page_size = $_POST['page_size'];

		$ret['data'] = get_wiki_video($type,$page,$page_size);
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
		$ret['status'] = "0";
		$ret['error'] = "数据获取失败";

		$type = $_POST['type'];
		$page = $_POST['page'];
 		$page_size = $_POST['page_size'];

		$ret['data'] = get_user($type,$page,$page_size);
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

		$page = $_POST['page'];
 		$page_size = $_POST['page_size'];

		$ret['data'] = get_dis_club($page,$page_size);

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
 * 获取精选-用户视频列表
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_hot_user($page = 1, $page_size = 12)
{

 	$db = $GLOBALS['db'];
 	$total = get_hot_user_count();
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

	$sql = "select a.id as video_id, 'a.video_description' as video_desc, a.video_cover, b.user_id,b.user_name,b.img as user_img ".
						"from video a left join user b on a.user_id = b.user_id ".
						" where a.class = '1' ".
						" order by a.praise_count ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 * 获取精选-用户视频总数
 * @return [type] [description]
 */
function get_hot_user_count()
{
 	$db = $GLOBALS['db'];
	$sql = "SELECT count(*) FROM video WHERE class = '1'";
	$count = $db->get_var($sql);
	return $count;
}

/**
 * 获取精选-比赛视频列表
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_hot_game($page = 1, $page_size = 12)
{

 	$db = $GLOBALS['db'];
 	$total = get_hot_game_count();
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

	$sql = "select a.video_id, a.video_cover, b.game_id, c.game_name ".
			"from game_video a left join video b on a.video_id = b.video_id ".
			" left join game c on a.game_id = c.game_id ".
			" where class = '1'".
			" order by b.praise_count ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 * 获取精选-比斯视频总数
 * @return [type] [description]
 */
function get_hot_game_count()
{
	$db = $GLOBALS['db'];
	$sql = "SELECT count('a.*') FROM game_video a left join video b on a.video_id = b.video_id WHERE b.class = '1'";
	return $count;
	$count = $db->get_var($sql);
}

/**
 * 获取关注视频列表
 * @param  [type]  $user_id   [当前登录用户id]
 * @param  integer $page      [页数]
 * @param  integer $page_size [每页大小description]
 * @return [type]             [description]
 */
 function get_fav($user_id,$page=1,$page_size=12)
 {
 	$db = $GLOBALS['db'];
 	$total = get_fav_count($user_id);
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

	$sql = "SELECT a.user_id,a.user_name, a.img as user_img, b.id as video_id, b.description as video_desc, b.last_time as video_time, b.video_cover ".
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
function get_fav_count($user_id)
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
function get_wiki_video($type = '0',$page=1,$page_size=12)
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

	$sql = "SELECT a.video_id, a.user_id, b.user_name, c.praise_count, c.description as video_desc, c.video_cover ".
					" FROM wiki a LEFT JOIN user b ON a.user_id = b.user_id ".
					" LEFT JOIN video c ON a.video_id = c.id ".
					" WHERE a.type = '".$type."' ".
					" ORDER BY c.praise_count DESC";

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
	$db = $GLOBALS['db'];

	$sql = "SELECT count(*) FROM wiki WHERE type = '".$type."'";

	$count = $db->get_var($sql);

	return $count;

}

/**
 * 获取用户列表
 * @param  string $type [`0`:普通用户,`1`:专家用户（体育明星）]
 * @return [type]       [description]
 */
function get_user($type = '0',$page = 1, $page_size =12)
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
function get_dis_club($page = 1, $page_size =12)
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
