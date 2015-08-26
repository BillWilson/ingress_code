<?php
	$this->load->helper('form');
	$this->load->helper('url');		
	$email_input = array(
              'name'        => 'email_input',
              'id'          => 'email_input',
              'value'       => '',
              'maxlength'   => '256'              
              ,
            );
				
	$check_code_query = $this->db->limit(10)->get_where('activation_code', array('check' => '0'));
	$check_code_result = $check_code_query->result_array();
	$amount = count($check_code_result);		
	//$amount = -1;
	$attributes_action = array('id' => 'signupForm');
	$attributes_email_input = array('id' => 'signupForm');
	
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8">
	<title>Ingress启动码</title>
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
			
			<br><h3><a href="<?php echo base_url()."code"; ?>">按这提供启动码</a> | <a href="<?php echo base_url()."email/already"; ?>">已经发送列表</a> | <a href="http://ingresscn.com/">Supported by IG中文网</a> </h3>			
			
			<?php echo form_open('email/send',$attributes_action); ?>			
			
				<div class="fieldContainer">
					<div class="formRow">
						<div class="label">
							<label for="email_address">	
							<?php 
								if ($amount > 0){
									echo "Email地址";
									}else{
									echo "";
									}
							?>							
							</label>
						</div>            
						
						<div class="field">						
							<?php 
								if($amount > 0){
									echo form_input($email_input); 	
								}elseif($amount = -1){
									echo "<h2>【系统维护暂停开放 20120228】</h2>";
								}else{
									echo "<h2>【目前启动码已经发送完毕，请静待好心人贡献】</h2>";
								}
							?>
						</div>						
						</div>												
					<div class="formRow1"  style="left: 10%;">	
							<div class="label">							
							</div>
							<div class="field">								
							<p><br>如可以提供大量的邀请码，请用excel试算表储存后附加为附件寄出至ingresscode[at]conic.me</b>							
							<p><br>
							<li >PS1: 一个email只能索取一次，请用不会寄丢的email来收信</li>
							<li >PS2: 如果真的没收到请来信到 ingresscode[at]conic.me</li>
							<li >PS3: 买不起 Orz</li>			
							<li >PS4: 还没出 :p</li></p>
							</p>
							</div>
					</div>													
				</div>

				<div class="signupButton">
				<?php
					if($amount > 0){
						echo "<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Signup\">"; 												
					}
				?>					
				</div>
			</form>			
		</div>
		<!-- <div><h1 >留言區: <a href="https://docs.google.com/forms/d/1TJzqaMcNjah-KF1DtQ0AwBEwibgQJyAb3GRM5f4SC6c/viewform" target="_blank">按這留言</a></h1><br><iframe width='800' height='300' frameborder='0' src='https://docs.google.com/spreadsheet/pub?key=0AuMGV1Q-Q6QNdDM3WWlXdE1PVmYyWk1Kc1dIbTB6Zmc&single=true&gid=2&output=html&widget=true&chrome=false'></iframe></div>
		!-->
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