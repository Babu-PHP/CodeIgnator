<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Control extends CI_Controller {

	function __construct(){
		$this->load->helper('url');
		$this->load->model('user_model');
	}
	public function index()
	{		
		$this->load->view('welcome_message');
	}

	public function register()
	{
		echo 'kk';
		// $this->name = $this->input->post('name');
		// $this->password = $this->input->post('psw');
		// $this->emailid = $this->input->post('email');
		// $this->user_model->insert_user($this);

		return 1;
	}
}
?>
