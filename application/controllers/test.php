<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test extends CI_Controller {
	
	public function index()
	{	
		$this->load->helper('url');				
		$this->load->library('session');	
		
		$user = $this->input->post('user_input');
		$pw = $this->input->post('pw_input');		
		
		if ($this->session->flashdata('test_login') == "yes"){
				$this->session->keep_flashdata('test_login');
				$this->session->keep_flashdata('test_user');
				
				$home_url = base_url()."test/admin";
				header("Location: $home_url");
			}
		
		if (!empty($user)){	
		
			function logincheck($u, $p){
				$users_array = array (
						"admin" => 'gotoingressforthewin',
						"manger" => 'forabetterworld'
					);				
				if (array_key_exists($u, $users_array)){
					if($p == $users_array[$u]){
						$msg = "Pass";															
					}else{
						$msg = "Wrong password";
					}
				}else{
					$msg = "Wrong username";
				}
				RETURN $msg;
			}
			$err_msg =  "ERROR Message: ".logincheck($user, $pw);
			if (logincheck($user, $pw) == "Pass"){
				$this->session->set_flashdata('test_login', 'yes');
				$this->session->set_flashdata('test_user', $user);
				$home_url = base_url()."test/admin";
				header("Location: $home_url");
			}
		}else{
			$err_msg = "";
		}
		$data = array( 'err_msg' => $err_msg);
		$this->load->view('test_page',$data);	
	}	
	public function go()
	{
		$this->load->helper('url');
		
		// Get the hash
		$email_hash = $this->uri->segment(3, 0);	
		$email_hash = $this->security->xss_clean($email_hash);	
		
		$check_query = $this->db->get_where('ipcheck', array('mailsha1' => $email_hash));
		$check_result = $check_query->result_array();
		
		if ($check_result[0]['mail_check'] == 9){		
			$url = $check_result[0]['email'];
			header("Location: https://docs.google.com/forms/d/1v27fG07JlFJ0rJDMLSeSWIhGfWqncV5vDP64zIpFLx8/viewform?entry_1833475395=$url");
		
		}else{
			$home_url = base_url();
			header("Location: $home_url");			
		}		
	}
	public function admin()
	{	
		$this->load->library('session');
		$this->load->helper('url');	
		
		if ($this->session->flashdata('test_login') == "yes"){
								
				$this->session->keep_flashdata('test_login');
				$this->session->keep_flashdata('test_user');
				
				if ($this->input->get_post('action') == "delete"){
						$email = $this->input->get_post('email');
						
						$message = "抱歉，你沒有通過考試，請提交Email來重新考試<br>有問題可以查詢幫助手冊";
						$this->email->from('noreply.ingress@conic.me','Ingress Taiwan'); 
						$this->email->to($email);  			
						$this->email->subject('差一點就有了，請重新接受測驗');  
						$this->email->message($message);  
						$this->email->send(); 						
						$this->db->delete('ipcheck', array('email' => $email));					
						
					}else if($this->input->get_post('action') == "confirm"){
						$email = $this->input->get_post('email');	
						$message = "您已經通過考試，<a href=\"http://ingress.conic.me/code/email/send?email_input=".$email."\">請按此進行領取作業</a>";
						$this->email->from('noreply.ingress@conic.me','Ingress Taiwan'); 
						$this->email->to($email);  			
						$this->email->subject('測驗通過，可以領取邀請碼了');  
						$this->email->message($message);  
						$this->email->send();
						
						$data = array('mail_check' => 1);
						$this->db->update('ipcheck', $data, array('email' => $email));							
					}						
				$query = $this->db->get_where('ipcheck', array('mail_check' => '9'));
				$pending_users = $query->result_array();
				$data = array( 'pending_users' => $pending_users);
				$this->load->view('test_admin', $data);				
			}else{
				$home_url = base_url()."test/";
				header("Location: $home_url");
		}		
	}
}
/* End of file email.php */
/* Location: ./application/controllers/email_submit.php */