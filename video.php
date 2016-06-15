<?php
	error_reporting(0);

	/**
	 * 主页
	 */

	define("SPORTS","YES");
	include_once("includes/init.php");
	include_once("includes/functions.php");
	$api = $_POST["act"];

	/**
	 *	上传视频
	 */
	if($api == "upload")
	{
		$token = $_POST['token'];
		$user_id = $_POST['user_id'];

		$ret = array();
		$ret['status'] = "0";

		if(is_login($token,$user_id))
		{
			$type = empty($_POST['type'])? "0":trim($_POST['type']);
			$description = empty($_POST['description'])? "":trim($_POST['description']);
			$detail = empty($_POST['detail'])? "":trim($_POST['detail']);
			$video_name = empty($_POST['video_name'])? "":trim($_POST['video_name']);

			if(empty($_POST['video_path']))
			{
				$ret['error'] = '未传入视频路径';
				$ret['data'] = 0;
				echo json_encode($ret);
				exit();
			}
			$video_path = trim($_POST['video_path']);

			if(empty($_POST['video_cover']))
			{
				$ret['error'] = '未传入视频封面';
				$ret['data'] = 0;
				echo json_encode($ret);
				exit();
			}
			$video_cover = trim($_POST['video_cover']);


			/* 普通视频 */
			if($type == '0')
			{
				$ret['data'] = upload_video($user_id, $video_name, $detail, $description, $video_path, $video_cover);
			}
			elseif ($type == '1') {

				if(empty($_POST['game_id']))
				{
					$ret['error'] = '未传入比赛id';
					$ret['data'] = 0;
					echo json_encode($ret);
					exit();
				}
				$game_id = trim($_POST['game_id']);
				$video_type = empty($_POST['video_type'])? "0":trim($_POST['video_type']);

				$ret['data'] = upload_video($user_id, $video_name, $detail, $description, $video_path, $video_cover, $game_id, $video_type);
			}

			$ret['status'] = "1";
			$ret['error'] = "SUCCESS";
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

	/**
	 *
	 * 视频信息
	 * @var [type]
	 */
	if($api == "get_video_info")
	{

		$ret = array();
		$ret['status'] = "0";
		$ret['error'] = '视频信息获取失败';
		$ret['data'] = 0;

		if(empty([$_POST['video_id']]))
		{
			$ret['error'] = '未传入视频id';
			$ret['data'] = 0;
			echo json_encode($ret);
			exit();
		}
		$video_id = trim($_POST['video_id']);

		$ret['data'] = get_video_info($video_id);

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

	/**
	 *
	 * 比赛视频列表
	 * @var [type:'0':'训练视频','1':'参赛视频']
	 */
	if($api == "get_game_video")
	{
		$token = $_POST['token'];
		$user_id = $_POST['user_id'];

		$ret = array();
		$ret['status'] = "0";

		if(is_login($token,$user_id))
		{

			if(empty($_POST['game_id']))
			{
				$ret['error'] = '未传入比赛id';
				$ret['data'] = 0;
				echo json_encode($ret);
				exit();
			}
			$game_id = trim($_POST['game_id']);

			$type = empty($_POST['type'])? "0":trim($_POST['type']);//0:训练视频，1:参赛视频

			$page = empty($_POST['page'])? "1":trim($_POST['page']);
			$page_size = empty($_POST['page_size'])? "6":trim($_POST['page_size']);

			$ret['data'] = get_game_video($game_id, $type, $page, $page_size);

			$ret['status'] = "1";
			$ret['error'] = "SUCCESS";
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

	/**
	 *
	 * 比赛视频总数
	 * @var [type:'0':'训练视频','1':'参赛视频']
	 */
	if($api == "get_game_video_count")
	{

		$ret = array();
		$ret['status'] = "0";
		$ret['error'] = '比赛视频总数获取失败';
		$ret['data'] = 0;

		if(empty($_POST['game_id']))
		{
			$ret['error'] = '未传入比赛id';
			$ret['data'] = 0;
			echo json_encode($ret);
			exit();
		}
		$game_id = trim($_POST['game_id']);

		$type = empty($_POST['type'])? "0":trim($_POST['type']);//0:训练视频，1:参赛视频

		$ret['data'] = get_game_video_count($game_id, $type);

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

	/**
	 * 普通视频-相关视频
	 * @var [type]
	 */
	if($api == "get_related_video")
	{
		$ret = array();
		$ret['status'] = "0";

		if(empty($_POST['video_id']))
		{
			$ret['error'] = '未传入视频id';
			$ret['data'] = 0;
			echo json_encode($ret);
			exit();
		}
		$video_id = trim($_POST['video_id']);

		$page = empty($_POST['page'])? "1":trim($_POST['page']);
		$page_size = empty($_POST['page_size'])? "8":trim($_POST['page_size']);

		$ret['data'] = get_related_video($video_id, $page, $page_size);

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

	/**
	 *++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 功能函数
	 *
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 */

	 /**
	  *
	  * 上传用户拍摄视频
	  * @param  [type]  $user_id     [用户id]
	  * @param  [type]  $detail      [视频详细信息]
	  * @param  [type]  $description [视频简介]
	  * @param  [type]  $video_path  [视频路径]
	  * @param  [type]  $video_cover [视频封面]
	  * @param  integer $game_id     [比赛id]
	  * @param  integer $video_type  [视频类型:'0':训练视频,'1':参赛视频]
	  * @return [type]               [description]
	  */
	 function upload_video($user_id, $video_name, $detail, $description, $video_path, $video_cover, $game_id = -1, $video_type = 0)
	 {
		$db = $GLOBALS['db'];
		$sql = "INSERT INTO video ( name, user_id,detail, play_count, praise_count, add_time, last_time, description, class, video_path, video_cover) ".
				" VALUES(".
				" '$video_name', '$user_id', '$detail', '0', '0', ".
				"'".time()."', '".time()."', ".
				"'$description', '0', '$video_path', '$video_cover'".
				")";
		$db->query($sql);

		$video_id = mysql_insert_id();

		if($game_id != -1 && $video_id != 0)
		{
			$sql = "INSERT INTO game_video (video_id, game_id, video_type) ".
					"VALUES(".
					" '$video_id', '$game_id', '$video_type'".
					")";
			$db->query($sql);
		}

		return $video_id;
	 }

	 /**
	  *
	  * 获取视频信息
	  * @param  [type] $video_id [description]
	  * @return [type]           [description]
	  */
	 function get_video_info($video_id)
	 {
		$db = $GLOBALS['db'];
		$sql = "SELECT id as video_id, name as video_name, description as video_desc, detail as video_detail, ".
				" play_count, praise_count, add_time, last_time, class as video_class, video_path ".
				" FROM video ".
				" WHERE id = '$video_id'";
		$sql .= " LIMIT 1 ";

		$results = $db->get_row($sql);

		return $results;

	 }

	 /**
	  *
	  * 获取比赛视频
	  * @param  [type]  $game_id   [description]
	  * @param  integer $type      [0:训练视频,1:参赛视频]
	  * @param  integer $page      [description]
	  * @param  integer $page_size [description]
	  * @return [type]             [description]
	  */
	 function get_game_video($game_id, $type = 0, $page = 1, $page_size = 6)
	 {
		$db = $GLOBALS['db'];
		$total = get_game_video_count($game_id);
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

		$sql = "SELECT a.video_id, b.video_name, b.video_cover, b.description as video_desc, b.user_id, c.user_name ".
				" FROM game_video a inner join video b on a.video_id = b.id left join user c on b.user_id = c.user_id ".
				" WHERE a.game_id = '$game_id' AND a.video_type = '$type' ".
				" ORDER BY b.play_count DESC ";

		$sql .= " LIMIT $start,$page_size ";

		$results = $db->get_results($sql);

		return $results;
	}

	/**
	 *
	 * 获取比赛视频总数
	 * @param  [type]  $game_id [description]
	 * @param  integer $type      [0:训练视频,1:参赛视频]
	 * @return [type]           [description]
	 */
	function get_game_video_count($game_id, $type = 0)
	{
		$db = $GLOBALS['db'];
		$sql = "SELECT count(*) FROM game_video WHERE game_id = '$game_id' AND video_type = '$type'";
		$count = $db->get_var($sql);
		return $count;
	}

	/**
	 * 获取普通视频-相关视频
	 * @param  [type]  $video_id  [description]
	 * @param  integer $page      [description]
	 * @param  integer $page_size [description]
	 * @return [type]             [description]
	 */
	function get_related_video($video_id, $page = 1, $page_size = 8)
	{
		$db = $GLOBALS['db'];
		$total = get_related_video_count($video_id);
		$max_page = ceil($total/$page_size);

		if($page > $max_page)
		{
			$page = $max_page;
		}
		if($page < 1)
		{
			$page = 1;
		}

		if($page_size < 8)
		{
			$page_size = 8;
		}

		$start = ($page-1)*$page_size;

		$sql = "SELECT a.id as video_id, a.user_id, a.video_cover, b.user_name ".
				" FROM video a left join user b on a.user_id = b.user_id ".
				" ORDER BY a.play_count DESC ";

		$sql .= " LIMIT $start,$page_size ";

		$results = $db->get_results($sql);

		return $results;
	}

	/**
	 * 获取普通视频-相关视频总数
	 * @param  [type] $video_id [description]
	 * @return [type]           [description]
	 */
	function get_related_video_count($video_id)
	{
		$db = $GLOBALS['db'];
		$sql = "SELECT count(*) FROM video";
		$count = $db->get_var($sql);
		return $count;
	}


?>
