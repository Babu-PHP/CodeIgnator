<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('home');
	}
	public function register()
	{
		$this->load->helper('url');
		$data['countries'] = $this->user_model->getCountries();
		$this->load->view('signup', $data);
	}
	public function login()
	{
		$this->load->helper('url');
		$this->load->view('login');
	}
}
?>
