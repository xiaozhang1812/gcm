
<?php
@include("conn.php");
 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 

$resultsv=mysql_query("select * from ert_txjilu where leixing=1 and status=0 order by id asc limit 0,160");
while ($rssv=mysql_fetch_assoc($resultsv))
{   
    echo $rssv['id']."<br>";
	$info=mysql_fetch_assoc(mysql_query("select user_name from ert_user where user_id='$rssv[uid]'"));
    $keya =round($rssv['amount']);
	$keyb = md5(substr($info['user_name'], 10, 2));
	$keyc = $info['user_name'];

	$keyy = $keya.$keyb.$keyc.$rssv['keyid'];
			
	$txkey = md5($keyy);
			
	mysql_query("update ert_txjilu set key_tixian='$txkey' where id='$rssv[id]'");
}
?>