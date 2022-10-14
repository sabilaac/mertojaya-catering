<?php
defined('BASEPATH') or exit('No direct script access allowed');
$url = array_slice($this->uri->rsegment_array(), 0);
$detail = $this->input->get('url') || $this->input->get('id');
?>

<div class="breadcrumb">
	<a href="<?= base_url() ?>">
		Home
	</a>
	<?php foreach ($url as $i => $item) : ?>
		<?php if ($item !== 'index') : ?>
			<a href="<?= $item ?>">
				<?= $item ?>
			</a>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php if ($detail) : ?>
		<a>
			Detail
		</a>
	<?php endif; ?>
</div>
