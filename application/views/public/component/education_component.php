<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data_list = null;
if (isset($data)) {
	$data_list = isset($data['data_list']) ? $data['data_list'] : null;
}
?>
<div class="education-component">
	<div class="education-list">
		<?php if ($data_list) : ?>
			<?php foreach ($data_list as $i => $item) : ?>

				<a href="<?= base_url() . 'education?url=' . $item->url ?>">
					<div class="education-item">
						<div class="education-item-header">
							<img loading="lazy" src="<?= base_url() . 'image/' . $item->thumbnail_uuid . '?scale=50&quality=30' ?>"
								 alt="Thumbnail"/>
						</div>
						<div class="education-item-title">
							<?= $item->title ?>
						</div>
						<div class="education-item-content">
                                <span class="ellipsis">
                                   <?= strip_tags($item->content) ?>
                                </span>
						</div>
					</div>
				</a>

			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
