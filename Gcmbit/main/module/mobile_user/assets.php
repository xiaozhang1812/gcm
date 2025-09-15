<?php
$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
$webtitle = "GDE";
switch($act) {

	
	case 'in':
        $z = $db->pe_sumxiaohui('user');
	    $info = $db->pe_select('user', array('user_id'=>$user['user_id']));
	    $admi = $db->pe_select('admin', array('admin_id'=>1));
		$rsadmin = $db->pe_select('admin', array('admin_id'=>1),'*');
        $miny = ceil(50/$rsadmin['jiagefw']);
        $maxy = ceil(10000/$rsadmin['jiagefw']);
		if (isset($_p_pesubmit)) {

			$_p_amount = $_p_quantity;

			$amount=number_format("$_p_amount",2,".","");
			//if ($amount<=0) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if ($admi['isjt']==1) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br> Pause！')); //静态结算时间不投弹
			//pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br> Pause！'));
			if ($amount<$miny) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Too few inputs！'));
			if ($amount>$maxy) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Too many inputs！'));
			if ($user['user_usdt'] < $amount) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Insufficient GCM！'));
			
			$nyue = $user['user_usdt'] - $amount;
			
			
			$rsnnid = $db->pe_select('tzjilu', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'),'id');
	        $nnid = $rsnnid['id'];
			
			$sql_set['amount'] = $amount;
			$sql_set['uid'] = $user['user_id'];
			$sql_set['shijian'] = date("Y-m-d H:i:s");
			$uuid = $user["user_id"];
			$keyy = "string($uuid) string($nnid) string($amount)";
			$sql_set['keyy'] = md5($keyy);


			if ($db->pe_insert('tzjilu', pe_dbhold($sql_set))) {
				$db->pe_update('user', array('user_id'=>$user['user_id']), array('user_usdt'=>$nyue));
				pe_jsonshow(array('result'=>true, 'show'=>'Success！'));
				
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'Failed!'));
			}

		}
		
		
		include(pe_tpl('assets_in.html'));
		
	break;
	
	

}
?>