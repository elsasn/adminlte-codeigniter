<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		
		$this->load->view('dashboard');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */