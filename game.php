<?php

    /**
     *
     * 比赛
     */

	define("SPORTS","YES");
	include_once("includes/init.php");
	include_once("includes/functions.php");
	$api = $_POST["act"];

    /**
     *
     * 推荐专家
     * @var [type]
     */
	if($api == "get_rec_expert")
	{

		$ret = array();
		$ret['status'] = "0";
		$ret['error'] = '推荐专家获取失败';
		$ret['data'] = 0;

		if(empty($_POST['game_type']))
		{
			$ret['error'] = '未传入比赛类型';
			$ret['data'] = 0;
			echo json_encode($ret);
			exit();
		}
		$game_type = trim($_POST['game_type']);

		$page = empty($_POST['page'])? "1":trim($_POST['page']);
		$page_size = empty($_POST['page_size'])? "8":trim($_POST['page_size']);

		$ret['data'] = get_rec_expert($game_type, $page, $page_size);

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

    /**
     * 比赛类型编号
     * @var [type]
     */
	if($api == "get_game_type")
	{
		$ret = array();
		$ret['status'] = "0";
		$ret['error'] = '比赛类型获取失败';
		$ret['data'] = 0;


		$ret['data'] = get_game_type();

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

    /**
     * 比赛列表
     * INPUT: game_type,page,page_size
     * OUTPUT: game_id,game_name,game_img,game_desc
     * @var [type]
     */
	if($api == "get_game_list")
	{
		$ret = array();
		$ret['status'] = "0";
		$ret['error'] = '比赛列表获取失败';
		$ret['data'] = 0;

		if(empty($_POST['game_type']))
		{
			$ret['error'] = '未传入比赛类型';
			$ret['data'] = 0;
			echo json_encode($ret);
			exit();
		}
		$game_type = trim($_POST['game_type']);

		$page = empty($_POST['page'])? "1":trim($_POST['page']);
		$page_size = empty($_POST['page_size'])? "12":trim($_POST['page_size']);

		$ret['data'] = get_game_list($game_type, $page, $page_size);

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

    /**
     * 比赛id
     * INPUT: video_id
     * OUTPUT: game_id
     * @var [type]
     */
	if($api == "get_game_id")
	{
		$ret = array();
		$ret['status'] = "0";
		$ret['error'] = '比赛id获取失败';
		$ret['data'] = 0;

		if(empty($_POST['video_id']))
		{
			$ret['error'] = '未传入视频id';
			$ret['data'] = 0;
			echo json_encode($ret);
			exit();
		}
		$video_id = trim($_POST['video_id']);

		$ret['data'] = get_game_id($video_id);

		$ret['status'] = "1";
		$ret['error'] = "SUCCESS";

		echo json_encode($ret);
		exit();
	}

    /**
     *++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 功能函数
     *
     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */

    /**
     * 获取推荐专家
     * @param  integer $page      [description]
     * @param  integer $page_size [description]
     * @return [type]             [description]
     */
    function get_rec_expert( $game_type, $page = 1, $page_size = 8)
    {

     	$db = $GLOBALS['db'];
     	$total = get_rec_expert_count();
     	$max_page = ceil($total/$page_size);

     	if($page < 1)
     	{
     		$page = 1;
     	}

     	if($page_size < 8)
     	{
     		$page_size = 8;
    	}

     	$start = ($page-1)*$page_size;

    	$sql = "SELECT user_id, user_name, img as user_img ".
    			" FROM user ".
    			" WHERE is_hot = '1' AND role = '1' AND game_type = '$game_type'".
    			" ORDER BY rank DESC";

    	if($total < $page*$page_size)
    	{
    		$sql .= " UNION ".
                    " SELECT user_id, user_name, img as user_img ".
        			" FROM user ".
        			" WHERE is_hot = '1' AND role = '1' ".
        			" ORDER BY rank DESC";
    	}

    	$sql .= " LIMIT $start,$page_size ";

    	$results = $db->get_results($sql);

    	return $results;
    }

    /**
     *
     * 获取推荐专家总数
     * @param  [type] $game_type [description]
     * @return [type]            [description]
     */
    function get_rec_expert_count($game_type)
    {
        $db = $GLOBALS['db'];
        $sql = "SELECT count(*) FROM user WHERE is_hot = '1' AND role = '1' AND game_type = '$game_type'";
        $count = $db->get_var($sql);
        return $count;
    }

    /**
     * 获取比赛类型
     * @return [type] [description]
     */
    function get_game_type()
    {
        $db = $GLOBALS['db'];
        $sql = "SELECT type_id, type_name FROM game_type";
        $res = $db->get_results($sql);
        return $res;
    }

    /**
     * 获取比赛列表
     * @param  [type]  $game_type [description]
     * @param  integer $page      [description]
     * @param  integer $page_size [description]
     * @return [type]             [description]
     */
    function get_game_list( $game_type, $page = 1, $page_size = 8)
    {

     	$db = $GLOBALS['db'];
     	$total = get_game_list_count($game_type);
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

    	$sql = "SELECT game_id, game_name, game_img, game_desc ".
    			" FROM game ".
    			" WHERE game_type = '$game_type'";

    	$sql .= " LIMIT $start,$page_size ";

    	$results = $db->get_results($sql);

    	return $results;
    }

    /**
     * 获取比赛总数
     * @param  [type] $game_type [description]
     * @return [type]            [description]
     */
    function get_game_list_count($game_type)
    {
        $db = $GLOBALS['db'];
        $sql = "SELECT count(*) FROM game WHERE game_type = '$game_type'";
        $count = $db->get_var($sql);
        return $count;
    }

    /**
     * 获取比赛id
     * @param  [type] $video_id [description]
     * @return [type]           [description]
     */
    function get_game_id($video_id)
    {
        $db = $GLOBALS['db'];
        $sql = "SELECT game_id FROM game_video WHERE video_id = '$video_id'";
        $game_id = $db->get_var($sql);
        return $game_id;
    }

 ?>
