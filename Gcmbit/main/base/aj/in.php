<?php
@include("conn.php");
 $shijian=date("Y-m-d H:i:s");
 $amount=$_POST["amount"];
 $uid=$_POST["uid"];
 $hash=$_POST["hash"];
 $keyy=$_POST["keyy"];
 $leixing=$_POST["leixing"];

/*
 if ($amount==0 or $amount=="" or $uid==0 or $uid=="" or $hash=="" or $keyy==""){
    echo "2";
    exit;
 }
 
  $rsinfoo=mysql_fetch_row(mysql_query("select count(*) from ert_tzjilu_ruzhuang where hash_approve='$hash'"));
  if ($rsinfoo[0]>0){
    echo "1";
    exit;
  }
  */
 
 $rstz=mysql_fetch_assoc(mysql_query("select id from ert_tzjilu_ruzhuang where uid='$uid' order by id desc limit 0,1"));
 $rsinfo=mysql_fetch_assoc(mysql_query("select user_name from ert_user where user_id='$uid'"));
 $user_name=$rsinfo["user_name"];
 $tzid=$rstz["id"];

 $keyysubo="string($uid) string($user_name) string($tzid)" ;
 $keyysub=md5($keyysubo);
 

 if ($amount>0 and $uid>0 and $hash<>""){
	 $resultdsjt=mysql_query("select count(*) from ert_user where user_id='$uid'");
	 $rsdsjt=mysql_fetch_row($resultdsjt);
	 if ($rsdsjt[0]>0){
         mysql_query("insert into ert_tzjilu_ruzhuang(uid,amount,shijian_ruzhang,hash_ruzhang,key_ruzhang,leixing) values('$uid','$amount','$shijian','$hash','$keyy','$leixing')");
         echo "1";
         exit;
	 }else{
         echo "5"; 
         exit;
	 }	 
 }else{
	 echo "6";
     exit;
 }

?>