<meta http-equiv="refresh" content="55">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$nowday = date("Y-m-d");

$rsadmin=mysql_fetch_assoc(mysql_query("select * from ert_admin where admin_id=1"));

if ($rsadmin['isjt']==0){
	echo "|no time"; 
	exit;
}

$jnft = $rsadmin['jnft'];  //正常档



	//$rszs=mysql_fetch_assoc(mysql_query("select sum(jtzhi) as zong from ert_jtzengjia where leixing=4"));
	//$perj = $rsadmin['todayfhnft']/$rszs['zong'];
	/*
	echo "<br>";
	echo $rsadmin['todayfhnft'];
	echo "<br>";
	echo $rszs['zong'];
	echo "<br>";
	echo $perj;
	*/

	//$newperj = "per:".$perj;

    $resultsv=mysql_query("select * from ert_jtzengjia where leixing=4 and sfsj<'$nowday' order by id desc limit 0,30");

    while ($rssv=mysql_fetch_assoc($resultsv)){   
		$jj = $rssv['jtzhi']*$jnft;
		//$jj = $jnft;
		if ($jj>=0.001){
		    givejiang(1,$rssv['uid'],$jj,6,$jnft);
		}
	    $jj = 0;
		mysql_query("update ert_jtzengjia set sfsj = '".date('Y-m-d')."' where id='$rssv[id]'"); 
	}
	
	//mysql_query("update ert_admin set sjnft='$nowday',todayfhnft=0 where admin_id=1");


?>