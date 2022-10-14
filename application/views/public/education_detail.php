<?php
defined('BASEPATH') or exit('No direct script access allowed');
$title = null;
$date = null;
$thumbnail = null;
$content = null;
if (isset($education_detail)) {
	$title = isset($education_detail->title) ? $education_detail->title : '(Tidak ada Judul)';
	$date = isset($education_detail->date_created) ? $education_detail->date_created : null;
	$thumbnail = isset($education_detail->thumbnail) ? $education_detail->thumbnail : null;
	$content = isset($education_detail->content) ? $education_detail->content : null;
}
?>
<?php $this->load->view('public/component/head', array('title' => $title)); ?>
<body id="page_education">
<?php $this->load->view('public/component/preloader'); ?>
<?php $this->load->view('public/component/header'); ?>
<section id="detail-education-page" class="detailed-page">
	<div class="container">
		<?php $this->load->view('public/component/breadcrumb'); ?>
		<div class="content-wrapper">
			<div>
				<h4>
					<?= $title ?>
				</h4>
				<div class="info">
					<div class="description">
						<div>
							<img src="<?= base_url() ?>assets/image/icon/date.svg" alt="Icon"/>
							<small>
								<?= date("l, d F Y", strtotime($date)); ?>
							</small>
						</div>
					</div>
					<img src="<?= base_url() ?>assets/image/icon/dummy-share.jpg" alt="Icon"/>
				</div>
			</div>
		</div>
		<div class="content-wrapper">
			<div class="content">
				<div class="thumbnail">
					<img src="<?= base_url() . 'image/' . $thumbnail . '?copyright=1' ?>" alt="Thumbnail"/>
				</div>
				<?= $content ?>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
