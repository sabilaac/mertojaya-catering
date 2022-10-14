<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config_models extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('package_models');
		$this->load->model('category_models');
	}

	public function get($var)
	{
		$res = null;
		if ($var) {
			$this->db->where("var", $var);
		}
		$data = $this->db->get("config")->result();
		if ($var) {
			if (!empty($data)) {
				$res = $data[0]->value;
			}
		} else {
			$res = $data;
		}
		return $res;
	}

	public function autoload_config_public()
	{
		$data['fb_url'] = $this->get('fb_url');
		$data['ig_url'] = $this->get('ig_url');
		$data['tiktok_url'] = $this->get('tiktok_url');
		$data['yt_url'] = $this->get('yt_url');
		$data['cs_phone'] = $this->get('cs_phone');
		$data['cs_wa'] = $this->get('cs_wa');
		$data['cs_email'] = $this->get('cs_email');
		$data['address'] = $this->get('address');
		$data['maps_url'] = $this->get('maps_url');
		$data['maps_longlat'] = $this->get('maps_longlat');
		$data['use_preloader'] = $this->get('use_preloader') ? $this->get('use_preloader') : true;
		$data['random_article_date'] = $this->get('random_article_date');
		$data['package_category'] = $this->category_models->get();
		$data['package_recommendation_list'] = $this->package_models->get(array('status' => 1, 'promoted' => true));

		return $data;
	}

	public function autoload_navigation_admin()
	{
		$data['package_list'] = $this->package_models->get();
		return $data;
	}
}
