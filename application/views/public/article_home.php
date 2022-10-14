<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php $this->load->view('public/component/head',array('title' => 'Artikel')); ?>
<body id="article_page">
<?php $this->load->view('public/component/preloader'); ?>
<?php $this->load->view('public/component/header'); ?>
<div class="container">
	<?php $this->load->view('public/component/breadcrumb'); ?>
	<?php $this->load->view('public/component/article_component', array('data' => array(
			'data_list' => $article_list
	))); ?>
</div>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
