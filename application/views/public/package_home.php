<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php $this->load->view('public/component/head', array('title' => 'Paket Katering')); ?>
<body id="page_package">
<?php $this->load->view('public/component/preloader'); ?>
<?php $this->load->view('public/component/header'); ?>
<div class="container">
	<?php $this->load->view('public/component/breadcrumb'); ?>
	<h3>
		Paket Katering
	</h3>
	<h5>
		Mertojaya Catering
	</h5>
	<?php $this->load->view('public/component/package_component', array('data' => array(
		'data_list' => $package_list
	))); ?>
</div>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
