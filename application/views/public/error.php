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
		<lottie-player src="https://assets1.lottiefiles.com/packages/lf20_wwTPJf.json"
					   background="transparent" style="width: 300px; height: 300px;" loop
					   autoplay></lottie-player>
		<h4>
			Halaman tidak ditemukan
		</h4>
		<small>
			Periksa kembali alamat <span><?= $link ?></span> ya
		</small>
		<button onclick="location.href = '<?= base_url() ?>'">
			<img src="<?= base_url()?>assets/image/icon/home.svg" alt="Icon" />
			Beranda
		</button>
	</div>
</section>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
