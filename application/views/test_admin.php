<?php		
	$this->load->helper('url');			
	$amount = count($pending_users);
	$height_size = 20 * ($amount);
	
	$query_check = $this->db->limit(10)->get_where('activation_code', array('check' => '0'));
	$check_amount = $query_check->result_array();	
	
	$code_amount = count($check_amount);	
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
	<script type="text/javascript" src="<?php echo base_url()."email_check.js"; ?>"></script>	
	</head>
<body>
<div id="container">
	
	<div id="body">		
		<div id="carbonForm">
			<h1><img src="https://lh3.ggpht.com/j8lGWdhEjmw5rVZ6CiJY_k5D0iPqp_jomAUdyS_n8v5SUQVb8Dt-USXUZXmx1QAca8zJ=w96" alt="Google+" style="border:0;width:96px;height:96px;"/> Ingress 互助</h1>
			<form>	
				<div class="fieldContainer">
				<div class="formRow"  style="left: 1%;height:<?php echo $height_size; ?>px;">	
					<p>以下為:<br></p>
					<?php
				if ($code_amount > 0){
					
					if($amount == 0){
						echo "Requesting database is empty. ";
				
					}else{	
						$this->load->helper('form');
						for ($z=0; $z<$amount; $z++){
							$delete = array(
									'email'  => $pending_users[$z]['email'],
									'action'  => 'delete'
								);
							$confirm = array(
									'email'  => $pending_users[$z]['email'],
									'action'  => 'confirm'
								);
							$submit_confirm = array(
									'named'  => 'sub',
									'value'  => ' 合格 '
								);
							$submit_delete = array(
									'named'  => 'sub',
									'value'  => ' 不合格 '
								);
							$attributes_c = array('id' => 'form_con');
							$attributes_d = array('id' => 'form_del');							
							
							
							echo "<div style=\"height:50;width:100%;float:left\">".$pending_users[$z]['email']."<div style=\"width:250;float:right;\">".form_open('test/admin',$attributes_c).form_hidden($confirm). form_submit($submit_confirm).form_close()."</div>".
									"<div style=\"height:50;width:100;float:right\">".form_open('test/admin',$attributes_d).form_hidden($delete). form_submit($submit_delete).form_close()."</div></div>";
						}
					}
				}else{
					echo "<h2>Warrning: Not enough code, import code first.</h2>";
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