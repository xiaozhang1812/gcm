<?php
@include("../conn.php");
 $hash=$_POST["hash"];
 $idlist=explode(',',$_POST["idlist"]);
 
 //echo $idlist;
 
for($i=0;$i<count($idlist);$i++){  
   echo $idlist[$i]."<br>";  
   mysql_query("update ert_txjilu set hash='$hash',status=3 where id='$idlist[$i]'"); 
}  
echo "ok"; 

/*
mysql_query("update ert_txjilu set hash='$hash' where id in ($idlist)"); 
echo "ok"; 
*/
?>