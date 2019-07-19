<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_control extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->helper('url');
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
		$this->user_model->insert_user();

		return 1;
	}

	public function getStates()
	{
		$countryid = $this->input->get('countryid');
		$url = 'https://geodata.solutions/api/api.php?type=getStates&countryId=IN';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        echo $curl_response;
	}

}
?>
