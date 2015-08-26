<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
// https://github.com/Cnordbo/RECaptcha-for-Codeigniter
class code extends CI_Controller {
	
	public function index()
	{	
				
		$this->load->library('recaptcha');
		
		//Store the captcha HTML for correct MVC pattern use.
        $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();       
        $this->load->view('code_submit',$data);
	}
	public function submit()
	{					
		// Load REcaptcha again.
        $this->load->library('recaptcha');		
		$ip_address = $this->input->ip_address();
		
		// Close the warrning, for the annoying message
		error_reporting(0);		
		
		//Call to recaptcha to get the data validation set within the class. 
        $this->recaptcha->recaptcha_check_answer($_SERVER['REMOTE_ADDR'],$this->input->post('recaptcha_challenge_field'),$this->input->post('recaptcha_response_field'));
		$code = $this->input->post('code_input');
		$email = $this->input->post('email_input');
		
		if ($this->recaptcha->is_valid){		
		
			$check_code_query = $this->db->get_where('activation_code', array('code' => $code));
			$check_code_result = $check_code_query->result_array();	
			$code_check = $check_code_result[0]['code'];
			
			if($code_check == $code){
				$error_msg = "此啟動碼已經輸入，請重新輸入有效啟動碼";
				
				}elseif((ctype_alnum($code) and strlen($code) == 8)){
					
					$check_exit_query = $this->db->get_where('provider', array('email_address' => $email));
					$check_exit_result = $check_exit_query->result_array();
					
					if ($check_exit_result[0]['email_address'] == $email){
						$provider = $check_exit_result[0]['provider_id'];					
						
						}else{					
							$data = array(
								'email_address' => $email ,						
								'ip_address' => $ip_address ,
								'notification' => 1
							);		
							$this->db->insert('provider', $data); 
					
							$getid_query = $this->db->get_where('provider', array('email_address' => $email));
							$getide_result = $getid_query->result_array();
							$provider = $getide_result[0]['provider_id'];
						}					
					$codesha1 = sha1($code);
					$data = array(
						'code' => $code ,						
						'codesha1' => $codesha1 ,
						'provider_id' => $provider,
						'check' => 9
					);		
					$this->db->insert('activation_code', $data); 					
					$error_msg = "資料建檔完成，感謝您提供啟動碼<br>如果有人索取成功將會發送通知信";
					
				}else{
					$error_msg = "Oops 出錯了喔: 錯誤，檢查是否複製錯誤";
				}
		}else{
			$error_msg = "Oops 出錯了喔: reCAPTCHA 驗證碼輸入錯誤";
			}
		$data['error_msg'] = $error_msg;
		$this->load->view('code_get',$data);
	}	
	public function admin()
	{
		$this->load->helper('url');				
		$this->load->library('session');
		$adminpw = "ingress";
		$password = $array = $this->uri->segment(3);
		$password = $this->security->xss_clean($password);
		
		// Login proccessing
		if ($password == $adminpw){
			$this->session->set_flashdata('login', 'yes');			
			$home_url = base_url()."code/admin";
			header("Location: $home_url");
		}	
		//	Check if login
		if ($this->session->flashdata('login') == "yes"){
			$this->session->keep_flashdata('login');
			$this->load->helper('form');			
						
			if ($this->input->post('action') == "delete"){
				$code_id = $this->input->post('code_id');
				$this->db->delete('activation_code', array('code_id' => $code_id)); 
			}else if($this->input->post('action') == "confirm"){
				$code_id = $this->input->post('code_id');		
				$data = array('check' => 0);
				$this->db->update('activation_code', $data, array('code_id' => $code_id));				
			}			
			
			$query = $this->db->get_where('activation_code', array('check' => '9'));
			$pending_code_list = $query->result_array();
			//$amount = count($pending_code_list);	
			
			$code_list = array( 'pending_code_list' => $pending_code_list);
			$this->load->view('code_admin', $code_list);
		}				
	}
}
/* End of file email.php */
/* Location: ./application/controllers/email_submit.php */