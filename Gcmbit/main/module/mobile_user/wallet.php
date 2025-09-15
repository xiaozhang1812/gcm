<?php
$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
$admingas = $db->pe_select('admin', array('admin_id'=>1));
$gasuser = $admingas['gasaddr'];
switch($act) {
	default:

		$zj = $db->pe_sumjtzengjia('jtzengjia', array('uid'=>$user['user_id'],'status'=>0));
		/*
		$gdkd = $db->pe_sumshichang('shichang', array('type'=>2,'user_id'=>$user['user_id'],'status'=>0));
		$usdtt = $db->pe_sumtixian('tixian', array('type'=>1,'uid'=>$user['user_id'],'status'=>0));
		$gdkt = $db->pe_sumtixian('tixian', array('type'=>2,'uid'=>$user['user_id'],'status'=>0));
		*/
		$admin = $db->pe_select('admin', array('admin_id'=>1));
		$seo = pe_seo($menutitle='钱包');
		include(pe_tpl('wallet.html'));
	break;
	
	
	case 'tgsc':

	    $info = $db->pe_select('user', array('user_id'=>$user['user_id']));
	    $list = $db->pe_selectall('txjilu', array('uid'=>$user['user_id'], 'leixing'=>1, 'order by'=>'`id` desc'), '*', array(15, $_g_page));
		
		if (isset($_p_pesubmit)) {
			$amount=number_format("$_p_amount",2,".","");
			if ($user['user_locked']==1){
				pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Closed！'));
			}
			if ($amount<10) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>No less than 10 ！'));
			$fee = $amount*0.2;
			if ($amount<=0) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if ($amount<=$fee) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Too few inputs！'));
			if ($user['user_usdt'] < $amount) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Insufficient GCM！'));
			
			$nyue = $user['user_usdt'] - $amount;
			
			$rsadmin = $db->pe_select('admin', array('admin_id'=>1),'*');
			
			$rsnnid = $db->pe_select('txjilu', array( 'order by'=>'`id` desc'),'id');
	        $nnid = $rsnnid['id'];
			$nxh = $rsadmin['todayxiaohui'] + $amount*0.075;
			$nnft = $rsadmin['todayfhnft'] + $amount*0.075;
			$nv = $rsadmin['todayfhv'] + $amount*0.03;
			
			$keyd = $rsnnid['id'];
			$sql_set['leixing'] = 1;
			$sql_set['fee'] = $fee;
			$sql_set['amount'] = $amount-$sql_set['fee'];
			$sql_set['uid'] = $user['user_id'];
			$sql_set['shijian_tixian'] = date("Y-m-d H:i:s");
			$sql_set['keyid'] = $keyd;
			$txsj = $amount-$fee ;
			$txsj = floatval($txsj);
			$uuid = $user["user_id"];
			

            $keya = floor($txsj);
			$keyb = md5(substr($info['user_name'], 10, 2));
			$keyc = $info['user_name'];
			$keyy = $keya.$keyb.$keyc.$keyd;
			
			$sql_set['key_tixian'] = md5($keyy);


			if ($db->pe_insert('txjilu', pe_dbhold($sql_set))) {
				$db->pe_update('user', array('user_id'=>$user['user_id']), array('user_usdt'=>$nyue));
				$db->pe_update('admin', array('admin_id'=>1), array('todayxiaohui'=>$nxh,'todayfhnft'=>$nnft,'todayfhv'=>$nv));
				pe_jsonshow(array('result'=>true, 'show'=>'Success！'));
				
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'Failed!'));
			}

		}
		include(pe_tpl('wallet_tgsc.html'));
	break;
	
	
	case 'tbtc':

	    $info = $db->pe_select('user', array('user_id'=>$user['user_id']));
	    $list = $db->pe_selectall('txjilu', array('uid'=>$user['user_id'], 'leixing'=>2, 'order by'=>'`id` desc'), '*', array(15, $_g_page));
		
		if (isset($_p_pesubmit)) {
			if ($user['user_locked']==1){
				pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Closed！'));
			}
			$amount=number_format("$_p_amount",6,".","");
			$fee = 0.000005;
			if ($amount<0.000015) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Below 0.000015'));
			if ($amount<=$fee) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Too few inputs！'));
			if ($user['user_btc'] < $amount) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Insufficient BTC！'));
			
			$nyue = $user['user_btc'] - $amount;
			
			$rsadmin = $db->pe_select('admin', array('admin_id'=>1),'daysxf');
			
			$rsnnid = $db->pe_select('txjilu', array( 'order by'=>'`id` desc'),'id');
			$nsxf = $rsadmin['daysxf'] + $fee;
			
			if (!$rsnnid['id']){
				$keyd = 1;
			}else{
				$keyd = $rsnnid['id'];
			}
			
			$sql_set['leixing'] = 2;
			$sql_set['fee'] = $fee;
			$sql_set['amount'] = $amount-$sql_set['fee'];
			$sql_set['uid'] = $user['user_id'];
			$sql_set['shijian_tixian'] = date("Y-m-d H:i:s");
			$sql_set['keyid'] = $keyd;
			$txsj = $amount-$fee ;
			$uuid = $user["user_id"];
			
            $keya = $txsj*100000000;
			$keyb = md5(substr($info['user_name'], 7, 2));
			$keyc = $info['user_name'];
			$keyy = $keya.$keyb.$keyc.$keyd;
			
			$sql_set['key_tixian'] = md5($keyy);


			if ($db->pe_insert('txjilu', pe_dbhold($sql_set))) {
				$db->pe_update('user', array('user_id'=>$user['user_id']), array('user_btc'=>$nyue));
				$db->pe_update('admin', array('admin_id'=>1), array('daysxf'=>$nsxf));

				pe_jsonshow(array('result'=>true, 'show'=>'Success！'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'Failed!'));
			}

		}
		include(pe_tpl('wallet_tbtc.html'));
	break;
	
	case 'cgsc':
	    $list = $db->pe_selectall('tzjilu_ruzhuang', array('uid'=>$user['user_id'], 'leixing'=>1, 'order by'=>'`id` desc'), '*', array(15, $_g_page));
	    $info = $db->pe_select('user', array('user_id'=>$user['user_id']));
		$tz = $db->pe_num('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'status_ruzhang'=>0));
		$chongzhi = $db->pe_selectall('tzjilu_ruzhuang', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'), '*', array(1000, $_g_page));
	
        $us = $db->pe_select('user', array('user_id'=>$user['user_id']));
		$rz = $db->pe_select('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'order by'=>'id desc'));
		$uid = $user["user_id"];
		$username = $user["user_name"];
        $rzid = $rz["id"];
		$keyymain = "string($uid) string($username) string($rzid)";
        $keyy = md5($keyymain);
		$rzpendding = $db->pe_select('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'leixing'=>1,'status_ruzhang'=>0,'order by'=>'id desc'));
		$pendding=$rzpendding["id"];
		include(pe_tpl('wallet_cgsc.html'));
	break;
	case 'cgsc2':
	    $list = $db->pe_selectall('tzjilu_ruzhuang', array('uid'=>$user['user_id'], 'leixing'=>2, 'order by'=>'`id` desc'), '*', array(15, $_g_page));
	    $info = $db->pe_select('user', array('user_id'=>$user['user_id']));
		$tz = $db->pe_num('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'status_ruzhang'=>0));
		$chongzhi = $db->pe_selectall('tzjilu_ruzhuang', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'), '*', array(1000, $_g_page));
	
        $us = $db->pe_select('user', array('user_id'=>$user['user_id']));
		$rz = $db->pe_select('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'order by'=>'id desc'));
		$uid = $user["user_id"];
		$username = $user["user_name"];
        $rzid = $rz["id"];
		$keyymain = "string($uid) string($username) string($rzid)";
        $keyy = md5($keyymain);
		$rzpendding = $db->pe_select('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'leixing'=>2,'status_ruzhang'=>0,'order by'=>'id desc'));
		$pendding=$rzpendding["id"];
		include(pe_tpl('wallet_cgsc2.html'));
	break;
	case 'cbtc':
	    $list = $db->pe_selectall('tzjilu_ruzhuang', array('uid'=>$user['user_id'], 'leixing'=>2, 'order by'=>'`id` desc'), '*', array(15, $_g_page));
	    $info = $db->pe_select('user', array('user_id'=>$user['user_id']));
		$tz = $db->pe_num('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'status_ruzhang'=>0));
		$chongzhi = $db->pe_selectall('tzjilu_ruzhuang', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'), '*', array(1000, $_g_page));
	
        $us = $db->pe_select('user', array('user_id'=>$user['user_id']));
		$rz = $db->pe_select('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'order by'=>'id desc'));
		$uid = $user["user_id"];
		$username = $user["user_name"];
        $rzid = $rz["id"];
		$keyymain = "string($uid) string($username) string($rzid)";
        $keyy = md5($keyymain);
		$rzpendding = $db->pe_select('tzjilu_ruzhuang', array('uid'=>$user['user_id'],'leixing'=>2,'status_ruzhang'=>0,'order by'=>'id desc'));
		$pendding=$rzpendding["id"];
		include(pe_tpl('wallet_cbtc.html'));
	break;
}
?>