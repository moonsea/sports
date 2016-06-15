<?php
	// error_reporting(0);

	/**
	 * 主页
	 */

	define("SPORTS","YES");
	include_once("includes/init.php");
	include_once("includes/functions.php");
	$api = $_POST["act"];
	$db = $GLOBALS['db'];

	/**
	 *	搜索-获取相关用户
	 */
	if($api == "search_user")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$page = $_POST['page'];
 		$page_size = $_POST['page_size'];

		if(empty($_POST['data']))
		{
			$ret['data'] = '搜索内容为空';
			echo json_encode($ret);
			exit();
		}
 		$data = trim($_POST['data']);
 		$user_id = empty($_POST['user_id'])? -1:$_POST['user_id'];

		$ret['data'] = get_search_user($data,$page,$page_size,$user_id);//$db->get_results($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();

	}

	/**
	 * 搜索-相关用户总数
	 * @var [type]
	 */
	if($api == 'search_user_count')
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$data = trim($_POST['data']);

		$ret['data'] = get_search_user_count($data);//$db->get_results($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}

	/**
	 * 搜索-相关俱乐部
	 * @var [type]
	 */
	if($api == "search_club")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$page = $_POST['page'];
 		$page_size = $_POST['page_size'];
 		$data = trim($_POST['data']);
 		$user_id = empty($_POST['user_id'])? -1:$_POST['user_id'];

		$ret['data'] = get_search_club($data,$page,$page_size,$user_id);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();

	}

	/**
	 * 搜搜-相关俱乐部总数
	 * @var [type]
	 */
	if($api == 'search_club_count')
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$data = trim($_POST['data']);

		$ret['data'] = get_search_club_count($data);//$db->get_results($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}

	/**
	 * 搜搜-相关比赛
	 * @var [type]
	 */
	if($api == "search_game")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$page = $_POST['page'];
 		$page_size = $_POST['page_size'];
 		$data = trim($_POST['data']);
 		$user_id = empty($_POST['user_id'])? -1:$_POST['user_id'];

		$ret['data'] = get_search_game($data,$page,$page_size,$user_id);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}

	/**
	 * 搜索-相关比赛总数
	 * @var [type]
	 */
	if($api == 'search_game_count')
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$data = trim($_POST['data']);

		$ret['data'] = get_search_game_count($data);//$db->get_results($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}

	/**
	 * 搜索-相关视频
	 * @var [type]
	 */
	if($api == "search_video")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

		if(empty($_POST['data']))
		{
			$ret['data'] = '查询内容为空';

			echo json_encode($ret);
			exit();
		}
 		$data = trim($_POST['data']);
 		$page = empty($_POST['page'])? 1:$_POST['page'];
 		$page_size = empty($_POST['page_size'])? 3:$_POST['page_size'];
 		$user_id = empty($_POST['user_id'])? -1:$_POST['user_id'];

		$ret['data'] = get_search_video($data,$page,$page_size,$user_id);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}

	/**
	 * 搜索-相关视频总数
	 * @var [type]
	 */
	if($api == 'search_video_count')
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

		if(empty($_POST['data']))
		{
			$ret['data'] = '查询内容为空';

			echo json_encode($ret);
			exit();
		}
 		$data = trim($_POST['data']);

		$ret['data'] = get_search_video_count($data);//$db->get_results($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}


	/**
	 * 热门用户推荐
	 * @var [type]
	 */
	if($api == "recommend_user")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$page = empty($_POST['page'])? 1:$_POST['page'];
 		$page_size = empty($_POST['page_size'])? 3:$_POST['page_size'];

		$ret['data'] = get_recommend_user($page,$page_size);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}


	/**
	 *
	 * 推荐用户总数
	 * @var [type]
	 */
	if($api == 'recommend_user_count')
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

		$ret['data'] = get_recommend_user_count();//$db->get_results($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}


	/**
	 *
	 * 推荐比赛
	 * @var [type]
	 */
	if($api == "recommend_game")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$page = empty($_POST['page'])? 1:$_POST['page'];
 		$page_size = empty($_POST['page_size'])? 3:$_POST['page_size'];

		$ret['data'] = get_recommend_game($page,$page_size);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}


	/**
	 *
	 * 推荐比赛总数
	 * @var [type]
	 */
	if($api == 'recommend_game_count')
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

		$ret['data'] = get_recommend_game_count();//$db->get_results($sql);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}

	/**
	 *
	 * 热门搜索内容
	 * @var [type]
	 */
	if($api == "search_hot")
	{
        $ret = array();
		$ret['status'] = 0;
		$ret['error'] = '数据获取失败';

 		$page = empty($_POST['page'])? 1:$_POST['page'];
 		$page_size = empty($_POST['page_size'])? 3:$_POST['page_size'];

		$ret['data'] = get_search_hot($page,$page_size);
		$ret['status'] = 1;
		$ret['error'] = 'SUCCESS';

		echo json_encode($ret);
		exit();
	}


/**
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 * 功能函数
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */

/**
 *
 * 记录搜索内容，并更新数据库
 * @param  [type] $data [搜索内容]
 * @param  [type] $user_id [搜索用户，默认:匿名用户]
 * @return [type]       [description]
 */
function search_record($data,$user_id=-1)
{
	$db = $GLOBALS['db'];
	$sql = "INSERT INTO search_record (search_content,search_user,search_time) ".
			" VALUES(".
			" '$data', '$user_id', ".
			"'".time()."' ".
			")";
	$db->query($sql);
}


/**
 * 获取搜搜用户数据
 * @param  [type]  $data      [用户查询数据]
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_search_user($data,$page = 1, $page_size = 12, $user_id= -1)
{

	search_record($data,$user_id);

 	$db = $GLOBALS['db'];
 	$total = get_search_user_count($data);
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

	$sql = "select user_id, user_name, img as user_img ".
						" from user ".
						" where user_name like '%".$data."%' ".
						" or mobile like '%".$data."%' ".
						" or location like '%".$data."%' ".
						" order by rank ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 * 获取搜索用户总数
 * @param  [type] $data [用户查询数]
 * @return [type]       [description]
 */
function get_search_user_count($data)
{
 	$db = $GLOBALS['db'];
	$sql = "SELECT count(*) FROM user WHERE user_name like '%".$data."%' ".
			" OR mobile LIKE '%".$data."%'".
			" OR location LIKE '%".$data."%'";
	$count = $db->get_var($sql);
	return $count;
}

/**
 * 获取搜索-相关俱乐部
 * @param  [type]  $data      [description]
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_search_club($data,$page = 1, $page_size = 12, $user_id = -1)
{
	search_record($data,$user_id);

 	$db = $GLOBALS['db'];
 	$total = get_search_club_count($data);
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

	$sql = "select club_id, club_name, img as club_img ".
						" from club ".
						" where club_name like '%".$data."%' ".
						" or club_id like '%".$data."%' ".
						" order by rank ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 * 获取搜索-相关俱乐部总数
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function get_search_club_count($data)
{
 	$db = $GLOBALS['db'];
	$sql = "SELECT count(*) FROM club ".
			" WHERE club_name like '%".$data."%' ".
			" or club_id like '%".$data."%' ";
	$count = $db->get_var($sql);
	return $count;
}

/**
 * 获取相关比赛信息
 * @param  [type]  $data      [用户查询数据]
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_search_game($data, $page = 1, $page_size = 12, $user_id = -1)
{
	search_record($data,$user_id);

 	$db = $GLOBALS['db'];
 	$total = get_search_game_count($data);
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

	$sql = "select game_id, game_name, game_img ".
						" from game ".
						" where game_name like '%".$data."%' ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 * 获取相关比赛总数
 * @param  [type] $data [用户查询数据]
 * @return [type]       [description]
 */
function get_search_game_count($data)
{
 	$db = $GLOBALS['db'];
	$sql = "SELECT count(*) FROM game ".
			" WHERE game_name like '%".$data."%' ";
	$count = $db->get_var($sql);
	return $count;
}

/**
 * 获取查询相关比赛
 * @param  [type]  $data      [description]
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_search_video($data, $page = 1, $page_size = 12, $user_id = -1)
{
	search_record($data,$user_id);

 	$db = $GLOBALS['db'];
 	$total = get_search_video_count($data);
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

	$sql = "select id as video_id, name as video_name, video_cover ".
			" from game ".
			" where name like '%".$data."%' ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 * 获取相关比赛总数
 * @param  [type] $data [用户查询数据]
 * @return [type]       [description]
 */
function get_search_video_count($data)
{
 	$db = $GLOBALS['db'];
	$sql = "SELECT count(*) FROM video ".
			" WHERE name like '%".$data."%' ";
	$count = $db->get_var($sql);
	return $count;
}

/**
 *
 * 获取热门推荐用户
 *------------------------------------------------
 * 根据用户等级(rank)进行推荐
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_recommend_user( $page = 1, $page_size = 3)
{

 	$db = $GLOBALS['db'];
 	$total = get_recommend_user_count();
 // 	$max_page = ceil($total/$page_size);

 // 	if($page > $max_page)
 // 	{
 // 		$page = $max_page;
 // 	}
 	if($page < 1)
 	{
 		$page = 1;
 	}

 	if($page_size < 3)
 	{
 		$page_size = 3;
 	}

 	$start = ($page-1)*$page_size;

	$sql = "SELECT user_id, user_name, img as user_img ".
			" FROM user ".
			" WHERE is_hot = '1' AND role = '0'".
			" ORDER BY rank DESC ";

	/* 使用非热门用户补全 */
	if($total < $page*$page_size)
	{
		$sql .= " UNION ".
				" SELECT user_id, user_name, img ad user_img ".
				" FROM user ".
				" WHERE is_hot = '0' AND role = '0'".
				" ORDER BY rank DESC ";

	}

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 *
 * 获取推荐用户总数
 * @return [type] [description]
 */
function get_recommend_user_count()
{
	$db = $GLOBALS['db'];
	$sql = "SELECT count(*) FROM user WHERE is_hot = '1' AND role = '0'";
	$count = $db->get_var($sql);
	return $count;
}

/**
 *
 * 获取热门推荐比赛
 *-------------------------------------
 * 根据比赛参赛人数
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_recommend_game( $page = 1, $page_size = 3)
{

 	$db = $GLOBALS['db'];
 	$total = get_recommend_game_count();
 	$max_page = ceil($total/$page_size);

 // 	if($page > $max_page)
 // 	{
 // 		$page = $max_page;
 // 	}
 	if($page < 1)
 	{
 		$page = 1;
 	}

 	if($page_size < 3)
 	{
 		$page_size = 3;
	}

 	$start = ($page-1)*$page_size;

	$sql = "SELECT game_id, game_name, game_img ".
			" FROM game ".
			" WHERE is_hot = '1' ".
			" ORDER BY game_id ";

	if($total < $page*$page_size)
	{
		$sql .= " UNION ".
				" SELECT game_id, game_name, game_img ".
				" FROM game ".
				" WHERE is_hot = '0' ".
				" ORDER BY game_id ";
	}

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 *
 * 获取热门推荐比赛总数
 * @return [type] [description]
 */
function get_recommend_game_count()
{
	$db = $GLOBALS['db'];
	$sql = "SELECT count(*) FROM game WHERE is_hot = '0'";
	$count = $db->get_var($sql);
	return $count;
}

/**
 *
 * 获取热门搜索内容
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_search_hot( $page = 1, $page_size = 3)
{

 	$db = $GLOBALS['db'];
 	$total = get_search_hot_count();
 	$max_page = ceil($total/$page_size);

 	if($page > $max_page)
 	{
 		$page = $max_page;
 	}
 	if($page < 1)
 	{
 		$page = 1;
 	}

 	if($page_size < 3)
 	{
 		$page_size = 3;
	}

 	$start = ($page-1)*$page_size;

	$sql = "SELECT search_id , search_content ".
			" FROM search_record ".
			" GROUP BY search_content ".
			" ORDER BY count(*) DESC ";

	$sql .= " LIMIT $start,$page_size ";

	$results = $db->get_results($sql);

	return $results;
}

/**
 *
 * 获取热门搜索总数
 * @return [type] [description]
 */
function get_search_hot_count()
{
	$db = $GLOBALS['db'];
	$sql = "SELECT count(*) FROM (SELECT * FROM search_record GROUP BY search_content) a";
	$count = $db->get_var($sql);
	return $count;
}



?>
