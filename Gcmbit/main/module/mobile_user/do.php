<?php
pe_lead('hook/wechat.hook.php');
switch($act) {
	//####################// 用户登录 //####################//

	case 'login':
	
		    $uaccount = $_COOKIE["uaccount"];
			$user_name = pe_dbhold($uaccount);
			if ($info = $db->pe_select('user', " and (user_name = '{$user_name}')")) {
				user_login_callback('login', $info);
				$_COOKIE['user_name'] = $uaccount;


	
                echo $_COOKIE['user_name'];
				echo "<br>";
                echo $user['user_id'];
				echo "<br>";
				pe_goto($url = 'user.php?mod=main', $type = 'default');
			}
			else {
				pe_goto($url = '/', $type = 'default');
			}
			
	break;


	
	case 'logout':
		//unset($_SESSION['user_idtoken'], $_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_ltime'], $_SESSION['user_nickname'], $_SESSION['user_wx_openid'], $_SESSION['pe_token']);
		
	$expire=time()+60*60*24*30;
    setcookie("user_idtoken", "", $expire);
    setcookie("user_id", "", $expire);
    setcookie("user_name", "", $expire);
    setcookie("user_nickname", "", $expire);
    setcookie("user_ltime", "", $expire);
    setcookie("user_wx_openid", "", $expire);
    setcookie("pe_token", "",$expire);

//        pe_jsonshow(array('result'=>true, 'show'=>'退出成功',$url = 'user.php?mod=do&act=login'));
		pe_goto($url = 'user.php?mod=do&act=login', $type = 'default');
	break;
		
}
?>