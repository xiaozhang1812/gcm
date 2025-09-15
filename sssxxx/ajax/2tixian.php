<?php
@include("../conn.php");
 $shijian=date("Y-m-d H:i:s");
 $id=$_POST["id"];
 $uid=$_POST["uid"];
 $keyy=$_POST["keyy"];
 $hash=$_POST["hash"];


 if ($id=="" or $uid=="" or $keyy=="" or $hash==""){
    echo "error";
    exit;
 }
 
 $rsinfoo=mysql_fetch_assoc(mysql_query("select key_tixian from ert_txjilu where id='$id' and uid='$uid' and status_tixian=0"));

 $keyysub=$rsinfoo["key_tixian"];
 
 $uuu=strcmp($keyysub,$keyy);
 

 if($keyysub==$keyy){
    mysql_query("update ert_txjilu set hash_tixian='$hash',status_tixian=3 where status_tixian=0 and id='$id' and uid='$uid'"); 
    echo "ok"; 
	exit;
 }else{
    echo "key error"; 
	exit;
 }
 
?>