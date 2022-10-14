<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="owl-carousel feedback-list">
	<?php if (isset($feedback)) : ?>
		<?php foreach ($feedback as $i => $item) : ?>
			<div class="feedback-item">
				<span><?= isset($item->review) ? $item->review : '(Ulasan kosong)' ?></span>
				<b>
					<?= isset($item->name) ? $item->name : '(Tidak ada Nama)' ?>
				</b>
				<small>
					<?= isset($item->city) ? $item->city : '(Kota tidak di sebutkan)' ?>
				</small>
			</div>
		<?php endforeach; ?>
	<?php else : ?>
		Tidak ada ulasan
	<?php endif; ?>
</div>
