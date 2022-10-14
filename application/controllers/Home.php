<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("auth_models");
		$this->load->model("package_models");
		$this->load->model("feedback_models");
		$this->load->model("article_models");
		$this->load->model("education_models");
		$this->load->model("category_models");
		$this->load->model("gallery_models");
		$this->load->model("campaign_models");
		$this->load->model("config_models");
		$this->data = $this->config_models->autoload_config_public();
	}

	public function index()
	{
		$this->data['feedback'] = $this->feedback_models->get(array('status' => 1));
		$this->data['article_list'] = $this->article_models->get(array('status' => 1), 0, 3);
		$this->data['gallery_list'] = $this->gallery_models->get(array('status' => 1), 0, 9);
		$this->data['package_list'] = $this->package_models->get(array('status' => 1));
		$this->data['education_list'] = $this->education_models->get(array('status' => 1));
		$this->data['category_list'] = $this->category_models->get();
		$this->data['banner_list'] = $this->campaign_models->get(array('status' => 1), null, 9);;
		$this->load->view('public/home', $this->data);
	}
}
