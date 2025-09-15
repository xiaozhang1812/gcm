<meta http-equiv="refresh" content="60">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$nowday = date("Y-m-d");

    $resultsv=mysql_query("select user_id,user_ishegeson from ert_user where user_isgd=6 and user_tdyeji>=500 order by rand() limit 0,30");

    while ($rssv=mysql_fetch_assoc($resultsv)){   
		$rsa=mysql_fetch_assoc(mysql_query("select sum(user_yeji) as ztyj from ert_user where user_fromid='$rssv[user_id]'"));
		if ($rsa['ztyj']>=500){
		    mysql_query("update ert_user set user_isgd=1 where user_id='$rssv[user_id]'");
		    mysql_query("update ert_jtzengjia set dzsj='$nowday' where leixing=6 and uid='$rssv[user_id]'");
	        mysql_query("insert into ert_jtzengjia(leixing,jtzhi,dtzhi,uid,sj,dzsj) values (7,900,0,'$rssv[user_id]','".date('Y-m-d H:i:s')."','".date('Y-m-d')."')");
		}
	}

?>