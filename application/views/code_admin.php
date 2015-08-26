<?php	
	$this->load->helper('url');	
	$amount = count($pending_code_list);
	$height_size = 20 * ($amount);
	?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8">
	<title>Ingress啟動碼</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<!-- http://tutorialzine.com/2010/04/carbon-signup-form/ 
	-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."style.css"; ?>" />
		
	</head>
<body>
<div id="container">
	
	<div id="body">		
		<div id="carbonForm">
			<h1><img src="https://lh3.ggpht.com/j8lGWdhEjmw5rVZ6CiJY_k5D0iPqp_jomAUdyS_n8v5SUQVb8Dt-USXUZXmx1QAca8zJ=w96" alt="Google+" style="border:0;width:96px;height:96px;"/> Ingress 互助</h1>
				<div class="fieldContainer" style="left: 1%">					
					<div class="formRow"  style="left: 1%;height:<?php echo $height_size; ?>px;">	
					<p>以下為單一啟動碼贈送:<br></p>
					<?php
					
					if($amount == 0){
						echo "empty";
				
					}else{	
						echo "<script type='text/javascript'>".
							"function submitDM(id){".
								"if( confirm('真的？') )".
								"document.forms[id].submit();}</script>";
						for ($z=0; $z<$amount; $z++){
							$delete = array(
									'code_id'  => $pending_code_list[$z]['code_id'],
									'action'  => 'delete'
								);
							$confirm = array(
									'code_id'  => $pending_code_list[$z]['code_id'],
									'action'  => 'confirm'
								);
							$submit_confirm = array(
									'named'  => 'sub',
									'value'  => ' 確認 ',
									'onclick'  => 'submitDM("form_con'.$z.'")'
								);
							$submit_delete = array(
									'named'  => 'sub',
									'value'  => ' 刪除 ',
									'onclick'  => 'submitDM("form_del'.$z.'")'
								);
							$attributes_c = array('id' => 'form_con'.$z);
							$attributes_d = array('id' => 'form_del'.$z);
							
							$get_provider = $this->db->get_where('provider', array('provider_id' => $pending_code_list[$z]['provider_id']));
							$get_provider = $get_provider->result_array();
							
							echo "<div style=\"height:50;width:100%;float:left\">".$pending_code_list[$z]['code']." [".$get_provider[0]['email_address']."] "."<div style=\"width:250;float:right;\">".form_open('code/admin',$attributes_c).form_hidden($confirm). form_submit($submit_confirm).form_close()."</div>".
									"<div style=\"height:50;width:100;float:right\">".form_open('code/admin',$attributes_d).form_hidden($delete). form_submit($submit_delete).form_close()."</div></div>";
						}
					}
					
					?>
					</div>
				</div>			
			</form>		
		</div>		
	</div>
	<p id="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18420763-4']);
  _gaq.push(['_setDomainName', 'conic.me']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>