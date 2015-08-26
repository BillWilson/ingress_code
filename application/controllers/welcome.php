<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{			
		$this->load->library('user_agent');
		//$this->load->library('Csvreader');
		$this->load->view('welcome_message');			
	}
	public function code()
	{
		$this->load->helper('url');				
		$code = $array = $this->uri->segment(4);		
		$pass = $array = $this->uri->segment(3);
		
		$code = $this->security->xss_clean($code);
		$pass = $this->security->xss_clean($pass);
		
		if ($pass == "ingresswheretw"){
			if(ctype_alnum($code) and strlen($code) == 8){
				$codesha1 = sha1($code);
				$data = array(
					'code' => $code ,
					'codesha1' => $codesha1			
				);		
				$this->db->insert('activation_code', $data); 
				echo "Good<br>" .$code. "  has been created.";
			}else{
				echo "錯誤，請長度或是字元檢查是否錯誤。拼字規則A-Z 0-9，長度8";
			}
		}else{
			echo "404 NOT FOUND";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */