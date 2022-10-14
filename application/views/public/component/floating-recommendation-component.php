<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data_list = null;
if (isset($data)) {
	$data_list = isset($data['data_list']) ? $data['data_list'] : null;
}
?>
<div class="alert" style="display: none">
	<div class="container">
		<div class="frame">
			<div class="close" onclick="onCloseAlert();">
				<img loading="lazy" src="<?= base_url() ?>assets/image/icon/close.svg" alt="Close">
			</div>
			<video loop muted id="promoted_video">
				<source>
			</video>
			<button>
				<b>
					Hubungi Kami
				</b>
			</button>
		</div>
	</div>
</div>
<?php if (isset($data_list) && sizeof($data_list) > 0) : ?>
	<div class="floating-recommendation opened">
		<div>
			<div class="frame">
				<div class="floating-recommendation-header" onclick="toggleRecommendation();">
                <span>
                    Rekomendasi Paket
                </span>
					<img loading="lazy" src="<?= base_url() ?>assets/image/icon/expand-less-dark.svg" alt="Icon"/>
				</div>
				<div class="area">
					<div class="separator" style="margin-top: 0; margin-bottom: 0"></div>
					<div class="floating-recommendation-list">
						<?php foreach ($data_list as $i => $item) : ?>
							<div class="floating-recommendation-list-item"
								 onclick="onShowAlert('<?= $item->promoted_video_url ? base_url() . 'cdn/' . $item->promoted_video_url : null ?>')">
								<div class="thumbnail">
									<?php if ($item->photo_1) : ?>
										<img loading="lazy"
											 src="<?= base_url() . 'image/' . $item->photo_1 . '?scale=20&copyright=1' ?>"
											 alt="Thumbnail"/>
									<?php elseif ($item->photo_2) : ?>
										<img loading="lazy"
											 src="<?= base_url() . 'image/' . $item->photo_2 . '?scale=20&copyright=1' ?>"
											 alt="Thumbnail"/>
									<?php elseif ($item->photo_3) : ?>
										<img loading="lazy"
											 src="<?= base_url() . 'image/' . $item->photo_3 . '?scale=20&copyright=1' ?>"
											 alt="Thumbnail"/>
									<?php elseif ($item->photo_4) : ?>
										<img loading="lazy"
											 src="<?= base_url() . 'image/' . $item->photo_4 . '?scale=20&copyright=1' ?>"
											 alt="Thumbnail"/>
									<?php endif; ?>
								</div>
								<div class="side">
									<div>
										<div class="title ellipsis">
											<?= $item->title ?>
										</div>
										<div class="min ellipsis">
											<?= $item->count ?> porsi
										</div>
									</div>
									<span class="price">
                           					 Rp. <?= number_format($item->price, 0, ",", ".") ?>,-
                        				</span>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
					<button onclick="location.href = '<?= base_url() ?>package'">
						Lihat semua paket
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
