<?php

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('employees_model');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function view($page = 'dynamic_query')
	{
		if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
		{
			echo APPPATH.'views/'.$page.'.php';
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['employees'] = array('basic_info'=>array(), 'sql'=>'');
		if ($this->input->post('submit_query')) 
		{
			$data['employees'] = $this->employees_model->get_employees($this->input->post());
		}

		$data['departments'] = $this->employees_model->get_departments();

		$this->load->view('templates/header', $data);
		$this->load->view('search_criteria', $data);
		$this->load->view('employee_search', $data);
		$this->load->view($page, $data);
		$this->load->view('templates/footer', $data);
	}

}

