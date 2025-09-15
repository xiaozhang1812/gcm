<?php
@include("../conn.php");
 $valuee=$_POST["valuee"];
 $type=$_POST["type"];
	
 if ($type==11 and $valuee>0){
  mysql_query("update ert_admin set gasyue='$valuee' where admin_id=1"); 
 }
 echo $valuee;
?>