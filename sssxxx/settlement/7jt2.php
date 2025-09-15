<meta http-equiv="refresh" content="60">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 

$nowday = date("Y-m-d");
$rssvv=mysql_fetch_row(mysql_query("select count(*) from ert_touziliebiaojtb where sfsj<'$nowday' and zt<>2 and stop=0 order by id desc"));
if ($rssvv[0]>0){
	echo '|'.$rssvv[0];
	exit;
}

$resultsv=mysql_query("select * from ert_jtlinshi order by rand() limit 0,30");
while ($rssv=mysql_fetch_assoc($resultsv))
{   
    $rtouziliebiaojt=mysql_fetch_row(mysql_query("select count(*) from ert_touziliebiaojtb where zt<>2 and sfsj<'$nowday' and uid='$rssv[uid]' and stop=0"));
	if (!$rtouziliebiaojt[0]){
		$rsu=mysql_fetch_assoc(mysql_query("select user_isjian,user_isnft from ert_user where user_id='$rssv[uid]'"));
		$j=$rssv['amount'];
		/*
		if ($rsu['user_isjian']==0){
			$j=$rssv['amount']*2;
			if ($rsu['user_isnft']==1){
			    $j=$j-2;
		    }
		}else{
			$j=$rssv['amount']*0.10;
		}

		
		
		if ($rsu['user_isjian']==1){
			$j=$rssv['amount']*0.10;
		}elseif ($rsu['user_isjian']==2){
			$j=$rssv['amount']*0.07;
		}else{
			$j=$rssv['amount']*2;
			if ($rsu['user_isnft']==1){
			    $j=$j-2;
		    }
		}
		*/

		if ($j>0.0001){
			givejiang(1,$rssv['uid'],$j,5,"");
		}
		mysql_query("delete from ert_jtlinshi where id='$rssv[id]'"); 

	}
	$j = 0;
	$rtouziliebiaojt="";
	$rsu="";
}
?>