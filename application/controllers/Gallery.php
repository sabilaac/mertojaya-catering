<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
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
		$id = $this->input->get('id');
		$page = $this->input->get('page');
		$order = $this->input->get('order');
		$city = $this->input->get('city');

		if (!empty($id)) {
			$gallery_detail = $this->gallery_models->get(array('id' => $id, 'status' => 1));
			if(sizeof($gallery_detail) > 0) {
				$this->data['gallery_detail'] = $gallery_detail[0];
				$this->data['id'] = $id;
				$this->load->view('public/gallery_detail', $this->data);
			}
			else {
				$this->load->view('public/error', $this->data);
			}

		} else {
			$filter = array(
				'city' => $city,
				'status' => 1
			);
//			$this->data['gallery_list'] = $this->gallery_models->get($filter, $page, 24, array('date_created', $order));
			$this->data['gallery_list'] = $this->gallery_models->get($filter, null, null, array('date_created', $order));
			$this->load->view('public/gallery_home', $this->data);
		}
	}
}
