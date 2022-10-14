<?php
defined('BASEPATH') or exit('No direct script access allowed');
$title = null;
$description = null;
$url = null;
if (isset($data)) {
	$title = isset($data['title']) ? $data['title'] : '(Tidak ada Judul)';
	$description = isset($data['description']) ? $data['description'] : '';
	$url = isset($data['url']) ? $data['url'] : base_url();
}
?>
<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<p class="mb-4"><?= $description ?></p>

<script>
	setTimeout(() => {
		window.location = '<?= $url ?>';
	}, 500);
</script>
