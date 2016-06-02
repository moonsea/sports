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
 		$data = $_POST['data'];

		$ret['data'] = get_search_user($data,$page,$page_size);//$db->get_results($sql);
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

 		$data = $_POST['data'];

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
 		$data = $_POST['data'];

		$ret['data'] = get_search_club($data,$page,$page_size);
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

 		$data = $_POST['data'];

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
 		$data = $_POST['data'];

		$ret['data'] = get_search_game($data,$page,$page_size);
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

 		$data = $_POST['data'];

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
 		$data = $_POST['data'];
 		$page = empty($_POST['page'])? 1:$_POST['page'];
 		$page_size = empty($_POST['page_size'])? 3:$_POST['page_size'];

		$ret['data'] = get_search_video($data,$page,$page_size);
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
 		$data = $_POST['data'];

		$ret['data'] = get_search_video_count($data);//$db->get_results($sql);
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
 * 获取搜搜用户数据
 * @param  [type]  $data      [用户查询数据]
 * @param  integer $page      [description]
 * @param  integer $page_size [description]
 * @return [type]             [description]
 */
function get_search_user($data,$page = 1, $page_size = 12)
{

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
function get_search_club($data,$page = 1, $page_size = 12)
{

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
function get_search_game($data, $page = 1, $page_size = 12)
{

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
function get_search_video($data, $page = 1, $page_size = 12)
{

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


?>
