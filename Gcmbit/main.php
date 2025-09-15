<!DOCTYPE html>
<html lang="en">
<?php
$uaccount = $_COOKIE["uaccount"];  
?>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>3--<?php echo $uaccount?></title>
    </head>
    <body>
<?php
  $uaccount = $_COOKIE["uaccount"];
  echo $uaccount;
?>
    <script>
    this.Inval = setInterval(() => {
       this.defaultAddress = window.tronWeb.defaultAddress.base58?window.tronWeb.defaultAddress.base58 : ''
       //当获取到地址的时候就关掉定时器
       if(this.defaultAddress){
     	  window.clearInterval(this.Inval);
          if (this.defaultAddress!="<?php echo $uaccount;?>"){
		    url="index.php";window.location.href=url;  
		  }
       }
    }, 0);
    </script>
	
	
    </body>
</html>
