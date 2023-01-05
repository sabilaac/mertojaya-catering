<?php
defined('BASEPATH') or exit('No direct script access allowed');
$title = null;
$description = null;
$data_list = null;
if (isset($data)) {
	$title = isset($data['title']) ? $data['title'] : '';
	$description = isset($data['description']) ? $data['description'] : '';
	$data_list = isset($data['data_list']) ? $data['data_list'] : null;
}
?>

<div class="article_component">
	<?php if ($title || $description) : ?>
		<div class="article-header">
			<div>
				<h3>
					<?= $title ?>
				</h3>
				<h5>
					<?= $description ?>
				</h5>
			</div>
			<a href="<?= base_url() ?>article">
				Lihat Semua
			</a>
		</div>
	<?php endif; ?>
	<div class="article-list">
		<?php if ($data_list && sizeof($data_list) > 0) : ?>
			<?php foreach ($data_list as $i => $item) : ?>
				<a href="<?= base_url() . 'article?url=' . $item->url ?>">
					<div class="article-item">
						<div class="article-item-header">
							<img src="<?= base_url('image/' . $item->thumbnail_uuid) ?>"
								 alt="Thumbnail"/>
							<div class="date">
								<h3>
									<?= date("d", strtotime($item->date_created)); ?>
								</h3>
								<small>
									<?= date("M Y", strtotime($item->date_created)); ?>
								</small>
							</div>
						</div>
						<div class="article-item-title">
							<span class="ellipsis">
								<?= $item->title ?>
							</span>

						</div>
						<div class="article-item-description">
							<img src="<?= base_url() ?>assets/image/icon/user_circle.svg" alt="Icon"/>
							<small>
								<?= $item->full_name ?>
							</small>
						</div>
						<div class="article-item-content">
							<span class="ellipsis"><?= strip_tags($item->content) ?></span>
						</div>
						<?php if (isset($item->category_tag)) : ?>
							<div class="article-item-tag">
								<?php foreach (json_decode($item->category_tag) as $index => $tag) : ?>
									<small>
										<?= $tag ?>
									</small>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</a>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>


