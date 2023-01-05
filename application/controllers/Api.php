<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->data = $this->config_models->autoload_navigation_admin();
	}

	public function generate_url($target = null)
	{
		$url = $this->input->get('url');

		if ($target) {
			$found = false;
			$index = 0;
			$data = array();

			while (!$found) {
				$url = $url . ($index > 0 ? '-' . $index : '');
				if ($target === 'article') {
					$data = $this->article_models->get(array('url' => $url));
				} else if ($target === 'package') {
					$data = $this->package_models->get(array('url' => $url));
				}

				if (sizeof($data) === 0) {
					$found = true;
				} else {
					$index++;
				}
			}

			echo json_encode(array(
				'success' => true,
				'message' => 'OK!',
				'data' => $url,
			));
		}
	}

	public function article($route = null)
	{
		$url = $this->input->get('url');

		if ($route) {
			if ($route === 'unique_url') {
				$found = false;
				$index = 0;
				while (!$found) {
					$url = $url . ($index > 0 ? '-' . $index : '');
					$res_package = $this->article_models->get(array('url' => $url));

					if (sizeof($res_package) === 0) {
						$found = true;
						echo json_encode(array(
							'success' => true,
							'message' => 'OK!',
							'data' => $url,
						));
					} else {
						$index++;
					}
				}
			}
		}
	}

	public function promoted($route = null)
	{
		$res = null;

		$package_id = $this->input->post('package_id');
		$video_url = $this->input->post('video_url');

		if ($route) {
			if ($route === 'add') {
				if ($package_id && $video_url) {
					$data_promoted = array(
						'location' => 'home',
						'campaign_id' => null,
						'package_id' => $package_id,
						'video_url' => $video_url,
					);
					$res_promoted = $this->promoted_models->insert($data_promoted);
					if ($res_promoted) {
						$res = array(
							'success' => true,
							'message' => 'Berhasil menambahkan ke rekomendasi',
							'data' => array(),
						);
					} else {
						$res = array(
							'success' => false,
							'message' => 'Gagal menambahkan ke rekomendasi',
							'data' => array(),
						);
					}
				} else {
					$res = array(
						'success' => false,
						'message' => 'Mohon lengkapi data',
						'data' => array(),
					);
				}
			}
		}

		echo json_encode($res);
	}
}
