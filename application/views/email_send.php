<?php
	$this->load->helper('url');	
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8">
	<title>Ingress啟動碼</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."style.css"; ?>" />
</head>
<body>

<div id="container">
	<div id="body">							
		<div id="carbonForm">
			<h1><img src="https://lh3.ggpht.com/j8lGWdhEjmw5rVZ6CiJY_k5D0iPqp_jomAUdyS_n8v5SUQVb8Dt-USXUZXmx1QAca8zJ=w96" alt="Google+" style="border:0;width:96px;height:96px;"/> Ingress 互助</h1>
				<div class="fieldContainer">																
					<div class="formRow2"  style="left: 10%;">								
							<div class="field">								
							<p><?php echo $warrning;?></p>							
							</div>
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