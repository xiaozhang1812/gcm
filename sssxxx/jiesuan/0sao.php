<meta http-equiv="refresh" content="30">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 
mysql_query("delete from ert_user where user_name=''"); 
echo "运行中"; 
echo date("Y-m-d H:i:s"); 
    $rsadmin=mysql_fetch_assoc(mysql_query("select jiagefw,isjt from ert_admin where admin_id=1"));
	if ($rsadmin["isjt"]==1){
		exit; //静态结算时间不结算
	}
    $rstz=mysql_fetch_assoc(mysql_query("select * from ert_tzjilu where status=0 order by id asc limit 1"));
    $uid=$rstz["uid"];
    $tzid=$rstz["id"];
    $amount=$rstz["amount"];
    $isnft=$rstz["isnft"];

	$amount=number_format("$amount",2,".","");
    $nyeji = $rstz["amount"]*$rsadmin["jiagefw"];
	
    $rstzb=mysql_fetch_assoc(mysql_query("select id from ert_tzjilu where uid='$uid' and id<'$tzid' order by id desc limit 1"));
    $nnid = $rstzb["id"];
    $keyy = "string($uid) string($nnid) string($amount)";
	$key = md5($keyy);
	
		mysql_query("insert into ert_touziliebiao(uid,rzid,sj,amount,isnft) values ('$uid','$tzid','".date('Y-m-d H:i:s')."','$amount','$isnft')");
		if ($isnft==0){
			mysql_query("insert into ert_touziliebiaojtb(uid,sj,sfsj,jtjishu,amount) values ('$uid','".date('Y-m-d')."','".date('Y-m-d')."','$amount','$nyeji')"); //写入静态结算列表
		}
		
		//给推荐人送0.05算力
		$fromamount=$amount*0.05;
		$fromnyeji = $fromamount*$rsadmin["jiagefw"];
		$rsfrom=mysql_fetch_assoc(mysql_query("select user_fromid from ert_user where user_id='$uid'"));
		if ($fromamount>0 and $fromnyeji>0 and $rsfrom['user_fromid']>0){
		   $rsfromtz=mysql_fetch_assoc(mysql_query("select id from ert_touziliebiaojtb where uid='$rsfrom[user_fromid]' and dangwei=0 and zt<>1"));
		   if ($rsfromtz["id"]){
			   mysql_query("update ert_touziliebiaojtb set jtjishu=jtjishu+'$fromamount',amount=amount+'$fromnyeji' where id='$rsfromtz[id]'"); 
		    }else{
			   mysql_query("insert into ert_touziliebiaojtb(uid,sj,sfsj,jtjishu,amount) values ('$rsfrom[user_fromid]','".date('Y-m-d')."','".date('Y-m-d')."','$fromamount','$fromnyeji')"); //写入静态结算列表
		    }
			mysql_query("update ert_user set user_jtjishu=user_jtjishu+'$fromamount' where user_id='$rsfrom[user_fromid]'"); 
		}
		
		mysql_query("update ert_tzjilu set status=1 where id='$tzid'"); 

/*
	if ($key == $rstz['keyy']){
		mysql_query("insert into ert_touziliebiao(uid,rzid,sj,amount,isnft) values ('$uid','$tzid','".date('Y-m-d H:i:s')."','$amount','$isnft')");
		mysql_query("update ert_tzjilu set status=1 where id='$tzid'"); 
	}else{
		mysql_query("update ert_tzjilu set status=2 where id='$tzid'"); 
	}
*/
?>