<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php $this->load->view('public/component/head',array('title' => 'Portal Karir')); ?>
	<body>
<?php $this->load->view('public/component/preloader'); ?>
<?php $this->load->view('public/component/header'); ?>
<div class="container">
	<?php $this->load->view('public/component/breadcrumb'); ?>
	<h3>
		Portal Karir
	</h3>
	<h5>
		Mertojaya Catering
	</h5>
	<?php $this->load->view('public/component/tab_component', array('data' => array(
		'data_list' => array(
				['icon' => 'full-time.svg', 'title' => 'Full Time', 'target' => '#fulltime'],
				['icon' => 'part-time.svg', 'title' => 'Part Time', 'target' => '#parttime'],
				['icon' => 'freelance.svg', 'title' => 'Freelance', 'target' => '#freelance'],
				['icon' => 'intern.svg', 'title' => 'Intern', 'target' => '#intern'],
		),
		'active' => 0
	))); ?>
	<div class="tab-container">
		<div id="fulltime" class="active">
			<?php $this->load->view('public/component/empty_state_component', array('data' => array(
					'title' => 'Sayang sekali',
					'thumbnail' => 'https://assets4.lottiefiles.com/packages/lf20_xvf1dl3s.json',
					'description' => 'Fulltime job sedang tidak tersedia saat ini, kembali lagi nanti ya!',
			))) ?>
		</div>
		<div id="parttime">
			<?php $this->load->view('public/component/empty_state_component', array('data' => array(
					'title' => 'Sayang sekali',
					'thumbnail' => 'https://assets4.lottiefiles.com/packages/lf20_xvf1dl3s.json',
					'description' => 'Part time job sedang tidak tersedia saat ini, kembali lagi nanti ya!',
			))) ?>
		</div>
		<div id="freelance">
			<?php $this->load->view('public/component/empty_state_component', array('data' => array(
					'title' => 'Sayang sekali',
					'thumbnail' => 'https://assets4.lottiefiles.com/packages/lf20_xvf1dl3s.json',
					'description' => 'Freelance job sedang tidak tersedia saat ini, kembali lagi nanti ya!',
			))) ?>
		</div>
		<div id="intern">
			<?php $this->load->view('public/component/empty_state_component', array('data' => array(
					'title' => 'Sayang sekali',
					'thumbnail' => 'https://assets4.lottiefiles.com/packages/lf20_xvf1dl3s.json',
					'description' => 'Intern job sedang tidak tersedia saat ini, kembali lagi nanti ya!',
			))) ?>
		</div>
	</div>
</div>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
