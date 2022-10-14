<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Image extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("auth_models");
		$this->load->model("package_models");
		$this->load->model("feedback_models");
		$this->load->model("category_models");
		$this->load->model("config_models");
		$this->data = $this->config_models->autoload_config_public();
	}

	public function resize($name)
	{
		$height = $this->input->get('height');
		$width = $this->input->get('width');
		$scale = $this->input->get('scale');
		$copyright = $this->input->get('copyright');
//		$copyright = true;
		$im = null;
		if(!file_exists('cdn/' . $name)) {
			$this->load->view('public/error', $this->data);
		}
		else {
			list($w, $h) = getimagesize('cdn/' . $name);
			if(!$height && !$width) {
				$width = $w;
				$height = $h;
			}
			if($scale && $scale > 0 && $scale <= 100) {
				$width = $width * $scale / 100;
				$height = $height * $scale / 100;
			}
			$source = imagecreatefromjpeg('cdn/' . $name);
			$im = imagecreatetruecolor($width, $height);
//			$metadata = $this->input->get('metadata');
//			if ($metadata) {
//				$data = json_decode($this->auth_models->getMetadata($metadata));
//				$copyright = $data->copyright;
//			}
			if ($copyright) {
				$stamp = imagecreatefrompng('assets/image/logo/watermark.png');
				$sx = imagesx($stamp);
				$sy = imagesy($stamp);
				imagecopy($source, $stamp, imagesx($source) / 2 - $sx / 2, imagesy($source) / 2 - $sy / 2, 0, 0, imagesx($stamp), imagesy($stamp));
			}
			imagecopyresized($im, $source, 0, 0, 0, 0, $width, $height, $w, $h);
			header('Content-type: image/jpeg');
			imagejpeg($im, null, 20);
			imagedestroy($im);
		}
	}
}

?>
