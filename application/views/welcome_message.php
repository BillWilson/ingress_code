<?php
	$run = 0;
	$import_run = 0;
		
		$this->load->helper('date');
		function MakePass($length){ 
			$possible = "0123456789"."ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
			$str = ""; 
			while(strlen($str) < $length){ 
				$str .= substr($possible, (rand() % strlen($possible)), 1); 
			} 
			return($str); 
		} 
		$time = now();
		if ($run == 1){
			for ($i=0; $i < 10; $i++){	
				$code = MakePass(8);
				$codesha1 = sha1($code);
				$time = $time - 43200;
				$email = $code."@gmail.com";
							
				$now = time();
				//echo timespan($time,$now)."<br>";
				
				$data = array(
					'code' => $code ,
					'codesha1' => $codesha1,
					//'email' => $email,
					'time' => 0,
					'provider_id' => 1,
					'check' => 0
				);		
				$this->db->insert('activation_code', $data); 			
				
			}
		}

		
		if ($import_run == 1){
			/*
			//$this->load->library('Csvreader');
			$this->load->helper('url');	
			
			$filePath = base_url().'out.csv';      
			$go = $this->csvreader->parse_file($filePath);
			//echo $go[0]['code'];
			
			
				foreach ($go as $key => $v2) {
					$codesha1 = sha1($go[$key]['code']);
					$code_data = array(
						'code' => $go[$key]['code'] ,						
						'codesha1' => $codesha1 ,
						'provider_id' => 4,
						'check' => 0
					);		
					$this->db->insert('activation_code', $code_data);
					echo $go[$key]['code'].", ";						
				}
			*/
			$row = 1;
			$this->load->helper('url');	
			if (($handle = fopen(base_url().'out.csv', "r")) !== FALSE) {
				 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					
					$codesha1 = sha1($data[0]);
					$code_data = array(
						'code' => $data[0] ,						
						'codesha1' => $codesha1 ,
						'provider_id' => 4,
						'check' => 0
					);		
					$this->db->insert('activation_code', $code_data);
					
					echo $data[0]." - ".$codesha1."<br>";
				}					
			}
			fclose($handle);
		}
		
		//$this->db->select('title')->from('mytable')->where('id', $id)->limit(10, 20);
		//$query = $this->db->get();		
		
		// $this->db->like('check', '1')->from('activation_code')->count_all_results();		
		
		/*
		$time = $time - 86400;		
		$query = $this->db->order_by("time", "desc")->get_where('activation_code', array('check' => '1','time <' => $time));
		$available_code_list = $query->result_array();	
		$now = time();
		foreach ( $available_code_list as $key => $value){
			echo timespan($value['time'],$now)."<br>";//."Key: $key - ".$value['code_id'].";       <br />\n";
		}
		
		
		$now = time();
		//echo timespan('',$now);
		//echo $_SERVER['HTTP_USER_AGENT'];
		if (!($this->agent->accept_lang('zh-tw')))
		{
			//echo 'You accept tw!';
		}
		
		if ($this->agent->accept_lang('zh-cn'))
		{
			//echo 'You accept cn!';
		}
				
				$email_address = "f1207bill@pixnet.net";
				$check_mail_query = $this->db->get_where('activation_code', array('email' => $email_address));
				$check_mail_result = $check_mail_query->result_array();	
				echo $check_mail_result[0]['provider_id'];
		
				$provider_query = $this->db->get_where('provider', array('provider_id' => $check_mail_result[0]['provider_id']));
				$provider_result = $provider_query->result_array();
				echo $email_provider = $provider_result[0]['email_address'];
				
			*/			

?><!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8">
	<title>歡迎來到互助會</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>歡迎來到互助會</h1>

	<div id="body">		
		<table cellpadding="0" cellspacing="0">
    <thead>
    <th>
            <td>PRODUCT ID</td>            
    </th>
    </thead>
 
    <tbody>
            <?php //foreach($go  as $show){?>
                <tr>
                    <td><?php //echo $show['code'];?></td>                   
                </tr>
            <?php //}?>
    </tbody>
 
</table>
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>