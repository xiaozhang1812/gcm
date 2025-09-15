<?php
@include("../conn.php");
 $id=$_POST["id"];
 $keyy=$_POST["keyy"];
 $zhuangtai=$_POST["zhuangtai"];


 if ($id=="" or $keyy=="" or $zhuangtai==""){
    echo "1";
    exit;
 }
 
 
 $rsinfoo=mysql_fetch_assoc(mysql_query("select * from ert_txjilu where id='$id'"));
 
 if($rsinfoo["status_tixian"]!=3){
    echo "5"; 
	exit;
 }

 $keyysub=$rsinfoo["key_tixian"];
 
 if($keyysub<>$keyy){
    echo "2"; 
    mysql_query("update ert_txjilu set status_tixian=2 where id='$id'");
	exit;
 }
 
 if ($zhuangtai==2){
	mysql_query("update ert_txjilu set status_tixian=2 where id='$id'"); 
    echo "6";
	exit;
 }elseif($zhuangtai==1){
	mysql_query("update ert_txjilu set status_tixian=1 where id='$id'");
    echo "3";
    exit;
 }
  
?>