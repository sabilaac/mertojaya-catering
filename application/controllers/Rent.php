<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rent extends CI_Controller {
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("config_models");
		$this->load->model("gallery_models");
		$this->data = $this->config_models->autoload_config_public();
	}

	public function index()
	{
		$this->load->view('public/rent_home', $this->data);
	}
}
