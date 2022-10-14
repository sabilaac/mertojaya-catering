<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Career extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("config_models");
		$this->data = $this->config_models->autoload_config_public();
	}

	public function index() {
		$this->load->view('public/career', $this->data);
	}
}
