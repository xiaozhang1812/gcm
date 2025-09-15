<meta http-equiv="refresh" content="40">
<?php
@include("conn.php");
 
mysql_query("update ert_sxshijian set sja='".date("Y-m-d H:i:s")."' where id=1"); 

echo "运行中"; 
echo date("Y-m-d H:i:s"); 

    $ztbili = 1/100;


 
    $rstz=mysql_fetch_assoc(mysql_query("select * from ert_touziliebiao where ds=0 order by id asc limit 1"));
    $uid=$rstz["uid"];
    $tzid=$rstz["id"];
    $rzid=$rstz["rzid"];
    $j=$rstz["amount"]*$ztbili;
	$ulistv=fromlist($uid);
	
    $ulist=split(",",$ulistv);
	
	
	if ($ulist[1]>0){
		$rs1=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[1]'"));
		if ($rs1["user_ishegeson"]>0){
		    givejiang(2,$ulist[1],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[2]>0){
		$rs2=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[2]'"));
		if ($rs2["user_ishegeson"]>1){
		    givejiang(2,$ulist[2],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[3]>0){
		$rs3=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[3]'"));
		if ($rs3["user_ishegeson"]>2){
		    givejiang(2,$ulist[3],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[4]>0){
		$rs4=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[4]'"));
		if ($rs4["user_ishegeson"]>3){
		    givejiang(2,$ulist[4],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[5]>0){
		$rs5=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[5]'"));
		if ($rs5["user_ishegeson"]>4){
		    givejiang(2,$ulist[5],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[6]>0){
		$rs6=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[6]'"));
		if ($rs6["user_ishegeson"]>5){
		    givejiang(2,$ulist[6],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[7]>0){
		$rs7=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[7]'"));
		if ($rs7["user_ishegeson"]>6){
		    givejiang(2,$ulist[7],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[8]>0){
		$rs8=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[8]'"));
		if ($rs8["user_ishegeson"]>7){
		    givejiang(2,$ulist[8],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[9]>0){
		$rs9=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[9]'"));
		if ($rs9["user_ishegeson"]>8){
		    givejiang(2,$ulist[9],$j,2,"投资：".$tzid);
		}
	}
	if ($ulist[10]>0){
		$rs10=mysql_fetch_assoc(mysql_query("select user_ishegeson from ert_user where user_id='$ulist[10]'"));
		if ($rs10["user_ishegeson"]>9){
		    givejiang(2,$ulist[10],$j,2,"投资：".$tzid);
		}
	}
	
	mysql_query("update ert_touziliebiao set ds=1 where id='$tzid'"); 
	
?>