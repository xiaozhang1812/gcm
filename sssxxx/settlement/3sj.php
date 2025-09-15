<meta http-equiv="refresh" content="15">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 

$resultsv=mysql_query("select user_id,user_vdengji,user_tdyeji from ert_user where user_isnewyeji=1 order by user_id desc limit 0,30");
while ($rssv=mysql_fetch_assoc($resultsv))
{   
    $rsbig=mysql_fetch_assoc(mysql_query("select user_tdyejime from ert_user where user_fromid='$rssv[user_id]' order by user_tdyejime desc limit 1"));
	$qiyu = $rssv["user_tdyeji"]-$rsbig["user_tdyejime"];
	
    if ($rsbig["user_tdyejime"]>=2000000 and $qiyu>=2000000 and $rssv["user_vdengji"]<5){
		mysql_query("update ert_user set user_vdengji=5 where user_id='$rssv[user_id]'");
		
	}elseif ($rsbig["user_tdyejime"]>=400000 and $qiyu>=400000 and $rssv["user_vdengji"]<4){
		mysql_query("update ert_user set user_vdengji=4 where user_id='$rssv[user_id]'");
		
	}elseif ($rsbig["user_tdyejime"]>=75000 and $qiyu>=75000 and $rssv["user_vdengji"]<3){
		mysql_query("update ert_user set user_vdengji=3 where user_id='$rssv[user_id]'");
		
	}elseif ($rsbig["user_tdyejime"]>=15000 and $qiyu>=15000 and $rssv["user_vdengji"]<2){
		mysql_query("update ert_user set user_vdengji=2 where user_id='$rssv[user_id]'");
		
	}elseif ($rsbig["user_tdyejime"]>=3000 and $qiyu>=3000 and $rssv["user_vdengji"]<1){
		mysql_query("update ert_user set user_vdengji=1 where user_id='$rssv[user_id]'");
	}
	
	
	$rsn=mysql_fetch_assoc(mysql_query("select user_id,user_vdengji,user_isgd from ert_user where user_vdengji>=3 and user_id='$rssv[user_id]'"));
	if ($rsn["user_id"]){
		if ($rsn["user_isgd"]<>2){
			mysql_query("update ert_user set user_isgd=2 where user_id='$rssv[user_id]'");
			$textt = "升级到V".$rsn['user_vdengji'];
			mysql_query("insert into ert_jtzengjia(leixing,jtzhi,dtzhi,uid,sj,dzsj,text) values (2,3000,6000,'$rssv[user_id]','".date('Y-m-d H:i:s')."','".date('Y-m-d')."','$textt')");
		}
	}
	
	$qiyu = 0;
	$rsbig = "";
	$rsn= "";
	mysql_query("update ert_user set user_isnewyeji=0 where user_id='$rssv[user_id]'");
}
?>