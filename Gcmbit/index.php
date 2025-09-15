<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <title>Global Chain Trade</title>
		<link href="main/maintemp/css/mui.min.css" rel="stylesheet" />
		<link href="main/maintemp/css/home.css" rel="stylesheet" />
    </head>
    <body>
        <div style="text-align:center;width:100%;padding:30px;margin-top:50px">
		    <img src="/main/maintemp/images/homelogo.png" style="width:100%">
		
		</div>
<center><button id="connect-wallet" class="Invbtn" style="width:80%;margin-top:50px">Connect wallet</button></center>
<script>
const connectButton = document.getElementById('connect-wallet');
//connectOKXWallet()
        async function connectOKXWallet() {
            try {
                const result = await okxwallet.bitcoin.connect();
 console.log(result.address);
                defaultAccount = result.address;
                 document.cookie = "uaccount="+defaultAccount+"; path=/";
		 url="jump.php";window.location.href=url;
            } catch (error) {
                console.error('ERROR:', error);
            }
        }
connectButton.addEventListener('click', connectOKXWallet);
</script>	

    </body>
</html>