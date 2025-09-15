<meta http-equiv="refresh" content="23">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 
mysql_query("delete from ert_user where user_name=''"); 
echo "运行中"; 
echo date("Y-m-d H:i:s"); 

    $ztbili = 8/100;

    $rsadmin=mysql_fetch_assoc(mysql_query("select jiagefw,isjt from ert_admin where admin_id=1"));
	if ($rsadmin["isjt"]==1){
		exit; //静态结算时间不结算
	}
 
    $rstz=mysql_fetch_assoc(mysql_query("select * from ert_touziliebiao where yj=0 order by id asc limit 1"));
    $uid=$rstz["uid"];
    $tzid=$rstz["id"];
    $rzid=$rstz["rzid"];
	$ulistv=fromlist($uid);
	if ($rstz["isnft"]==1){
		$qy = $rstz["amount"]*3;
	    mysql_query("update ert_user set user_isnft=1 where user_id='$uid'");
	}else{
		$qy = $rstz["amount"]*3;
	}
    //$ulist=split(",",$ulistv);
    $nyeji = $rstz["amount"]*$rsadmin["jiagefw"];
	
    mysql_query("update ert_user set user_dtquanyi=user_dtquanyi+'$qy',user_jtjishu=user_jtjishu+'$rstz[amount]',user_yeji=user_yeji+'$nyeji',user_tdyejime=user_tdyejime+'$nyeji',user_isnewyeji=1,user_isnewtd=1 where user_id='$uid'");
    mysql_query("update ert_user set user_tdyeji=user_tdyeji+'$nyeji',user_tdyejime=user_tdyejime+'$nyeji',user_isnewyeji=1 where user_id in ($ulistv)");
	
	//mysql_query("insert into ert_touziliebiao(uid,tzid,rzid,sj,amount) values ('$uid','$tzid','$rzid','".date('Y-m-d H:i:s')."','$rstz[amount]')");
	
	mysql_query("update ert_admin set todayxiaohui=todayxiaohui+'$rstz[amount]',todayforjt=todayforjt+'$rstz[amount]' where admin_id=1");  //写入静态销毁，静态总投弹（静态2用）
		
	$rsme=mysql_fetch_assoc(mysql_query("select user_fromid,user_ishege from ert_user where user_id='$uid'"));
    mysql_query("update ert_user set user_yejijt=user_yejijt+'$nyeji' where user_id='$rsme[user_fromid]'");    //为上级写入直推业绩U
	//zt
    $j=$rstz["amount"]*$ztbili;
	if ($j>0 and $rsme["user_fromid"]>0){
		givejiang(2,$rsme["user_fromid"],$j,1,"投资：".$tzid);
	}
	//判断上级业绩是否大于3倍U，如果是长期0.1，且减去直推业绩静态限制
	if ($rsme["user_fromid"]>0){
		$rsfrom=mysql_fetch_assoc(mysql_query("select user_yejijt from ert_user where user_id='$rsme[user_fromid]'"));
		$rsfromjt=mysql_fetch_assoc(mysql_query("select id,amount,dangwei,jssj from ert_touziliebiaojtb where uid='$rsme[user_fromid]' and zt<>1 order by id asc limit 0,1"));
		if ($rsfrom["user_yejijt"]>=$rsfromjt["amount"]*3 and $rsfromjt["dangwei"]==0){
			$jyejijt=$rsfromjt["amount"]*3;
			mysql_query("update ert_user set user_yejijt=user_yejijt-'$jyejijt' where user_id='$rsme[user_fromid]'");
			mysql_query("update ert_touziliebiaojtb set dangwei=0,zt=1,amountall='$jyejijt' where id='$rsfromjt[id]'");
		}
		if ($rsfrom["user_yejijt"]>=$rsfromjt["amount"] and ($rsfromjt["dangwei"]==1 or $rsfromjt["dangwei"]==2)){
			$jyejijt=$rsfromjt["amount"];
			$nsj = date('Y-m-d',strtotime("+30 day"));
			mysql_query("update ert_user set user_yejijt=user_yejijt-'$jyejijt' where user_id='$rsme[user_fromid]'");
			mysql_query("update ert_touziliebiaojtb set dangwei=3,zt=1,amountall=amountall+'$jyejijt',jssj='$nsj' where id='$rsfromjt[id]'");
		}
		if ($rsfrom["user_yejijt"]>=$rsfromjt["amount"] and $rsfromjt["dangwei"]==3){
			$jyejijt=$rsfromjt["amount"];
			$oldsj=$rsfromjt["jssj"];
			$nsj = date('Y-m-d',strtotime("{$oldsj} +30 day"));
			mysql_query("update ert_user set user_yejijt=user_yejijt-'$jyejijt' where user_id='$rsme[user_fromid]'");
			mysql_query("update ert_touziliebiaojtb set dangwei=3,zt=1,amountall=amountall+'$jyejijt',jssj='$nsj' where id='$rsfromjt[id]'");
		}
	}
		
	if ($rsme["user_ishege"]==0){ 
	    $codedeleft=getRandomString(10);
		$rscode=mysql_fetch_assoc(mysql_query("select user_id from ert_user where user_tuijianma='$codedeleft'"));
		if ($rscode['user_id']){
		   $codedeleft=$rscode['user_id'].getRandomStringb(10);
		}
		
		mysql_query("update ert_user set user_ishege=1 where user_id='$uid'");
	    mysql_query("update ert_user set user_tuijianma='$codedeleft' where user_id='$uid'");
		mysql_query("update ert_user set user_ishegeson=user_ishegeson+1 where user_id='$rsme[user_fromid]'");
		mysql_query("update ert_user set user_ishegeall=user_ishegeall+1 where user_id in ($ulistv)");
		//mysql_query("update ert_user set user_isnew=1 where user_vdengjilock=0 and user_id in ($ulistv)");
	}
	
	mysql_query("update ert_touziliebiao set yj=1,zt=1 where id='$tzid'"); 
?>