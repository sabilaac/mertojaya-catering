<?php
defined('BASEPATH') or exit('No direct script access allowed');
$title = null;
$review = null;
$city = null;

if (isset($feedback_detail) && sizeof($feedback_detail) > 0) {
	$title = $feedback_detail[0]->name;
	$review = $feedback_detail[0]->review;
	$city = $feedback_detail[0]->city;
}
?>
<h1 class="h3 mb-4 text-gray-800"><?= $mode === 'add' ? 'Tambah' : 'Edit' ?> Ulasan</h1>
<form action="" method="post" enctype="multipart/form-data">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Paket</h6>
		</div>
		<div class="card-body">
			<?php $this->load->view('admin/component/alert', array('data' => $this->session->flashdata('article_data'))) ?>
			<div class="form-group">
				<label for="name">
					Nama
				</label>
				<input type="text" name="name" class="form-control"
					   id="title"
					   placeholder="Masukkan nama"
					   value="<?= $title ?>"
					   required
				>
			</div>
			<div class="form-group">
				<label for="city">
					Kota
				</label>
				<input type="text" name="city" class="form-control"
					   id="city"
					   placeholder="Masukkan nama kota"
					   value="<?= $city ?>"
					   required
				>
			</div>
			<div class="form-group">
				<label for="summernote">
					Review
				</label>
				<textarea class="form-control" name="review" required><?= $review ?></textarea>
			</div>
		</div>
		<div class="card-footer">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<?php if (isset($date_created)) : ?>
						<small>
							Terakhir diperbarui <?= date("l, d m Y - H:i:s", strtotime($date_created)); ?>
						</small>
					<?php endif; ?>
				</div>
				<div class="col-lg-6 text-right">
					<?php if ($mode === 'edit') : ?>
						<button type="submit" name="submit" value="submit" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
									<i class="fas fa-save"></i>
								</span>
							<span class="text">Ubah</span>
						</button>
					<?php else: ?>
						<a href="<?= base_url() ?>admin/article" class="btn btn-danger btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-times"></i>
								</span>
							<span class="text">Batal</span>
						</a>
						<button type="submit" name="submit" value="submit" class="btn btn-primary btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-save"></i>
								</span>
							<span class="text">Simpan</span>
						</button>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

</form>

<script>
	const onChangeTitle = async () => {
		let title_input = $('#title');
		let url_input = $('#url');
		let url_input_hidden = $('#url_hidden');
		let url = null;
		await $.getJSON('<?= base_url() ?>api/generate_url/article?url=' + title_input.val(), function (data) {
			url = data?.data.replaceAll(/([!.,_=#~%`@*+?^$|(){}\[\]])/mg, '').replaceAll(' ', '-').replaceAll('&', '&amp;').toLowerCase()
			url_input.val('<?= base_url() ?>article?url=' + url);
			url_input_hidden.val(url);
		});
	}

	const onChangePic = (event, i) => {
		$('.image-input-group.standalone').addClass('uploaded');
		let reader = new FileReader();
		reader.onload = function () {
			$('.image-input-group.standalone img').attr("src", reader.result);
		};
		reader.readAsDataURL(event.target.files[0]);
	}
</script>
