<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotFound extends CI_Controller {
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("config_models");
		$this->data = $this->config_models->autoload_config_public();
	}

	public function index()
	{
		$this->output->set_status_header('404');
		$this->load->view('public/error', $this->data);
	}
}
