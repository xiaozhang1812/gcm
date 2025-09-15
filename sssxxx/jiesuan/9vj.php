<meta http-equiv="refresh" content="700">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$nowday = date("Y-m-d");

$rsadmin=mysql_fetch_assoc(mysql_query("select * from ert_admin where admin_id=1"));

if ($rsadmin['sjv']<$nowday){
	/*	
	$rszs1=mysql_fetch_row(mysql_query("select count(*) from ert_user where user_vdengji=1"));
	$j1 = $rsadmin['todayfhv']/30*10/$rszs1[0];
	
	$rszs2=mysql_fetch_row(mysql_query("select count(*) from ert_user where user_vdengji=2"));
	$j2 = $rsadmin['todayfhv']/30*8/$rszs2[0];
	
	$rszs3=mysql_fetch_row(mysql_query("select count(*) from ert_user where user_vdengji=3"));
	$j3 = $rsadmin['todayfhv']/30*6/$rszs3[0];
	
	$rszs4=mysql_fetch_row(mysql_query("select count(*) from ert_user where user_vdengji=4"));
	$j4 = $rsadmin['todayfhv']/30*4/$rszs4[0];
	
	$rszs5=mysql_fetch_row(mysql_query("select count(*) from ert_user where user_vdengji=5"));
	$j5 = $rsadmin['todayfhv']/30*2/$rszs5[0];


    $resultsv=mysql_query("select user_id,user_vdengji from ert_user where user_vdengji>0 order by user_id desc");

    while ($rssv=mysql_fetch_assoc($resultsv)){   
		if ($rssv['user_vdengji']==1 and $j1>0.01){
			givejiang(1,$rssv['user_id'],$j1,7,"");
		}elseif ($rssv['user_vdengji']==2 and $j2>0.01){
			givejiang(1,$rssv['user_id'],$j2,7,"");
		}elseif ($rssv['user_vdengji']==3 and $j3>0.01){
			givejiang(1,$rssv['user_id'],$j3,7,"");
		}elseif ($rssv['user_vdengji']==4 and $j4>0.01){
			givejiang(1,$rssv['user_id'],$j4,7,"");
		}elseif ($rssv['user_vdengji']==5 and $j5>0.01){
			givejiang(1,$rssv['user_id'],$j5,7,"");
		}
	}
	*/

	mysql_query("update ert_admin set sjv='$nowday',todayfhv=0 where admin_id=1");
}

?>