<?php
defined('BASEPATH') or exit('No direct script access allowed');
$title = null;
$full_name = null;
$date = null;
$photo = null;
$city = null;
$description = null;
if (isset($gallery_detail)) {
	$title = isset($gallery_detail->title) ? $gallery_detail->title : '(Tidak ada Judul)';
	$full_name = isset($gallery_detail->full_name) ? $gallery_detail->full_name : '(Tidak ada Nama)';
	$date = isset($gallery_detail->date_created) ? $gallery_detail->date_created : null;
	$photo = isset($gallery_detail->photo) ? $gallery_detail->photo : null;
	$city = isset($gallery_detail->city) ? $gallery_detail->city : null;
	$description = isset($gallery_detail->description) ? $gallery_detail->description : null;
}
?>
<?php $this->load->view('public/component/head', array('title' => $title)); ?>
<body id="page_gallery">
<?php $this->load->view('public/component/preloader'); ?>
<?php $this->load->view('public/component/header'); ?>
<section id="home-gallery-page" class="detailed-page">
	<div class="container">
		<?php $this->load->view('public/component/breadcrumb'); ?>
		<div class="thumbnail-slider">
			<div class="thumbnail">
				<a href="<?= base_url() . 'cdn/' . $photo ?>" target="_blank">
					<img src="<?= base_url() . 'cdn/' . $photo ?>" alt="Thumbnail"/>
				</a>
				<div class="arrow-wrapper">
					<a href="<?= base_url() . 'gallery?id=' . ($id - 1) ?>">
						<div class="arrow prev">
							<img src="<?= base_url() ?>assets/image/icon/arrow.svg" alt="Arrow"/>
						</div>
					</a>
					<a href="<?= base_url() . 'gallery?id=' . ($id + 1) ?>">
						<div class="arrow next">
							<img src="<?= base_url() ?>assets/image/icon/arrow.svg" alt="Arrow"/>
						</div>
					</a>
				</div>
			</div>
			<!--			<div class="small-thumbnail-list">-->
			<!--				--><?php //foreach (array_fill(0, 8, '') as $i => $item) : ?>
			<!--					<div class="small-thumbnail-list-item">-->
			<!--						<img src="-->
			<? //= base_url() ?><!--assets/image/thumbnail/article-1.jpg" alt="Thumbnail"/>-->
			<!--					</div>-->
			<!--				--><?php //endforeach; ?>
			<!--			</div>-->
		</div>
		<div class="content-wrapper">
			<div>
				<h4>
					<?= $title ?>
				</h4>
				<div class="info">
					<div class="description">
						<div>
							<img src="<?= base_url() ?>assets/image/icon/user.svg" alt="Icon"/>
							<small>
								<?= $full_name ?>
							</small>
						</div>
						<div>
							<img src="<?= base_url() ?>assets/image/icon/date.svg" alt="Icon"/>
							<small>
								<?= date("l, d F Y", strtotime($date)); ?>
							</small>
						</div>
						<div>
							<img src="<?= base_url() ?>assets/image/icon/maps-black.svg" alt="Icon"/>
							<a href="<?= base_url() . 'gallery?city=' . $city ?>">
								<small>
									<?= $city ?>
								</small>
							</a>
						</div>
					</div>
					<img src="<?= base_url() ?>assets/image/icon/dummy-share.jpg" alt="Icon"/>
				</div>
			</div>
			<div class="content">
				<p>
					<?= $description ?>
				</p>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
