<?php
defined('BASEPATH') or exit('No direct script access allowed');
$title = null;
$url = null;
$copyright = null;
$content = null;
$thumbnail = null;
$date = null;
$category_tag = null;

if (isset($article_detail) && sizeof($article_detail) > 0) {
	$title = $article_detail[0]->title;
	$url = $article_detail[0]->url;
	$copyright = $article_detail[0]->thumbnail_copyright;
	$content = $article_detail[0]->content;
	$thumbnail = $article_detail[0]->thumbnail_uuid;
	$date_created = $article_detail[0]->date_created;
	$category_tag = $article_detail[0]->category_tag ? join(", ", json_decode($article_detail[0]->category_tag)) : null;
}
?>
<h1 class="h3 mb-4 text-gray-800"><?= $mode === 'add' ? 'Tambah' : 'Edit' ?> Artikel</h1>
<form action="" method="post" enctype="multipart/form-data">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Paket</h6>
		</div>
		<div class="card-body">
			<?php $this->load->view('admin/component/alert', array('data' => $this->session->flashdata('article_data'))) ?>
			<div class="form-group image-input-group standalone <?= $thumbnail ? 'uploaded' : '' ?>">
				<label for="thumbnail">
					<img src="<?= $thumbnail ? base_url() . 'cdn/' . $thumbnail . '.jpg' : '#' ?>" alt="Image"/>
					<div class="placeholder">
						<i class="far fa-plus-square  fa-2x"></i>
						<small>
							Tambahkan Foto Header
						</small>
					</div>
				</label>
				<input type="file" onchange="onChangePic(event, 1)" accept=".jpg,.jpeg"
					   name="thumbnail"
					   class="form-control-file"
					   id="thumbnail">
			</div>
			<div class="form-group">
				<label for="title">
					Judul Artikel
				</label>
				<input type="text" name="title" class="form-control"
					   id="title" aria-describedby="title"
					   placeholder="Masukkan judul artikel"
					   value="<?= $title ?>"
					   oninput="onChangeTitle()"
					   required
				>
			</div>
			<div class="form-group">
				<label for="url_package">
					Alamat artikel
				</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">
							<i class="fas fa-link"></i>
						</span>
					</div>
					<input type="url" class="form-control copy-text"
						   id="url" aria-describedby="url" value="<?= base_url() . 'article?url=' . $url ?>"
						   placeholder="Alamt Paket" min="0" disabled>
					<div class="input-group-append">
						<button class="btn btn-primary btn-icon-split" type="button"
								onclick="copyText('Alamat telah disalin')">
							<span class="icon text-white-50">
								<i class="far fa-copy"></i>
							</span>
							<span class="text">
								Salin
							</span>
						</button>
					</div>
				</div>
				<input type="hidden" name="path" value="<?= $url ?>"
					   id="url_hidden" placeholder="Alamt Paket">
			</div>
			<div class="form-group">
				<label for="summernote">
					Isi Konten
				</label>
				<textarea id="summernote" name="content" required><?= $content ?></textarea>
			</div>
			<div class="form-check">
				<input class="form-check-input" name="copyright" type="checkbox" id="copyright" <?= isset($copyright)  ? "disabled" : "" ?> <?= intval($copyright) === 1 ? "checked" : "" ?>>
				<label class="form-check-label" for="copyright">
					Foto mempunyai copyright?
				</label>
			</div>
			<div class="form-group mt-3">
				<label for="category_tag">
					Tag Artikel
				</label>
				<input type="text" name="category_tag" class="form-control"
					   id="category_tag" aria-describedby="category_tag"
					   placeholder="Pisahkan dengan koma (,)"
					   value="<?= $category_tag ?>"
					   required
				>
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
						<a href="<?= base_url() . 'admin/package/remove?url=' . $url ?>"
						   class="btn btn-danger btn-icon-split">
									<span class="icon text-white-50">
										<i class="fas fa-ban"></i>
									</span>
							<span class="text">Hapus</span>
						</a>
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
