<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data_list = null;
if (isset($data)) {
	$data_list = isset($data['data_list']) ? $data['data_list'] : null;
}
?>
<?php if(isset($data_list) && sizeof($data_list) > 0) : ?>
<div class="carousel">
	<div class="swiper">
		<div class="swiper-wrapper">
			<?php foreach ($data_list as $i => $item) : ?>
			<div class="swiper-slide">
				<img src="<?= base_url() . 'cdn/' . $item->banner ?>" alt="Banner"/>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="arrow-wrapper">
		<div class="arrow prev">
			<img src="<?= base_url() ?>assets/image/icon/arrow.svg" alt="Arrow"/>
		</div>
		<div class="arrow next">
			<img src="<?= base_url() ?>assets/image/icon/arrow.svg" alt="Arrow"/>
		</div>
	</div>
	<div class="swiper-pagination"></div>
</div>
<?php endif; ?>
