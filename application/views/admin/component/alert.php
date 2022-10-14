<?php
defined('BASEPATH') or exit('No direct script access allowed');

$id = 'alert' . rand(0, 99999);
$success = null;
$message = null;
$cancel = null;
if (isset($data)) {
	$id = isset($data['id']) ? $data['id'] : null;
	$success = isset($data['success']) ? $data['success'] : false;
	$message = isset($data['message']) ? $data['message'] : '(Pesan kosong)';
	$cancel = isset($data['cancel']) ? $data['cancel'] : true;
}
?>

<?php if (isset($data)) : ?>
	<div class="alert alert-<?= $success ? 'success' : 'danger' ?> <?= $cancel ? 'alert-dismissible' : '' ?> fade show" id="<?= $id ?>" role="alert">
		<span class="alert-text small" id="<?= $id ?>Message"><?= $message ?></span>
		<?php if ($cancel) : ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		<?php endif; ?>
	</div>
<?php endif; ?>
