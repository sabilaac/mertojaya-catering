<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{

	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("package_models");
		$this->load->model("feedback_models");
		$this->load->model("category_models");
		$this->load->model("config_models");
		$this->data = $this->config_models->autoload_config_public();
	}

	public function index()
	{
		$page = $this->input->get('page');
		$order = $this->input->get('order');
		$url = $this->input->get('url');
		$category = $this->input->get('category');

		if (isset($url)) {
			$package_detail = $this->package_models->get(array('url' => $url, 'status' => 1));
			if(sizeof($package_detail) > 0) {
				$this->data['package_detail'] = $package_detail[0];
				$this->load->view('public/package_detail', $this->data);
			}
			else {
				$this->load->view('public/error', $this->data);
			}
		} else {
			$filter = array(
				'category' => $category,
				'status' => 1
			);
//			$this->data['package_list'] = $this->package_models->get($filter, $page, 24, array('date_created', $order));
			$this->data['package_list'] = $this->package_models->get($filter, null, null, array('date_created', $order));
			$this->load->view('public/package_home', $this->data);
		}

	}
}
