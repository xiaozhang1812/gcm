<meta http-equiv="refresh" content="10">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$nowsj = date("Y-m-d H:i:s");
$nowday = date("Y-m-d");
$rsuab=mysql_fetch_assoc(mysql_query("select * from ert_fw_ruzhang where status=0 order by rand() limit 0,1"));
$rsuac=mysql_fetch_row(mysql_query("select * from ert_tzjilu_ruzhuang where hash_ruzhang='$rsuab[hash]'"));
if ($rsuac[0]>0){
	mysql_query("update ert_fw_ruzhang set status=1 where id='$rsuab[id]'");
	exit;
}
//$rsuab=mysql_fetch_assoc(mysql_query("select * from ert_fw_ruzhang order by rand() limit 0,1"));
$rsu=mysql_fetch_assoc(mysql_query("select user_id,user_name from ert_user where user_name = '$rsuab[address]' order by user_id asc")); 

if ($rsu['user_name']){
        //echo $rsu['user_name'].'<br>';
        //echo $rsuab[hash].'<br>';
		$rz=mysql_fetch_assoc(mysql_query("select * from ert_tzjilu_ruzhuang where uid='$rsu[user_id]' order by id desc limit 0,1"));
		$uid = $rsu["user_id"];
		$username = $rsu['user_name'];
        $rzid = $rz["id"];
		$keyymain = "string($uid) string($username) string($rzid)";
        $keyy = md5($keyymain);
		//echo $keyy;

		mysql_query("insert into ert_tzjilu_ruzhuang(leixing,uid,amount,shijian_ruzhang,hash_ruzhang,status_ruzhang,key_ruzhang) values (1,'$rsu[user_id]','$rsuab[amount]','$rsuab[shijian]','$rsuab[hash]',0,'$keyy')");
		mysql_query("update ert_fw_ruzhang set status=1 where id='$rsuab[id]'");
	}
?>
