<?php
defined('BASEPATH') or exit('No direct script access allowed');

$title = null;
$cancel = null;
$content = null;
$target = null;
$yes_title = null;
$cancel_title = null;
$id = 'modal' . rand(0, 99999);

if (isset($data)) {
	$title = isset($data['title']) ? $data['title'] : null;
	$cancel = isset($data['cancel']) ? $data['cancel'] : true;
	$content = isset($data['content']) ? $data['content'] : '(Tidak ada pesan)';
	$target = isset($data['target']) ? $data['target'] : null;
	$yes_title = isset($data['yes_title']) ? $data['yes_title'] : 'OK';
	$cancel_title = isset($data['cancel_title']) ? $data['cancel_title'] : 'Batal';
	$id = isset($data['id']) ? $data['id'] : 'modal' . rand(0, 99999);
}

?>
<div class="modal fade" id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="modal"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<?php if ($title) : ?>
					<h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
				<?php endif; ?>
				<?php if ($cancel) : ?>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				<?php endif; ?>
			</div>
			<div class="modal-body"><?= $content ?></div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><?= $cancel_title ?></button>
				<?php if ($target) : ?>
					<a class="btn btn-primary" href="<?= $target ?>"><?= $yes_title ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
