<meta http-equiv="refresh" content="600">
<?php
@include("conn.php");
echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$rsgas=mysql_fetch_assoc(mysql_query("select gasaddr from ert_admin where admin_id=1"));
$gasuser = $rsgas['gasaddr'];
$page = $_GET['page'];
$nurl = "https://btcapi.nftscan.com/api/btc/rune/transactions/account/bc1pwcxgux6lu42s3gtlfhwrr9md2nz3exypnt745pkydksld4zag9rsy709tf?rune=857753:2555&event_type=Transfer&sort_direction=asc&limit=50&cursor=".$page;
$rsadmin=mysql_fetch_assoc(mysql_query("select fwsj from ert_admin where admin_id=1"));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $nurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$headers = array();
$headers[] = 'X-API-KEY: aXFVs7vakdz6gGoc8zsy5AUV';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

//echo $result;
if (curl_errno($ch)) {
    echo '<br>Error:' . curl_error($ch);
}

$data = json_decode($result, true);

 //echo "<br><br>".$data['data']['content'];
$ndata = $data['data']['content'];
foreach($ndata as $ndata){
	if ($ndata['receive']==$gasuser and $ndata['send']!==$ndata['receive'] and $ndata['send'] and $ndata['receive']){
		$sj = date('Y-m-d H:i:s',$ndata['timestamp']/1000);
		mysql_query("insert into ert_fw_ruzhang(address,amount,hash,timestamp,shijian) values ('$ndata[send]','$ndata[amount]','$ndata[tx_id]','$ndata[timestamp]','$sj')");
	    mysql_query("update ert_admin set fwsj='$ndata[timestamp]' where admin_id=1");
		/*
		echo "<br>hash：".$ndata['tx_id'];
		echo "<br>时间戳：".$ndata['timestamp'];
		echo "<br>发送人：".$ndata['send'], '';
		echo "<br>接受人：".$ndata['receive'];
		echo "<br>数量：".$ndata['amount'];
		*/
	}
	//echo '<br>';
}
if ($data['data']['next']){
	$npage = "?page=".$data['data']['next'];
	?>
	<meta http-equiv="refresh" content="8;url=<?php echo $npage?>">
	<?php
    }else{ 
    ?>
   <meta http-equiv="refresh" content="3000">
	<?php
}
exit;

?>