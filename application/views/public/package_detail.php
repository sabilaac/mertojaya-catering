<?php
defined('BASEPATH') or exit('No direct script access allowed');
$photo = array();
$title = null;
$price = null;
$content = null;
$url = null;
if (isset($package_detail)) {
	if ($package_detail->photo_1) {
		array_push($photo, $package_detail->photo_1_uuid);
	}
	if ($package_detail->photo_2) {
		array_push($photo, $package_detail->photo_2_uuid);
	}
	if ($package_detail->photo_3) {
		array_push($photo, $package_detail->photo_3uuid);
	}
	if ($package_detail->photo_4) {
		array_push($photo, $package_detail->photo_4_uuid);
	}
	$title = $package_detail->title;
	$content = $package_detail->content;
	$price = $package_detail->price;
	$url = $package_detail->url;
}
?>
<?php $this->load->view('public/component/head', array('title' => $title)); ?>
<body id="detail-product-page">
<?php $this->load->view('public/component/preloader'); ?>
<div class="thumbnail">
	<div class="owl-carousel thumbnail-list">
		<?php foreach ($photo as $i => $item) : ?>
			<img src="<?= base_url() . 'image/' . $item . '?quality=100'?>" alt="Showcase"/>
		<?php endforeach; ?>
	</div>
</div>
<div class="content">
	<div class="detail-header">
		<div class="back" id="back">
			<img src="<?= base_url() ?>assets/image/icon/back.svg" alt="Back"/>
		</div>
		<h3>
			<?= $title ?>
		</h3>
		<h4 class="price">
			Rp. <?= number_format($price, 0, ",", ".") ?>,-
		</h4>
	</div>
	<div class="description">
		<?= $content ?>
	</div>
	<div class="detail-footer">
		<div class="separator" style="margin: 0"></div>
		<div class="common">
			<button class="icon" id="detail-share">
				<img src="<?= base_url() ?>assets/image/icon/share.svg" alt="Bagikan"/>
			</button>
			<button onclick="location.href = 'https://wa.me/<?= $cs_wa . '?text=' . urlencode('Saya ingin memesan  ' . $title . '! Alamat paket (' . base_url() . 'package?url=' . $url .  ')')?>'" >
				<b>
					Pesan Sekarang
				</b>
			</button>
			<button class="accent"
					onclick="location.href = 'https://wa.me/<?= $cs_wa . '?text=' . urlencode('Apakah ' . $title . ' ini tersedia? Alamat paket (' . base_url() . 'package?url=' . $url . ')') ?>'">
				<b>
					Tanya
				</b>
			</button>
		</div>
	</div>
</div>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/foot'); ?>
