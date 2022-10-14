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
			fulltime
		</div>
		<div id="parttime">
			parttime
		</div>
		<div id="freelance">
			freelance
		</div>
		<div id="intern">
			intern
		</div>
	</div>
</div>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
