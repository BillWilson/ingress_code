<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email extends CI_Controller {
	
	public function index()
	{
		$this->load->view('email_submit');			
	}
	public function send()
	{					
		/*  
			check
				1 => send
				0 => not send
		*/
		$this->load->helper('url');		
		$this->load->helper('date');
		
		// Check if the system is available to give code
		$query = $this->db->limit(10)->get_where('activation_code', array('check' => '0'));
		$available_code_list = $query->result_array();		
		
		// Close the warrning, for the annoying message
		error_reporting(0);		
		$warrning = '';
		
		// Check the email
		function isValidEmail($email_a){  
			return filter_var(filter_var($email_a, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);  
			}		
			
		// Get the var we need
		$email_address = $this->input->get_post('email_input', TRUE);		
		$hash = $available_code_list[0]['codesha1'];
		$code_id = $available_code_list[0]['code_id'];	
		$ip_address = $this->input->ip_address();
		$time = now();		
		
		// Prevent some guys from trying to avoid the checking
		if (empty($email_address)){
		
				// Player can't get here without the email address
				$home_url = base_url();
				header("Location: $home_url");
				exit;
			}else{
				if(isValidEmail($email_address)){
					
				}else{
				
					// If the email address is not correct, get out of here
					$home_url = base_url();
					header("Location: $home_url");
					exit;
				}
			}
		
		// Check if this player already get the code
		$check_mail_query = $this->db->get_where('activation_code', array('email' => $email_address));
		$check_mail_result = $check_mail_query->result_array();	
		
		// Check if the player has been submitted the email
		$check_ip_query = $this->db->get_where('ipcheck', array('ip_address' => $ip_address));
		$check_ip_result = $check_ip_query->result_array();				
		
		// Get the email of the owner
		$check_mail_ver_query = $this->db->get_where('ipcheck', array('email' => $email_address));
		$check_mail_ver_result = $check_mail_ver_query->result_array();
		
		// Get the total amount of code
		$amount = count($available_code_list);	
		
		if ($check_mail_result[0]['check'] == 1){				
				$warrning = "已經申請過了，如果沒有收到mail，請通知管理員。";	
				
			}elseif(!empty($check_ip_result[0]['email']) && $check_ip_result[0]['mail_check'] == 0){
				$warrning = "請先驗證你的email，有問題請聯絡管理員";	
							
			}elseif(!empty($check_ip_result[0]['email']) && $check_ip_result[0]['mail_check'] == 9){
				$warrning = "請先做完測驗";						
				
			}elseif(!empty($check_ip_result[0]['email']) && $check_mail_ver_result[0]['mail_check'] == 9){
				$warrning = "請先做完測驗2";						
			
			}elseif($amount == 0){
				$warrning = "【目前啟動碼已經發送完畢，請靜待好心人士貢獻剩餘的啟動碼】";
			
			}elseif($check_mail_ver_result[0]['mail_check'] == 1){
								
				$warrning = "你的mail信箱很快就會收到一封啟動碼通知信。";						
				$code = $available_code_list[0]['code'];	
				
				// Get the player a code
				$update_data = array(					
					'email' => $email_address,
					'check' => '1',
					'time' => $time					
					);		
				$this->db->where('code', $code);
				$this->db->update('activation_code', $update_data);	
				
				// Update the player info
				$ip_data = array(
					'ip_address' => $ip_address ,
					'time' => $time
					);
				$this->db->where('email', $email_address);
				$this->db->update('ipcheck', $ip_data); 
				
				// Send the email					
				$message = 	"<p><img src=\"https://lh3.ggpht.com/j8lGWdhEjmw5rVZ6CiJY_k5D0iPqp_jomAUdyS_n8v5SUQVb8Dt-USXUZXmx1QAca8zJ=w128\" alt=\"Google+\" style=\"border:0;width:128px;height:128px;\"/><br><h1>歡迎加入Ingress</h1><br><a href=\"http://ingress.conic.me/code/email/getcode/".$hash."\">請按這觀看你的啟動碼</a><br>------------------------------------</p>".
							"<p><a href=\"https://plus.google.com/u/0/communities/105093873281779892074\" rel=\"publisher\" style=\"text-decoration:none;\"><img src=\"//ssl.gstatic.com/images/icons/gplus-32.png\" alt=\"Google+\" style=\"border:0;width:32px;height:32px;\"/>  請記得要加入 Ingress Taiwan 的 Google plus社群喔</a></p>".
							"<a href=\"https://plus.google.com/u/0/communities/105093873281779892074\" rel=\"publisher\" style=\"text-decoration:none;\">https://plus.google.com/u/0/communities/105093873281779892074</a>";				
				$this->email->from('noreply.ingress@conic.me','Ingress Taiwan'); 
				$this->email->to($email_address);  			
				$this->email->subject('終於，Ingress邀請碼要拿到手了!!');  
				$this->email->message($message);  
				$this->email->send(); 
				
				$provider_query = $this->db->get_where('provider', array('provider_id' => $check_mail_result[0]['provider_id']));
				$provider_result = $provider_query->result_array();
				$email_provider = $provider_result[0]['email_address'];
				
				if ($provider_result[0]['notification'] == 1){
				
					$this->email->clear();
					$message = 	"您的邀請碼 $code 已經送出";				
					$this->email->from('noreply.ingress@conic.me','Ingress Taiwan'); 
					$this->email->to($email_provider);  			
					$this->email->subject('您的邀請碼已經送出');  
					$this->email->message($message);  
					$this->email->send(); 
				}
		
			}elseif($check_mail_ver_result[0]['mail_check'] == 1 || $check_ip_result[0]['ip_address'] == $ip_address){			
				$warrning = "啟動碼有限，請勿重複申請，如有需要請本人自行申請";
				
			}else{			
				$warrning = "你的mail信箱很快就會收到一封email驗證信。";					
				$mailsha1 = sha1($email_address);
				
				// Creat a player info data
				$ip_data = array(
					'ip_address' => $ip_address ,
					'time' => $time ,
					'email' => $email_address,
					'mailsha1' => $mailsha1
				);
				$this->db->insert('ipcheck', $ip_data); 
				
				// Send the email					
				$message = "<p><img src=\"https://lh3.ggpht.com/j8lGWdhEjmw5rVZ6CiJY_k5D0iPqp_jomAUdyS_n8v5SUQVb8Dt-USXUZXmx1QAca8zJ=w128\" alt=\"Google+\" style=\"border:0;width:128px;height:128px;\"/><h1>歡迎加入Ingress (進度50%，還差一點喔)</h1><br><a href=\"http://ingress.conic.me/code/email/verify/".$mailsha1."\">請先按這驗證你的email</a><br>------------------------------------</p>".
						   "<p><a href=\"https://plus.google.com/u/0/communities/105093873281779892074\" rel=\"publisher\" style=\"text-decoration:none;\"><img src=\"//ssl.gstatic.com/images/icons/gplus-32.png\" alt=\"Google+\" style=\"border:0;width:32px;height:32px;\"/>  請記得要加入 Ingress Taiwan 的 Google plus社群喔</a></p>".
						   "<a href=\"https://plus.google.com/u/0/communities/105093873281779892074\" rel=\"publisher\" style=\"text-decoration:none;\">https://plus.google.com/u/0/communities/105093873281779892074</a>";
				$this->email->from('noreply.ingress@conic.me','Ingress Taiwan'); 
				$this->email->to($email_address);  			
				$this->email->subject('你好，請先驗證你的email');  
				$this->email->message($message);  
				$this->email->send();  				
			}
			
		// Creat a page with message
		$data = array( 'warrning' => $warrning);
		$this->load->view('email_send', $data);
				
	}
	public function getcode()
	{	
		$this->load->helper('url');
		
		// Get the hash
		$code_hash = $this->uri->segment(3, 1);	
		$code_hash = $this->security->xss_clean($code_hash);		
		
		// Output the code to player
		$query = $this->db->get_where('activation_code', array('codesha1' => $code_hash));
		$code_text = $query->result_array();
		if (isset($code_text[0])){
			
			// Get the code from MySQL
			$data = array( 'code_text_row' => $code_text[0]);
			$this->load->view('email_getcode', $data);
		}else{
			
			// Stop for entering the wrong hash
			echo "ERROR";
		}
		
	}
	public function  verify()
	{	
		/*  
			mail_check
				1 => pass
				0 => not pass
				9 => need pass the test
		*/
		$this->load->helper('url');
		
		// Get the hash
		$email_verification = $this->uri->segment(3, 1);	
		$email_verification = $this->security->xss_clean($email_verification);		
		
		// Check if the hash is correct
		$get_mail_query = $this->db->get_where('ipcheck', array('mailsha1' => $email_verification));
		$get_mail_result = $get_mail_query->result_array();			
		$email = $get_mail_result[0]['email'];
		
		if ($email_verification == $get_mail_result[0]['mailsha1']){
			
			// If it's correct, change the status of the email address
			$update_data = array(				
				'mail_check' => '9'			   
				);
			$this->db->where('email', $get_mail_result[0]['email']);
			$this->db->update('ipcheck', $update_data);
			
			// Go to next page to get the mail of the code
			$home_url = base_url();
			header("Location: $home_url"."test/go/$email_verification");
		}else{
			
			// Tell the player for entering the wrong hash
			$warrning = "請輸入正確的驗證碼。";
			$data = array( 'warrning' => $warrning);
			$this->load->view('email_send', $data);
		}		
	}
	public function already()
	{		
		$this->load->helper('date');
		$this->load->library('table');
		$now = now();					
		$time_range = $now - 86400;						
		$query = $this->db->order_by("time", "desc")->select('code, time')->get_where('activation_code', array('check' => '1','time <' => $time_range));
		$send_code_list = $query->result_array();		
		
		$data = array( 'send_code_list' => $send_code_list, 'now' => $now);
		$this->load->view('email_already', $data);
		$this->output->cache(480);
	}
}

/* End of file email.php */
/* Location: ./application/controllers/email_submit.php */