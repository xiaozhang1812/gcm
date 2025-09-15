<?php
@include("../conn.php");
 $id=$_POST["id"];
 $hash=$_POST["hash"];
 $uid=$_POST["uid"];

mysql_query("update ert_txjilu set hash='$hash',status=3 where id='$id' and uid='$uid'"); 
echo "ok"; 
?>