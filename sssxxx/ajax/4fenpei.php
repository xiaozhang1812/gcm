<?php
@include("../conn.php");
 $shijian=date("Y-m-d H:i:s");
 $id=$_POST["id"];
 $hash=$_POST["hash"];


if ($id=="" or $hash==""){
    echo "error";
    exit;
}

mysql_query("update ert_touziliebiao set fphash='$hash',fp=1 where fphash is null and fp=0 and id='$id'"); 
echo "ok"; 
exit;
 
?>