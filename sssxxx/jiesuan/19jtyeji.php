<meta http-equiv="refresh" content="20">
<?php
@include("conn.php");
 


echo "运行中"; 
echo date("Y-m-d H:i:s"); 
$nowday = date("Y-m-d");
/*
    $resultsv=mysql_query("select user_id,user_jtjishu from ert_user where user_isjt=0 and user_jtjishu>0 order by user_id asc limit 0,60");

    while ($rssv=mysql_fetch_assoc($resultsv)){   

	        mysql_query("insert into ert_touziliebiaojtb(uid,amount,sj,sfsj) values ('$rssv[user_id]','$rssv[user_jtjishu]','$nowday','$nowday')");
		    mysql_query("update ert_user set user_isjt=1 where user_id='$rssv[user_id]'");
    }

	*/
/*
    $resultsv=mysql_query("select * from ert_touziliebiao where isnft=1 and isnftb=0 order by id asc limit 0,30");

    while ($rssv=mysql_fetch_assoc($resultsv)){   

			mysql_query("update ert_touziliebiaojtb set jtjishu=jtjishu-'$rssv[amount]',isnft=1 where uid='$rssv[uid]'");

		    mysql_query("update ert_touziliebiao set isnftb=1 where uid='$rssv[uid]'");
    }
*/

    $resultsv=mysql_query("select user_id from ert_user where user_isnft=1 and user_isjt=0 order by user_id asc limit 0,60");

    while ($rssv=mysql_fetch_assoc($resultsv)){   

			mysql_query("update ert_touziliebiaojtb set isnft=isnft+1 where uid='$rssv[user_id]'");
		    mysql_query("update ert_user set user_isjt=1 where user_id='$rssv[user_id]'");
    }
?>