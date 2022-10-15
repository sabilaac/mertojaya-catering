<?php
defined('BASEPATH') or exit('No direct script access allowed');
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
	=== 'on' ? "https" : "http") .
	"://" . $_SERVER['HTTP_HOST'] .
	$_SERVER['REQUEST_URI'];
?>
<?php $this->load->view('public/component/head', array('title' => 'Halaman tidak ditemukan')); ?>
<body id="error_page">
<?php $this->load->view('public/component/header'); ?>
<section id="error">
	<div class="container">
		<?php $this->load->view('public/component/empty_state_component', array('data' => array(
				'title' => 'Halaman tidak ditemukan',
				'thumbnail' => 'https://assets6.lottiefiles.com/packages/lf20_AQcLsD.json',
				'description' => 'Periksa kembali alamat ' . $link . ' ya',
				'action' => 'Beranda',
				'link' => base_url(),
		))) ?>
	</div>
</section>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
