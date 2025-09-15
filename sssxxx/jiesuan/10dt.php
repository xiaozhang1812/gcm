<meta http-equiv="refresh" content="40">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$nowday = date("Y-m-d");

    $resultsv=mysql_query("select * from ert_jtzengjia where status=0 and dzsj<='$nowday' order by rand() limit 0,20");

    while ($rssv=mysql_fetch_assoc($resultsv)){
		//if ($rssv['leixing']==1 or $rssv['leixing']==2 or $rssv['leixing']==4 or $rssv['leixing']==7){
	        mysql_query("update ert_user set user_jtjishu=user_jtjishu+'$rssv[jtzhi]',user_dtquanyi=user_dtquanyi+'$rssv[dtzhi]',user_isnewtd=1 where user_id='$rssv[uid]'");
	        mysql_query("update ert_jtzengjia set status=1 where id='$rssv[id]'");
		//}
		/*
		if ($rssv['leixing']==5 or $rssv['leixing']==6){
			$rsu=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$rssv[uid]'"));
			$rsa=mysql_fetch_assoc(mysql_query("select sum(user_yeji) as ztyj from ert_user where user_fromid='$rssv[uid]'"));
			if ($rsa['ztyj']>=500 or $rssv['dzsj']<=$nowday){
				//mysql_query("update ert_user set user_jtjishu=user_jtjishu+'$rssv[jtzhi]',user_dtquanyi=user_dtquanyi+'$rssv[dtzhi]',user_isnewtd=1 where user_id='$rssv[uid]'");
	            mysql_query("update ert_jtzengjia set dzsj='$nowday' where id='$rssv[id]'");
			}
		}
		*/
	}


?>
<script src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$.get("https://blockchain.info/balance?active=bc1psyr8urlucw7dgafsf7dl8z0m6nqehpz3uexh0nfmeuvhsp7afscqgrgd2d",
        function(result){
			console.log(result);

        var btc = result.bc1psyr8urlucw7dgafsf7dl8z0m6nqehpz3uexh0nfmeuvhsp7afscqgrgd2d.final_balance/100000000;	
			console.log(btc);		
        	$.post("/ajax/upbtc.php",{btc: btc});
        }
);
</script>