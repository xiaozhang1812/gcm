<?php
@include("../conn.php");
 $btc=$_POST["btc"];
 mysql_query("update ert_admin set btc='$btc' where admin_id=1");
?>