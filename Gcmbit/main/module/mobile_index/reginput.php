<?php
switch($act) {
	case 'regmain':
	    $uaccount = $_COOKIE["uaccount"];
		  $uuu = $db->pe_select('user', array('user_name'=>$username));
		  if ($uuu['user_id']>0){
            pe_goto($url = 'index.php', $type = 'default');
			exit; 
		  }
		  
 		include(pe_tpl('reginput.html'));
	break;
	
	case 'regsub':
	    $username = $_COOKIE["uaccount"];
		if (isset($_p_pesubmit)) {

		  if ($_p_code=="") pe_jsonshow(array('result'=>false, 'show'=>'Please enter the recommendation code'));
		  
		  $uu = $db->pe_select('user', array('user_name'=>$username));
		  if ($uu['user_id']>0){
			pe_jsonshow(array('result'=>true, 'show'=>'Success!'));
            pe_goto($url = 'index.php', $type = 'default');
			 exit; 
		  }
		  

          $uleft = $db->pe_select('user', array('user_tuijianma'=>$_p_code));				  
		  if ($uleft['user_id']=="") pe_jsonshow(array('result'=>false, 'show'=>'Wrong code'));
  
		  
			
			$sql_set['user_name'] = $username;
			$sql_set['user_fromid'] = $uleft['user_id'];

			$sql_set['user_shijian'] = date("Y-m-d H:i:s");

			if ($user_id = $db->pe_insert('user', pe_dbhold($sql_set))) {
				
				pe_jsonshow(array('result'=>true, 'show'=>'Success!'));
                pe_goto($url = 'index.php', $type = 'default');
				
			}else{
			    pe_jsonshow(array('result'=>false, 'show'=>'Wrong code'));
			}
		  
				
		}else {
			pe_jsonshow(array('result'=>false, 'show'=>'Wrong code'));
		}
		
		
	break;
}
?>