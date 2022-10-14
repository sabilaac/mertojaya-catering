<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Education extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("education_models");
		$this->load->model("config_models");
		$this->data = $this->config_models->autoload_config_public();
	}

	public function index()
	{
		$url = $this->input->get('url');
		$page = $this->input->get('page');
		$order = $this->input->get('order');

		if (!empty($url)) {
			$education_detail = $this->education_models->get(array('url' => $url, 'status' => 1));
			if(sizeof($education_detail) > 0) {
				$this->data['education_detail'] = $education_detail[0];
				$this->load->view('public/education_detail', $this->data);
			}
			else {
				$this->load->view('public/error', $this->data);
			}
		} else {
			$filter = array(
				'status' => 1
			);
//			$this->data['education_list'] = $this->education_models->get(null, 9, $page, array('date_created', $order));
			$this->data['education_list'] = $this->education_models->get(null, null, null, array('date_created', $order));
			$this->load->view('public/education_home', $this->data);
		}
	}
}
