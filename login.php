<?php

/**
 * moonsea
 * login
 */

/**
 * Login Action
 */
if (!empty($_REQUEST['act']) && $_REQUEST['act'] == 'login')
{
    $res    = array('err_msg' => '', 'result' => '', 'qty' => 1);

    $user_id = empty($_REQUEST['user_id']) ? "" : ($_REQUEST['user_id']);


    die(json_encode($res));
}

 ?>
