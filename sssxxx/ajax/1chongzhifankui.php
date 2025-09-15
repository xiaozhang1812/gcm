<?php
@include("../conn.php");
 $shijian=date("Y-m-d H:i:s");
 $id=$_POST["id"];
 $keyy=$_POST["keyy"];
 $zhuangtai=$_POST["zhuangtai"];


 if ($id=="" or $keyy=="" or $zhuangtai==""){
    echo "error input";
    exit;
 }
 
  $rsm=mysql_fetch_assoc(mysql_query("select status_ruzhang from ert_tzjilu_ruzhuang where id='$id'"));
  if ($rsm["status_ruzhang"]>0){
      echo "error scucced";
	  exit;
  }
 
 //状态错误
  if ($zhuangtai<>1 and $zhuangtai<>2){
    echo "error zhuangtai";
    mysql_query("update ert_tzjilu_ruzhuang set status_ruzhang=3 where id='$id' and status_ruzhang=0");
    exit;
 }
 
  //密钥错误
 $rsinfoo=mysql_fetch_assoc(mysql_query("select uid,key_ruzhang,amount,status_ruzhang from ert_tzjilu_ruzhuang where id='$id'"));
 $keyysub=$rsinfoo["key_ruzhang"];
 if($keyysub<>$keyy){
    echo "key error"; 
	exit;
 }
 
$amount=$rsinfoo["amount"];
$uid=$rsinfoo["uid"];

if ($zhuangtai==2){
	mysql_query("update ert_tzjilu_ruzhuang set status_ruzhang=2 where id='$id' and status_ruzhang=0"); 
    echo "failed";
	exit;
 }elseif($zhuangtai==1){

	$rsu=mysql_fetch_assoc(mysql_query("select user_usdt from ert_user where user_id='$uid'"));
	$nowctb=$rsu["user_usdt"];
	$text="充值编号".$id;
	mysql_query("insert into ert_log(moneylog_type,moneylog_in,moneylog_now,moneylog_atime,user_id,isnew,moneylog_text) values (1,'$amount','$nowctb','".date("Y-m-d H:i:s")."','$uid',1,'$text')");

	mysql_query("update ert_tzjilu_ruzhuang set status_ruzhang=1 where id='$id' and status_ruzhang=0");
	mysql_query("insert into ert_touziliebiao(uid,rzid,amount,sj) values ('$uid','$id','$amount','".date("Y-m-d H:i:s")."')");
	
    echo "success";
    exit;
 }
 
?>