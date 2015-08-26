<?php
	$this->load->helper('form');
	$this->load->helper('url');
	$this->load->library('recaptcha');
	$code_input = array(
              'name'        => 'code_input',
              'id'          => 'code_input',
              'value'       => '',
              'maxlength'   => '256'              
              ,
            );
	$email_input = array(
              'name'        => 'email_input',
              'id'          => 'email_input',
              'value'       => '',
              'maxlength'   => '256'              
              ,
            );
	$attributes_action = array('id' => 'signupForm');	
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
					
			
				<?php echo form_open('code/submit',$attributes_action); ?>			
			
				<div class="fieldContainer">
					<div class="formRow">
						<div class="label">
							<label for="email_address">	
							輸入CODE						
							</label>
						</div>            
						
						<div class="field">						
							<?php echo form_input($code_input); ?>
						</div>						
					</div>	
					
					<div class="formRow">
						<div class="label">
							<label for="email_address">	
							輸入Email						
							</label>
						</div>            
						
						<div class="field">						
							<?php echo form_input($email_input); ?>
						</div>						
					</div>
					
					<div class="formRow1"  style="left: 15%;">						
						<div class="field">
						<?php echo $recaptcha_html; ?>
						</div>
												
					</div>
				</div>

				<div class="signupButton">
				
				<?php
					echo "<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Signup\">";
				?>					
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