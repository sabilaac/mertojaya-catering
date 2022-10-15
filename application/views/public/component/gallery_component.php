<?php
$title = null;
$description = null;
$pagination = null;
$data_list = null;
if (isset($data)) {
	$title = isset($data['title']) ? $data['title'] : null;
	$description = isset($data['description']) ? $data['description'] : null;
	$pagination = isset($data['pagination']) ? $data['pagination'] : false;
	$data_list = isset($data['data_list']) ? $data['data_list'] : null;
}
?>
<div class="gallery-component">
	<?php if ($title && $description) : ?>
		<div class="gallery-header">
			<h3>
				<?= $title ?>
			</h3>
			<h5>
				<?= $description ?>
			</h5>
		</div>
	<?php endif; ?>
	<div class="gallery-list <?= $pagination ? 'pagination' : '' ?>">
		<?php if ($data_list && sizeof($data_list) > 0) : ?>
			<?php foreach ($data_list as $i => $item) : ?>
				<div class="gallery-item">
					<a href="<?= base_url() . 'gallery?id=' . $item->id ?>">
						<img src="<?= base_url() . 'image/' . $item->photo . '?scale=50&quality=35&copyright=1' ?>" alt="Photo"/>
						<div class="gallery-item-detail">
							<div>
								<span class="ellipsis">
									<?= $item->title ?>
								</span>
								<small class="ellipsis">
									<?= $item->description ?>
								</small>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<?php if ($pagination) : ?>
		<div class="gallery-nav">

		</div>
	<?php else : ?>
		<div class="gallery-more">
			<button onclick="location.href = '<?= base_url() ?>gallery'">
				<img src="<?= base_url() ?>assets/image/icon/photo_more.svg" alt="Icon"/>
				Lihat lainnya
			</button>
		</div>
	<?php endif; ?>
</div>

<script></script>
