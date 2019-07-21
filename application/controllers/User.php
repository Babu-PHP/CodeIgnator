<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}
	public function index()
	{
		$this->load->helper('url');
		//$this->load->view('home');
		if ($this->session->userdata('logged_in')) {
	        $this->load->view('dashboard');

	    } else {
	    	redirect('user/login');
	    }
	}
	public function dashboard()
	{
		$this->load->helper('url');
		if ($this->session->userdata('logged_in')) {
	        $this->load->view('dashboard');

	    } else {
	    	redirect('user/login');
	    }
	}
	public function register()
	{
		$this->load->helper(array('form', 'url'));	

		if ($this->session->userdata('logged_in')) {
	        //$this->load->view('dashboard');
	        redirect('user/dashboard');

	    } else {
	        $this->load->library('form_validation');

	        $this->form_validation->set_rules('first_name', 'first_name', 'required');
	        $this->form_validation->set_rules(
			        'mobileno', 'mobileno',
			        'required|min_length[10]|max_length[12]|is_unique[tb_users.mobileno]',
			        array(
			                'required'      => 'mobileno is required and it should be like 919xxxxxxxxxx.',
			                'is_unique'     => 'This mobileno already exists.'
			        )
			);
			$this->form_validation->set_rules('psw', 'Password', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_users.emailid]',
			        array(
			                'valid_email'      => 'You have not provided like sample@sample.com',
			                'is_unique'     => 'This email already exists.'
			        )
			);
	        $this->form_validation->set_rules('country', 'country', 'required');

	        if ($this->form_validation->run() == FALSE)
	        {
	                $data['countries'] = $this->user_model->getCountries();
					$this->load->view('signup', $data);
	        }
	        else
	        {
	    		$this->user_model->insert_user();
	    		$this->session->set_flashdata('success', 'Registered Successfully!!');
	            $this->load->view('login');
	        }
	    }

        
        
	}

	public function login()
	{

		$this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('psw', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email',
		        array(
		            'valid_email'      => 'You have not provided like sample@sample.com'
		        )
		);

        if ($this->form_validation->run() == FALSE)
        {
			$this->load->view('login');
        }
        else
        {
    		$return_data = $this->user_model->get_user();
			//return json_encode($return_data);
			$return_msg = 0;
			if(count($return_data)>0){
				
				$newdata = array(
			        'userid'  => $return_data->id,
			        'username'  => $return_data->first_name.' '.$return_data->last_name,
			        'email'     => $return_data->emailid,
			        'logged_in' => TRUE
				);
				$this->session->set_userdata($newdata);
				$return_msg = 1;
			}
			if($return_msg ==0){
    			$this->session->set_flashdata('error', 'Your login details are wrong and tray again!!');
            	$this->load->view('login');
			} else {
	    		$this->session->set_flashdata('success', 'You are logged Successfully!!');
	            $this->load->view('dashboard');
			}
        }
        
	}

	function logout()
	{
	    $user_data = $this->session->all_userdata();
	        foreach ($user_data as $key => $value) {
	            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
	                $this->session->unset_userdata($key);
	            }
	        }
	    $this->session->sess_destroy();
	    redirect('user/login');
	}
}
?>
