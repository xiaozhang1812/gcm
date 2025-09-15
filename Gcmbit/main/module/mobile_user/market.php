<?php
$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']),'*');
switch($act) {
	default:
		if ($_g_type==1){
		    $sql_where .= ' and amount>0 order by leixing desc,price asc';
		}else{
		    $sql_where .= ' and amount>0 order by leixing desc,id desc';
		}

		$info = $db->pe_selectall('market', $sql_where, '*', array(100, $_g_page));
		$rsadmin = $db->pe_select('admin', array('admin_id'=>1));
		$seo = pe_seo($menutitle='钱包');
		include(pe_tpl('market.html'));
	break;
	
	
	case 'agsc':
	
	    $feebili = 0.2;
        $rsadmin = $db->pe_select('admin', array('admin_id'=>1),'*');

		$info = $db->pe_selectall('market', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'), '*', array(1000, $_g_page));
		$enddate = date("Y-m-d H:i:s");
		foreach ($info as $k=>$v) {
			$infotianshu[$k] = floor((strtotime($enddate)-strtotime($v['shijian']))/86400);
		}
		
		//$enddate = date("Y-m-d H:i:s");
		//$tianshu=floor((strtotime($enddate)-strtotime($rs['shijian']))/86400);
		
		if (isset($_p_pesubmit)) {
			pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Closed！'));
			if ($user['user_locked']==1){
				pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Closed！'));
			}
			$amount=number_format("$_p_amount",1,".","");
			$price=number_format("$_p_price",4,".","");
			if ($amount<5) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>No less than 5'));
			if ($price<=0) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			if ($price<1) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>The price is too low ！'));
			if ($user['user_usdt'] < $amount) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Insufficient GCM！'));
			
			$nyue = $user['user_usdt'] - $amount;
			
			$fee = $amount*$feebili;
			$sjamount = $amount-$fee;
			if ($sjamount<=0) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error！'));
			
			
			$shijian = date("Y-m-d H:i:s");
			$sql_set['fee'] = $fee;		
			$sql_set['leixing'] = $_p_leixing;
			$sql_set['price'] = $price;
			$sql_set['amount'] = $sjamount;
			$sql_set['amounted'] = 0;
			$sql_set['uid'] = $user['user_id'];
			$sql_set['shijian'] = date("Y-m-d H:i:s");
			$sql_set['bianhao'] = getRandomString(15);
			
			$rsadmin = $db->pe_select('admin', array('admin_id'=>1),'*');
			$nxh = $rsadmin['todayxiaohui'] + $amount*0.075;
			$nnft = $rsadmin['todayfhnft'] + $amount*0.075;
			$nv = $rsadmin['todayfhv'] + $amount*0.03;

			if ($db->pe_insert('market', pe_dbhold($sql_set))) {
				$db->pe_update('user', array('user_id'=>$user['user_id']), array('user_usdt'=>$nyue));
				$db->pe_update('admin', array('admin_id'=>1), array('todayxiaohui'=>$nxh,'todayfhnft'=>$nnft,'todayfhv'=>$nv));
				pe_jsonshow(array('result'=>true, 'show'=>'Success！'));
				
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'Failed!'));
			}
		}
		include(pe_tpl('market_agsc.html'));
	break;
	case 'regm':
		$rs = $db->pe_select('market', array('id'=>intval($_g_id),'uid'=>$user['user_id']),'*');
		if (!$rs["id"]) pe_error('Failed!');
		$enddate = date("Y-m-d H:i:s");
		$tianshu=floor((strtotime($enddate)-strtotime($rs['shijian']))/86400);
		//if ($tianshu<15) pe_error('Do not revoke!');
		$nusdt = $user["user_usdt"]+$rs["amount"];
		if ($db->pe_delete('market', array('id'=>intval($_g_id),'uid'=>$user['user_id']))) {
			$db->pe_update('user', array('user_id'=>$user['user_id']), array('user_usdt'=>$nusdt));
			pe_success('Success!');
		}
		else {
			pe_error('Failed!');
		}
	break;
	case 'delgm':
		$rs = $db->pe_select('market', array('id'=>intval($_g_id),'uid'=>$user['user_id']),'*');
		if (!$rs["id"]) pe_error('Failed!');
		if ($rs["amount"]>0) pe_error('Failed!');
		if ($db->pe_delete('market', array('id'=>intval($_g_id),'uid'=>$user['user_id']))) {
			pe_success('Success!');
		}
		else {
			pe_error('Failed!');
		}
	break;
	
	
	case 'buy':

        $rsadmin = $db->pe_select('admin', array('admin_id'=>1),'*');
		$infolist = $db->pe_selectall('marketsale', array('uidgm'=>$user["user_id"], 'leixing'=>1, 'order by'=>'`id` desc'), '*', array(1000, $_g_page));
        $info = $db->pe_select('market', array('id'=>$_g_id),'*');
		
		if (isset($_p_pesubmit)) {
			pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Closed！'));
			if ($user['user_locked']==1){
				pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Closed！'));
			}
            $infob = $db->pe_select('market', array('id'=>$_p_id),'*');
			$amount=$_p_amount;
			$zongjia=$amount*$infob['price']*0.00000001;
			$zongjia=floatval($zongjia);
			if (!$infob['id']) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error01！'));
			if ($user['user_id'] == $infob['uid']) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>It is yours！'));
			if ($user['user_isjy']==1 and $infob['leixing']==1) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error02！'));
			if ($amount<=0) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Error03！'));
			if ($infob['amount'] < $amount) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Shortage of saleable GCM！'));
			if ($zongjia < 0.0000001) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Too little GCM！'));
			if ($infob['leixing'] ==1 and $amount<1000) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>No less than 1000 GCM！'));
			if ($infob['leixing'] ==1 and $amount>10000) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>No more than 10000 GCM！'));
			if ($user['user_btc'] < $zongjia) pe_jsonshow(array('result'=>false, 'show'=>'Tips<br><br>Insufficient BTC！'));

			
			

			$sql_setj['leixing'] = $infob['leixing'];
			$sql_setj['price'] = $infob['price'];
			$sql_setj['amount'] = $amount;
			$sql_setj['uid'] = $infob['uid'];
			$sql_setj['uidgm'] = $user['user_id'];
			$sql_setj['shijian'] = date("Y-m-d H:i:s");
			$sql_setj['bianhao'] = $infob['bianhao'];
			$sql_setj['btc'] = $zongjia;
			

			$ngsc = $user['user_usdt'] + $amount;
			$nbtc = floatval($user['user_btc']) - $zongjia;
			
			$xsuser = $db->pe_select('user', array('user_id'=>$infob['uid']));
			$xsbtc = floatval($xsuser['user_btc']) + $zongjia;
			
			
			$sql_sett['leixing'] = 5;
			$sql_sett['uid'] = $user['user_id'];
			$sql_sett['jtzhi'] = $amount;  //精英1被静态态基数
			$sql_sett['dtzhi'] = $amount*3;  //精英3被动态基数
			$sql_sett['sj'] = date("Y-m-d H:i:s");
			$sql_sett['dzsj'] = date('Y-m-d',strtotime("+31 day"));

			
			$nmarketamount = $infob['amount'] - $amount;
			$nmarketamounted = $infob['amounted'] + $amount;

			if ($db->pe_insert('marketsale', pe_dbhold($sql_setj))) {
				$db->pe_update('user', array('user_id'=>$infob['uid']), array('user_btc'=>$xsbtc));
				$db->pe_update('user', array('user_id'=>$user['user_id']), array('user_btc'=>$nbtc));
				$db->pe_update('market', array('id'=>$infob['id']), array('amount'=>$nmarketamount,'amounted'=>$nmarketamounted));

				if ($infob['leixing'] ==1){
					$db->pe_insert('jtzengjia', pe_dbhold($sql_sett));
			        $rsadminb = $db->pe_select('admin', array('admin_id'=>1),'todayxiaohui');
			        $nxiaohui = $rsadminb['todayxiaohui'] + $amount;
				    $db->pe_update('admin', array('admin_id'=>1), array('todayxiaohui'=>$nxiaohui));
				    $db->pe_update('user', array('user_id'=>$user['user_id']), array('user_isjy'=>1));
				}else{
				    $db->pe_update('user', array('user_id'=>$user['user_id']), array('user_usdt'=>$ngsc));
				}


				pe_jsonshow(array('result'=>true, 'show'=>'Success！'));
				
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'Failed!'));
			}

		}
		include(pe_tpl('market_buy.html'));
	break;
	
	

	
	case 'gd':
        $rsadmin = $db->pe_select('admin', array('admin_id'=>1),'*');
		$info = $db->pe_selectall('market', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'), '*', array(1000, $_g_page));
		include(pe_tpl('market_gd.html'));
	break;
	case 'cs':
		$info = $db->pe_selectall('marketsale', array('uid'=>$user["user_id"], 'order by'=>'`id` desc'), '*', array(1000, $_g_page));
		include(pe_tpl('market_cs.html'));
	break;
	case 'gm':
		$info = $db->pe_selectall('marketsale', array('uidgm'=>$user["user_id"], 'order by'=>'`id` desc'), '*', array(1000, $_g_page));
		include(pe_tpl('market_gm.html'));
	break;
}

function getRandomString($len, $chars=null){
            if (is_null($chars)){
                $chars = "0123456789";
            } 
            mt_srand(10000000*(double)microtime());
            for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
                $str .= $chars[mt_rand(0, $lc)]; 
            }
            return $str;
}
?>