<?php
defined('BASEPATH') or exit('No direct script access allowed');
$thumbnail = null;
$title = null;
$description = null;
if (isset($data)) {
	$thumbnail = isset($data['thumbnail']) ? $data['thumbnail'] : 'https://assets1.lottiefiles.com/packages/lf20_wwTPJf.json';
	$title = isset($data['title']) ? $data['title'] : null;
	$description = isset($data['description']) ? $data['description'] : null;
	$action = isset($data['action']) ? $data['action'] : null;
	$link = isset($data['link']) ? $data['link'] : null;
}
?>
<div class="empty-state">
		<lottie-player src="<?= $thumbnail ?>"
					   background="transparent" style="width: 300px; height: 300px;" loop
					   autoplay>
		</lottie-player>
		<?php if ($title) : ?>
			<h4 class="text-black-50"><?= $title ?></h4>
		<?php endif; ?>
		<?php if ($description) : ?>
			<small class="text-black-50"><?= $description ?></small>
		<?php endif; ?>
		<?php if ($action && $link) : ?>
			<button onclick="location.href = '<?= $link ?>'">
				<?= $action ?>
			</button>
		<?php endif; ?>

</div>

