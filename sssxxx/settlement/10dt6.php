<meta http-equiv="refresh" content="80">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$nowday = date("Y-m-d");
exit();
    $resultsv=mysql_query("select * from ert_jtzengjia where (leixing=5 or leixing=6) and status=0 order by rand() limit 0,10");

    while ($rssv=mysql_fetch_assoc($resultsv)){

			$rsu=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$rssv[uid]'"));
			$rsa=mysql_fetch_assoc(mysql_query("select sum(user_yeji) as ztyj from ert_user where user_fromid='$rssv[uid]'"));
			if ($rsa['ztyj']>=500 or $rssv['dzsj']<=$nowday){
				//mysql_query("update ert_user set user_jtjishu=user_jtjishu+'$rssv[jtzhi]',user_dtquanyi=user_dtquanyi+'$rssv[dtzhi]',user_isnewtd=1 where user_id='$rssv[uid]'");
	            mysql_query("update ert_jtzengjia set dzsj='$nowday' where id='$rssv[id]'");
			}
	}


?>