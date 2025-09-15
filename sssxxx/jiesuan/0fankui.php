<script src="../js/jquery-1.11.1.min.js"></script>
<?php
@include("conn.php");
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 
echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$nowsj = date("Y-m-d H:i:s");
$nowday = date("Y-m-d");

class User {
	public $id;
	public $amount;
	public $key;
	public $receiveAddress;
}


function decodeUnicode($str){
  return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
    create_function(
      '$matches',
      'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
    ),
    $str);
}


$resultsv=mysql_query("select * from ert_txjilu where leixing=1 and (id=129 or id=130) order by rand() limit 10");
if($resultsv){
	$idlist ="";
    while ($row=mysql_fetch_assoc($resultsv))
        {
		$idlist = $idlist.','.$row["id"];
	}
	//echo $jsonb;
    //echo "<br>".$idlist;

?> 

   <script type="text/javascript">
   

var idlist = "<?php echo $idlist?>";


var hash="45646";
		
		
posthash(idlist,hash);

function posthash(idlist,hash) {		
	$.post("../ajax/6gscjson.php",{idlist:idlist,hash:hash}),
	function(data){
		console.log(data);
		console.log(idlist);
	}
}

    </script>

	
<?php	
}else{
	echo "查询失败";
}

mysql_close($conn);
?>




