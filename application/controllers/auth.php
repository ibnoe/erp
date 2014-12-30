<?php
class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// if logged in redirect to dashboard/home

		if ($this->authex->logged_in())
		{
			redirect("home");
		}
	}

	function index()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->form_validation->set_rules('user_id', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('user_pass', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('auth/view_login');
		}
		else
		{
			$email 		= trim($this->input->post('user_id'));
			$password 	= trim($this->input->post('user_pass'));
			if ($this->authex->login($email, $password))
			{
				redirect("");				
			}
			else
			{
				$this->session->set_flashdata('msg', 'Wrong Login Information');
				redirect("auth");	
			}
		}
	}
}