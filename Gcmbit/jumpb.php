
<?php
@include("main/conn.php");
$uaccount = $_COOKIE["uaccount"]; 
?>

<script src="/coin/js/jquery.js"></script>
<script src="/coin/js/tron.js"></script>
    <script>
    this.Inval = setInterval(() => {
       this.defaultAddress = window.tronWeb.defaultAddress.base58?window.tronWeb.defaultAddress.base58 : ''
       //当获取到地址的时候就关掉定时器
       if(this.defaultAddress){
     	  window.clearInterval(this.Inval);
          if (this.defaultAddress!="<?php echo $_COOKIE["uaccount"];?>"){
		    url="index.php";window.location.href=url;  
		  }
       }
    }, 0);
    </script>



   <?php

	$user = mysql_fetch_assoc(mysql_query("select * from ert_user where user_name='$uaccount'"));

	
	$expire=time()+60*60*24*30;

    setcookie("user_id", $user['user_id'], $expire);
    setcookie("user_name", $user['user_name'], $expire);
    setcookie("user_nickname", $user['user_nickname'], $expire);
    setcookie("user_ltime", $user['user_ltime'], $expire);
    setcookie("user_wx_openid", $user['user_wx_openid'], $expire);

	
    header('Location: /main/user.php?mod=assets&act=in');	  


   ?>
