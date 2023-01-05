<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Image extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data = $this->config_models->autoload_config_public();
	}

	public function resize($name)
	{
		$height = $this->input->get('height');
		$width = $this->input->get('width');
		$scale = $this->input->get('scale');
		$quality = $this->input->get('quality');
		$save = $this->input->get('save');
		$source = null;

		$res_storage = $this->storage_models->get(array('uuid' => $name));


		if (!file_exists('cdn/' . $name . '.jpg')) {
			list($w, $h) = getimagesize('assets/image/placeholder.jpg');
			$source = imagecreatefromjpeg('assets/image/placeholder.jpg');
		} else {
			list($w, $h) = getimagesize('cdn/' . $name . '.jpg');
			$source = imagecreatefromjpeg('cdn/' . $name . '.jpg');
			if ($res_storage[0]->copyright) {
				$stamp = imagecreatefrompng('assets/image/logo/watermark.png');
				$sx = imagesx($stamp);
				$sy = imagesy($stamp);
				imagecopy($source, $stamp, imagesx($source) / 2 - $sx / 2, imagesy($source) / 2 - $sy / 2, 0, 0, imagesx($stamp), imagesy($stamp));
			}
		}

		if (!$height && !$width) {
			$width = $w;
			$height = $h;
		}
		if ($scale && $scale > 0 && $scale <= 100) {
			$width = $width * $scale / 100;
			$height = $height * $scale / 100;
		}

		$im = imagecreatetruecolor($width, $height);
		imagecopyresized($im, $source, 0, 0, 0, 0, $width, $height, $w, $h);

		if ($save) {
			$filename = 'temp/' . $name . '.jpg'; // of course find the exact filename....
			imagejpeg($im, $filename, 100);
			imagedestroy($im);

			header('Pragma: public');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Cache-Control: private', false); // required for certain browsers
			header("Content-type: image/jpeg");

			header('Content-Disposition: attachment; filename="' . basename($filename) . '";');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($filename));

			readfile($filename);
			exit;
		} else {
			header("Content-type: image/jpeg");
			imagejpeg($im, null, $quality ? $quality : 20);
			imagedestroy($im);
		}
	}
}

?>
