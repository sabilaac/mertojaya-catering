<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data_list = null;
$active = null;
if (isset($data)) {
	$data_list = isset($data['data_list']) ? $data['data_list'] : null;
	$active = isset($data['active']) ? $data['active'] : 0;
}
?>
<?php if ($data_list && sizeof($data_list) > 0) : ?>
	<div class="tab-component">
		<div class="tab-list">
			<?php foreach ($data_list as $i => $item) : ?>
				<div class="tab-item <?= $active === $i ? 'active' : '' ?>" data-target="<?= $item['target'] ?>">
					<div class="icon">
						<img src="<?= base_url() . 'assets/image/icon/' . $item['icon'] ?>" alt="Icon"/>
					</div>
					<small>
						<?= $item['title'] ?>
					</small>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

