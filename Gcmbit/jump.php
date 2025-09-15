
<?php
@include("main/conn.php");
$uaccount = $_COOKIE["uaccount"]; 
echo $uaccount;

?>
    <title>Global Chain Merchant</title>

   <?php
   echo $uaccount;
   $resultdsjt=mysql_query("select user_id,user_isdel from ert_user where user_name='$uaccount' order by user_id asc limit 0,1");
   $rsdsjt=mysql_fetch_assoc($resultdsjt);
   if ($rsdsjt["user_id"]==0 or $rsdsjt["user_id"]=="") {
      header('Location: /main/?mod=reginput&act=regmain');
	  exit;	
   }else{
	   
 

	        $user = mysql_fetch_assoc(mysql_query("select * from ert_user where user_name='$uaccount'"));
			
	        
	

	
	$expire=time()+60*60*24*30;

    setcookie("user_id", $user['user_id'], $expire);
    setcookie("user_name", $user['user_name'], $expire);
    setcookie("user_nickname", $user['user_nickname'], $expire);
    setcookie("user_ltime", $user['user_ltime'], $expire);
    setcookie("user_wx_openid", $user['user_wx_openid'], $expire);

	if ($rsdsjt["user_isdel"]==1){
        header('Location: /main/isdel.html');	
	}else{
		header('Location: /main/user.php?mod=assets&act=in');	
	}
	
	
      exit;
   }
   ?>
