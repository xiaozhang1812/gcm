<?php
$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
$webtitle = "GDE";
switch($act) {
	default:
        $admina = $db->pe_select('admin', array('admin_id'=>1));  	
		include(pe_tpl('my.html'));
	break;
	
	case 'invite':
		include(pe_tpl('my_invite.html'));
	break;
	
	case 'earnings':
	    $shouyilist = $db->pe_selectall('shouyijilu', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'), '*', array(100, $_g_page));
		include(pe_tpl('my_earnings.html'));
	break;
	
	case 'team':
		$ulist = $db->pe_selectall('user', array('user_fromid'=>$user["user_id"], 'order by'=>'`user_id` desc'), '*', array(50, $_g_page));
		$zongshu = $db->pe_num('user', array('user_fromid'=>$user["user_id"], 'order by'=>'`user_id` desc'), 'user_id');
		include(pe_tpl('my_team.html'));
	break;
	
	
	case 'contact':
		include(pe_tpl('my_contact.html'));
	break;
	
	case 'nft':
		if (isset($_p_pesubmit)) {
			
			
			//$_p_amount = $_p_quantity;
			$adm = $db->pe_select('admin', array('admin_id'=>1));
			$amount=500;
			//if ($amount<=0) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if ($user['user_isnft']==1) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if ($adm['nft']>=50) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Closed！'));
			if ($amount<>500) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if ($user['user_usdt'] < $amount) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Insufficient GCM！'));
			
			$nyue = $user['user_usdt'] - $amount;
			
			$nnft = $adm['nft']+1;
			
			
			$rsnnid = $db->pe_select('tzjilu', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'),'id');
	        $nnid = $rsnnid['id'];
			
			$sql_set['amount'] = $amount;
			$sql_set['uid'] = $user['user_id'];
			$sql_set['shijian'] = date("Y-m-d H:i:s");
			$uuid = $user["user_id"];
			$keyy = "string($uuid) string($nnid) string($amount)";
			$sql_set['keyy'] = md5($keyy);
			$sql_set['isnft'] = 1;
			
			$sql_setjt['leixing'] = 4;
			$sql_setjt['text'] = $amount;
			$sql_setjt['uid'] = $user['user_id'];
			$sql_setjt['sj'] = date("Y-m-d H:i:s");
			$sql_setjt['dzsj'] = date("Y-m-d");
			$sql_setjt['sfsj'] = date("Y-m-d");
			$sql_setjt['jtzhi'] = $amount;
			$sql_setjt['dtzhi'] = 0;
			$sql_setjt['status'] = 1;


			if ($db->pe_insert('tzjilu', pe_dbhold($sql_set))) {
				$db->pe_update('user', array('user_id'=>$user['user_id']), array('user_usdt'=>$nyue));
				$db->pe_update('admin', array('admin_id'=>1), array('nft'=>$nnft));
				$db->pe_insert('jtzengjia', pe_dbhold($sql_setjt));
				pe_jsonshow(array('result'=>true, 'show'=>'Success！'));
				
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'Failed!'));
			}
			
			
			/*
			$amount=number_format("$_p_amount",2,".","");
			$fee = 0;
			if ($user['user_isnft']==1) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if ($amount<=0) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if ($amount<=$fee) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Too few inputs！'));
			if ($user['user_usdt'] < $amount) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Insufficient GCM！'));
			
			$nyue = $user['user_usdt'] - $amount;
			
			$rsadmin = $db->pe_select('admin', array('admin_id'=>1),'todayxiaohui');
			


			$nxiaohui = $rsadmin['todayxiaohui'] + $amount;
			
			
			$sql_set['leixing'] = 4;
			$sql_set['text'] = 500;
			$sql_set['uid'] = $user['user_id'];
			$sql_set['sj'] = date("Y-m-d H:i:s");
			$sql_set['dzsj'] = date("Y-m-d");
			$sql_set['jtzhi'] = 500;
			$sql_set['dtzhi'] = 0;
			

			if ($db->pe_insert('jtzengjia', pe_dbhold($sql_set))) {
				$db->pe_update('user', array('user_id'=>$user['user_id']), array('user_isnft'=>1,'user_usdt'=>$nyue));
				$db->pe_update('admin', array('admin_id'=>1), array('todayxiaohui'=>$nxiaohui));
				pe_jsonshow(array('result'=>true, 'show'=>'Success！'));
				
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'Failed!'));
			}
			*/

		}
		$admin = $db->pe_select('admin', array('admin_id'=>1));
		$synft = 50 - $admin['nft'];
		$nftlist = $db->pe_selectall('jtzengjia', array('uid'=>$user["user_id"],'leixing'=>4, 'order by'=>'`id` asc'), '*', array(50, $_g_page));
		include(pe_tpl('my_nft.html'));
	break;
	
	case 'bnb':
		if (isset($_p_pesubmit)) {
			$nbnb = $_p_nbnb;
			$nbnbtext = $_p_nbnbtext;
			pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if (!$nbnb) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			
			if ($db->pe_update('user', array('user_id'=>$user['user_id']), array('user_bnb'=>$nbnb,'user_bnbbeizhu'=>$nbnbtext))) {
				pe_jsonshow(array('result'=>true, 'show'=>'Success！'));
				
			}else{
				pe_jsonshow(array('result'=>false, 'show'=>'Failed!'));
			}

		}
		include(pe_tpl('my_bnb.html'));
	break;
}
?>