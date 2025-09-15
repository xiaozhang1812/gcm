<?php
@include("conn.php");
 $btcprice=$_POST["btcprice"];
 mysql_query("update ert_admin set btcprice='$btcprice' where admin_id=1");
?>