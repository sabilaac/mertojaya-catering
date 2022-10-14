<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("article_models");
		$this->load->model("config_models");
		$this->data = $this->config_models->autoload_config_public();
	}

	public function index()
	{
		$url = $this->input->get('url');
		$page = $this->input->get('page');
		$order = $this->input->get('order');

		if (!empty($url)) {
			$article_detail = $this->article_models->get(array('url' => $url, 'status' => 1));
			if(sizeof($article_detail) > 0) {
				$this->data['article_detail'] = $article_detail[0];
				$this->data['article_related'] = $this->article_models->get(null, null, 3, 'random');
				$this->load->view('public/article_detail', $this->data);
			}
			else {
				$this->load->view('public/error', $this->data);
			}
		} else {
			$filter = array(
				'status' => 1
			);
//			$this->data['article_list'] = $this->article_models->get(null, 9, $page, array('date_created', $order));
			$this->data['article_list'] = $this->article_models->get(null, null, null, array('date_created', $order));
			$this->load->view('public/article_home', $this->data);
		}
	}

	public function detail()
	{


	}
}
