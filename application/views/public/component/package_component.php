<?php
$pagination = null;
$data_list = null;
if (isset($data)) {
	$pagination = isset($data['pagination']) ? $data['pagination'] : false;
	$data_list = isset($data['data_list']) ? $data['data_list'] : null;
}
?>
<?php if (isset($data_list)) : ?>
	<div class="package-component">
		<div class="package-showcase">
			<?php foreach ($data_list as $i => $item) : ?>
				<a href="<?= base_url() . 'package?url=' . $item->url ?>">
					<div class="package-showcase-item category_<?= $item->category_id ?>">
						<div class="thumbnail">
							<?php if ($item->photo_1) : ?>
								<img src="<?= base_url() . 'image/' . $item->photo_1 . '?scale=50&quality=35&copyright=1' ?>"
									 alt="Thumbnail"/>
							<?php elseif ($item->photo_2) : ?>
								<img src="<?= base_url() . 'image/' . $item->photo_2 . '?scale=50&quality=35&copyright=1' ?>"
									 alt="Thumbnail"/>
							<?php elseif ($item->photo_3) : ?>
								<img src="<?= base_url() . 'image/' . $item->photo_3 . '?scale=50&quality=35&copyright=1' ?>"
									 alt="Thumbnail"/>
							<?php elseif ($item->photo_4) : ?>
								<img src="<?= base_url() . 'image/' . $item->photo_4 . '?scale=50&quality=35&copyright=1' ?>"
									 alt="Thumbnail"/>
							<?php endif; ?>
							<?php if($item->promoted_id) : ?>
							<div class="promoted">
								<img src="<?= base_url() ?>assets/image/icon/star.svg" alt="Icon" />
								<small>
									Recommended
								</small>
							</div>
							<?php endif; ?>
						</div>
						<span class="ellipsis">
							<?= $item->title ?>
						</span>
						<div class="portion">
							<small>
								<?= $item->count ?> porsi
							</small>
						</div>
						<div class="price">
							Rp. <?= number_format($item->price, 0, ",", ".") ?>,-
						</div>

					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

