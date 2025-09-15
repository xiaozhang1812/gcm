<meta http-equiv="refresh" content="55">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 
$rsadminn=mysql_fetch_assoc(mysql_query("select * from ert_admin where admin_id=1"));
echo "运行中"; 
echo date("Y-m-d H:i:s"); 


if ($rsadminn['isjt']==0){
	echo "|no time"; 
	exit;
}

$nowday = date("Y-m-d");

$jfenpeic = $rsadminn['jfenpeic'];  //正常档
$jfenpei = $rsadminn['jfenpei'];  //0-3000总划拨底数
$jbilia = $rsadminn['jbilia']; //大于3000奖金比例


$rsjtb=mysql_fetch_assoc(mysql_query("select sum(jtjishu) as zongjt from ert_touziliebiaojtb where dangwei=1 and zt<>2 and stop=0"));

/*
if ($rsadminn['todayforjt']>$jfenpei){
	$perj=$rsadminn['todayforjt']/$rsjtb['zongjt'];
}else{
	$perj=$jfenpei/$rsjtb['zongjt'];
}
*/
	$perj=$jfenpei/$rsjtb['zongjt'];

$resultsv=mysql_query("select * from ert_touziliebiaojtb where zt<>2 and sfsj<'$nowday' and stop=0 order by id desc limit 0,50");
while ($rssv=mysql_fetch_assoc($resultsv))
{   
	$yue=intval(round((strtotime("$nowday")-strtotime("$rssv[sj]"))/3600/24)/31)+1;
    if ($yue==1){
		$beishu = 1;
	}elseif($yue==2){
		$beishu = 0.75;
	}elseif($yue==3){
		$beishu = 0.5;
	}elseif($yue==4){
		$beishu = 0.25;
	}else{
		$beishu = 0;
	}
	
	if ($rssv["dangwei"]==0){
		$j = $rssv["jtjishu"]*$jfenpeic*$beishu;
	}elseif($rssv["dangwei"]==1){
		$j = $rssv["jtjishu"]*$perj*$beishu;
	}elseif($rssv["dangwei"]==2){
		$j = $rssv["jtjishu"]*$jbilia*$beishu;
	}elseif($rssv["dangwei"]==3){
		$j = $rssv["jtjishu"]*0.002;  //老用户升级后
		if ($rssv["jssj"]==$nowday){
		    mysql_query("update ert_touziliebiaojtb set zt=0,dangwei='$rssv[isold]' where id='$rssv[id]'"); 
		}
	}elseif($rssv["dangwei"]==4){
		$j = $rssv["jtjishu"]*0.01;  //前50个号
	}
	
	//echo "<br>".$rssv[id]."奖金".$j;
	

	
	if ($j>0){
		$rslinshi=mysql_fetch_assoc(mysql_query("select id from ert_jtlinshi where sj='$nowday' and uid='$rssv[uid]'"));
		if ($rslinshi["id"]){
			//echo "yes";
			mysql_query("update ert_jtlinshi set amount = amount + '$j' where sj='$nowday' and uid='$rssv[uid]'"); 
		}else{
			//echo "no";
			mysql_query("insert into ert_jtlinshi(uid,sj,amount) values ('$rssv[uid]','".date('Y-m-d')."','$j')");
		}
	}
	if ($beishu==0 and $rssv["dangwei"]<3){
		mysql_query("update ert_touziliebiaojtb set zt = 2 where id='$rssv[id]'"); 
	}

	mysql_query("update ert_touziliebiaojtb set sfsj = '".date('Y-m-d')."' where id='$rssv[id]'"); 

	
	$j = 0;
	$beishu=0;
	$yue=0;
	$rslinshi="";

}
?>