<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_control extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('session');
	}

	public function index()
	{		
		$this->load->view('welcome_message');
	}

	public function register()
	{
		//echo 'kk';

		// $this->name = $this->input->post('name');
		// $this->password = $this->input->post('psw');
		// $this->emailid = $this->input->post('email');
		$this->user_model->insert_user();

		return 1;
	}

	public function getStates()
	{
		$countryid = $this->input->get('countryid');
		$url = 'https://geodata.solutions/api/api.php?type=getStates&countryId='.$countryid;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl_response = curl_exec($curl);
        // Check for errors and display the error message
		if($errno = curl_errno($curl)) {
		    $error_message = curl_strerror($errno);
		    echo "cURL error ({$errno}):\n {$error_message}";
		}
        $curl_response = curl_exec($curl);
        curl_close($curl);
        echo $curl_response;
	}

	public function getCities()
	{
		$countryid = $this->input->get('countryid');
		$stateid = $this->input->get('stateid');
		$url = 'https://geodata.solutions/api/api.php?type=getCities&countryId='.$countryid.'&stateId='.$stateid;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl_response = curl_exec($curl);
        // Check for errors and display the error message
		if($errno = curl_errno($curl)) {
		    $error_message = curl_strerror($errno);
		    echo "cURL error ({$errno}):\n {$error_message}";
		}
        $curl_response = curl_exec($curl);
        curl_close($curl);
        echo $curl_response;
	}

	public function login()
	{
		$return_data = $this->user_model->get_user();
		//return json_encode($return_data);
		$return_msg = 0;
		if(count($return_data)>0){//$return_data->id!=''){//
			
			$newdata = array(
		        'userid'  => $return_data->id,
		        'username'  => $return_data->first_name.' '.$return_data->last_name,
		        'email'     => $return_data->emailid,
		        'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			$return_msg = 1;
		}
		echo $return_msg; exit;
	}
}
?>
