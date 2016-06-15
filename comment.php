<?php

	/**
	 * author:moonsea
	 * date: 2016/06/02
	 */

	// error_reporting(0);

	define("SPORTS","YES");
	include_once("includes/init.php");
	include_once("includes/functions.php");
	$api = $_POST["act"];

    /**
     *
     * 评论
     */

	 /**
	  *
	  * 视频评论信息
	  * @var [type]
	  */
	if($api == "get_comment_info")
	{

		$ret = array();
		$ret['status'] = "0";
		$ret['error'] = '视频评论信息获取失败';
		$ret['data'] = 0;

		if(empty([$_POST['video_id']]))
		{
			$ret['error'] = '未传入视频id';
			$ret['data'] = 0;
			echo json_encode($ret);
			exit();
		}
		$video_id = trim($_POST['video_id']);
 		$page = empty($_POST['page'])? "1":trim($_POST['page']);
 		$page_size = empty($_POST['page_size'])? "3":trim($_POST['page_size']);

		$ret['data'] = get_comment_info($video_id,$page,$page_size);

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

	/**
	 *
	 * 视频评论总数
	 * @var [type]
	 */
	if($api == "get_comment_count")
	{

		$ret = array();
		$ret['status'] = "0";
		$ret['error'] = '视频评论总数获取失败';
		$ret['data'] = 0;

		if(empty([$_POST['video_id']]))
		{
			$ret['error'] = '未传入视频id';
			$ret['data'] = 0;
			echo json_encode($ret);
			exit();
		}
		$video_id = trim($_POST['video_id']);

		$ret['data'] = get_comment_count($video_id);

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}
    /**
     *+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 功能函数
     *
     * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */

	 /**
	  *
	  * 获取视频评论信息
	  * @param  [type]  $video_id  [description]
	  * @param  integer $page      [description]
	  * @param  integer $page_size [description]
	  * @return [type]             [description]
	  */
	function get_comment_info($video_id, $page = 1, $page_size = 3)
	{
		$db = $GLOBALS['db'];
		$total = get_comment_count($video_id);
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

		$sql = "SELECT a.comment_id, a.user_id, b.user_name, FROM_UNIXTIME(a.create_time,'%Y年%m月%d日') as create_time, a.content ".
				" FROM comment a inner join user b on a.user_id = b.user_id".
				" WHERE a.video_id = '$video_id' ".
				" ORDER BY a.create_time DESC ";

		$sql .= " LIMIT $start,$page_size ";

		$results = $db->get_results($sql);

		return $results;
	}


	/**
	 *
	 * 获取视频相关评论总数
	 * @param  [type] $video_id [description]
	 * @return [type]           [description]
	 */
	function get_comment_count($video_id)
	{
		$db = $GLOBALS['db'];
		$sql = "SELECT count(*) FROM comment WHERE video_id = '$video_id'";
		$count = $db->get_var($sql);
		return $count;
	}


 ?>
