<meta http-equiv="refresh" content="32">
 <?php
 //V和平级
 @include("conn.php");
mysql_query("update ert_sxshijian set sj='".date("Y-m-d H:i:s")."' where id=5"); 
$nowf=date("i");
$nows=date("H");

echo "运行中"; 
echo date("Y-m-d H:i:s"); 
echo "<br>";

$pjbili = 0.2;
$shouyilvjishu="0,0.04,0.08,0.12,0.16,0.20"; 
$shouyilvjishutemp=split(",",$shouyilvjishu);


function tuanduiv($vvid,$vmax,$jichuid){
    static $n = 0;
	static $ulistv = "0";

    $rsnn=mysql_fetch_assoc(mysql_query("select user_id,user_fromid,user_vdengji from ert_user where user_id='$vvid' "));
	$xianzaidengji=$rsnn["user_vdengji"];
    if ($rsnn["user_id"]==$jichuid){
	    $xianzaidengji=0; 	
	}
	if ($xianzaidengji>$vmax)
	{  
       if ($rsnn["user_id"]!=$jichuid){
	    $ulistv=$ulistv.','.$rsnn["user_id"]; 
	    $vmax=$rsnn["user_vdengji"]; 
	   }
	}	
    $n=$n+1;
    if($n<10000 and $rsnn["user_fromid"]<>0 and $rsnn["user_vdengji"]<5){
        tuanduiv($rsnn["user_fromid"],$vmax,$jichuid);
    }
	return $ulistv;

}


function dsjulistt($xid,$vlei){
	
    $rsnn=mysql_fetch_assoc(mysql_query("select user_id,user_fromid from ert_user where user_id='$xid' "));
	$rsnv=mysql_fetch_assoc(mysql_query("select user_id,user_vdengji from ert_user where user_id='$rsnn[user_fromid]' "));


    if ($vlei==1){
		static $dsjlistva="0";
        static $na = 0;
        static $ma = 0;
	        if ($rsnn["user_fromid"]<>0 and $rsnv["user_vdengji"]==$vlei){
	           $dsjlistva=$rsnn["user_fromid"];
			   $ma=1;
	        }
        $na=$na+1;
        if($na<10000 and $ma==0 and $rsnn["user_fromid"]<>0){
            dsjulistt($rsnn["user_fromid"],1);
        }
	    return $dsjlistva; 
		
	}elseif ($vlei==2){
		static $dsjlistvb="0";
        static $nb = 0;
		static $mb = 0;
	        if ($rsnn["user_fromid"]<>0 and $rsnv["user_vdengji"]==$vlei){
	           $dsjlistvb=$rsnn["user_fromid"];
			   $mb=1;
	        }
        $nb=$nb+1;
        if($nb<10000 and $mb==0 and $rsnn["user_fromid"]<>0){
            dsjulistt($rsnn["user_fromid"],2);
        }
	    return $dsjlistvb; 
		
	}elseif ($vlei==3){
		static $dsjlistvc="0";
        static $nc = 0;
		static $mc = 0;
	        if ($rsnn["user_fromid"]<>0 and $rsnv["user_vdengji"]==$vlei){
	           $dsjlistvc=$rsnn["user_fromid"];
			   $mc=1;
	        }
        $nc=$nc+1;
        if($nc<10000 and $mc==0 and $rsnn["user_fromid"]<>0){
            dsjulistt($rsnn["user_fromid"],3);
        }
	    return $dsjlistvc; 
		
	}elseif ($vlei==4){
		static $dsjlistvd="0";
        static $nd = 0;
		static $md = 0;
	        if ($rsnn["user_fromid"]<>0 and $rsnv["user_vdengji"]==$vlei){
	           $dsjlistvd=$rsnn["user_fromid"];
			   $md=1;
	        }
        $nd=$nd+1;
        if($nd<10000 and $md==0 and $rsnn["user_fromid"]<>0){
            dsjulistt($rsnn["user_fromid"],4);
        }
	    return $dsjlistvd; 
		
	}elseif ($vlei==5){
		static $dsjlistve="0";
        static $ne = 0;
		static $me = 0;
	        if ($rsnn["user_fromid"]<>0 and $rsnv["user_vdengji"]==$vlei){
	           $dsjlistve=$rsnn["user_fromid"];
			   $me=1;
	        }
        $ne=$ne+1;
        if($ne<10000 and $me==0 and $rsnn["user_fromid"]<>0){
            dsjulistt($rsnn["user_fromid"],5);
        }
	    return $dsjlistve; 
		
	}
}



$shouyilvjishutemp=split(",",$shouyilvjishu);

$rsdsj=mysql_fetch_assoc(mysql_query("select * from ert_touziliebiao where jc=0 order by id asc limit 0,1"));

	$uid=$rsdsj["uid"];
	$id=$rsdsj["id"];
    $tzid=$rsdsj["id"];


    $ulistv=tuanduiv($uid,0,$uid);

	
	$dsjson=split(",",$ulistv);	
	
	
	
	for($io = 1 ; $io < count($dsjson) ; $io++){
      static $tuanduivbili="0";
      $rsnv=mysql_fetch_assoc(mysql_query("select user_vdengji from ert_user where user_id='$dsjson[$io]' "));
	  
	  if ($rsnv["user_vdengji"]==1){
		$xinbili=$shouyilvjishutemp[1];
		
	  }
	  elseif ($rsnv["user_vdengji"]==2){
		$xinbili=$shouyilvjishutemp[2];
		
	  }
	  elseif ($rsnv["user_vdengji"]==3){
		$xinbili=$shouyilvjishutemp[3];
		
	  }
	  elseif ($rsnv["user_vdengji"]==4){
		$xinbili=$shouyilvjishutemp[4];
		
	  }
	  elseif ($rsnv["user_vdengji"]==5){
		$xinbili=$shouyilvjishutemp[5];
		
	  }

      $tuanduivbili=$tuanduivbili.','.$xinbili;
	  $shouyilv=split(",",$tuanduivbili);
 
    }

	
	
	if ($dsjson[1]<>""){
		$jianga=$rsdsj["amount"]*($shouyilv[1]-$shouyilv[0]);	
		if ($jianga>0){
		  givejiang(2,$dsjson[1],$jianga,3,"投资：".$tzid);
		  $ajson=split(",",dsjulistt($dsjson[1],1));
		  $vpa = $jianga*$pjbili;
          givejiang(2,$ajson[0],$vpa,4,"投资：".$tzid."，来自于级差会员：".$dsjson[1]);
		}
	}
	if ($dsjson[2]<>""){
		$jiangb=$rsdsj["amount"]*($shouyilv[2]-$shouyilv[1]);	
		if ($jiangb>0){
		  givejiang(2,$dsjson[2],$jiangb,3,"投资：".$tzid);
		  $bjson=split(",",dsjulistt($dsjson[2],2));
		  $vpb = $jiangb*$pjbili;		  
          givejiang(2,$bjson[0],$vpb,4,"投资：".$tzid."，来自于级差会员：".$dsjson[2]);
		}
	}
	if ($dsjson[3]<>""){
		$jiangc=$rsdsj["amount"]*($shouyilv[3]-$shouyilv[2]);	
		if ($jiangc>0){
		  givejiang(2,$dsjson[3],$jiangc,3,"投资：".$tzid);
		  $cjson=split(",",dsjulistt($dsjson[3],3));	
		  $vpc = $jiangc*$pjbili;
          givejiang(2,$cjson[0],$vpc,4,"投资：".$tzid."，来自于级差会员：".$dsjson[3]);
		}
	}
	if ($dsjson[4]<>""){
		$jiangd=$rsdsj["amount"]*($shouyilv[4]-$shouyilv[3]);	
		if ($jiangd>0){
		  givejiang(2,$dsjson[4],$jiangd,3,"投资：".$tzid);
		  $djson=split(",",dsjulistt($dsjson[4],4));
		  $vpd = $jiangd*$pjbili;		  
          givejiang(2,$djson[0],$vpd,4,"投资：".$tzid."，来自于级差会员：".$dsjson[4]);
		}
	}
	if ($dsjson[5]<>""){
		$jiange=$rsdsj["amount"]*($shouyilv[5]-$shouyilv[4]);	
		if ($jiange>0){
		  givejiang(2,$dsjson[5],$jiange,3,"投资：".$tzid);
		  $ejson=split(",",dsjulistt($dsjson[5],5));
		  $vpe = $jiange*$pjbili;		  
          givejiang(2,$ejson[0],$vpe,4,"投资：".$tzid."，来自于级差会员：".$dsjson[5]);
		}
	}


	mysql_query("update ert_touziliebiao set jc=1,pj=1 where id='$tzid'"); 

?>