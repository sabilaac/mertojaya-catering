<?php
$data_list = null;
if (isset($data)) {
	$data_list = json_decode($data, true);
}
?>
<?php if ($data_list && sizeof($data_list) > 0) : ?>
	<div class="tags-component">
	<span>
		Tags :
	</span>
		<?php foreach ($data_list as $i => $item) : ?>
			<a href="<?= base_url() . 'article?tags=' . preg_replace('/\W/', '+', $item) ?>">
				<?= $item ?>
			</a>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
