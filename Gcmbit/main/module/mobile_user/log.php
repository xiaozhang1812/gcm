<?php
//参考cashout
$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
switch ($act) {
	
	case 'inv':
	    $list = $db->pe_selectall('tzjilu', array('uid'=>$user['user_id'], 'order by'=>'`id` desc'), '*', array(2000, $_g_page));
		include(pe_tpl('my_log_inv.html'));
	break;
	
	case 't':
	    $list = $db->pe_selectall('txjilu', array('uid'=>$user['user_id'], 'order by'=>'`id` desc'), '*', array(2000, $_g_page));
		include(pe_tpl('my_log_t.html'));
	break;
	
	case 'c':
	    $list = $db->pe_selectall('tzjilu_ruzhuang', array('uid'=>$user['user_id'], 'order by'=>'`id` desc'), '*', array(2000, $_g_page));
		include(pe_tpl('my_log_c.html'));
	break;

/**/	
	case 'recharge':
			$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
	    $chongzhilist = $db->pe_selectall('tzjilu_ruzhuang', array('uid'=>$user['user_id'], 'order by'=>'`id` desc'), '*', array(200, $_g_page));
		include(pe_tpl('log_recharge.html'));
	break;
	
	case 'profit':
			$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
	    $sylist = $db->pe_selectall('shouyijilu', array('uid'=>$user['user_id'], 'order by'=>'`id` desc'), '*', array(200, $_g_page));
		include(pe_tpl('log_profit.html'));
	break;
	
	case 'order':
			$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
	    $orderlist = $db->pe_selectall('tzjilu', array('uid'=>$user['user_id'], 'order by'=>'`id` desc'), '*', array(200, $_g_page));
		include(pe_tpl('log_order.html'));
	break;
	
	case 'withdrawal':
			$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
	    $txlist = $db->pe_selectall('txjilu', array('uid'=>$user['user_id'], 'order by'=>'`id` desc'), '*', array(200, $_g_page));
		include(pe_tpl('log_withdrawal.html'));
	break;
	
	case 'log':
			$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
	    $loglist = $db->pe_selectall('log', array('user_id'=>$user['user_id'],'order by'=>'`moneylog_atime` desc'), '*', array(200, $_g_page));
		include(pe_tpl('log.html'));
	break;
	
	case 'loggdk':
			$user = $db->pe_select('user', array('user_name'=>$_COOKIE['uaccount']));
	    $loglist = $db->pe_selectall('log', array('user_id'=>$user['user_id'],'moneylog_cointype'=>2, 'order by'=>'`moneylog_atime` desc'), '*', array(200, $_g_page));
		include(pe_tpl('log_gdk.html'));
	break;
	
}