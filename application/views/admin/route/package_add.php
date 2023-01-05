<?php
defined('BASEPATH') or exit('No direct script access allowed');
$title = null;
$url = null;
$category_id = null;
$price = null;
$count = null;
$content = null;
$photo_1 = null;
$photo_2 = null;
$photo_3 = null;
$photo_4 = null;
$date = null;
if (isset($package_detail)) {
	$title = $package_detail->title;
	$url = $package_detail->url;
	$category_id = $package_detail->category_id;
	$price = $package_detail->price;
	$count = $package_detail->count;
	$content = $package_detail->content;
	$photo_1 = $package_detail->photo_1_uuid;
	$photo_2 = $package_detail->photo_2_uuid;
	$photo_3 = $package_detail->photo_3_uuid;
	$photo_4 = $package_detail->photo_4_uuid;
	$date = $package_detail->date_created;
}
?>
<h1 class="h3 mb-4 text-gray-800"><?= $mode === 'add' ? 'Tambah' : 'Edit' ?> Paket</h1>
<form action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Data Paket</h6>
				</div>
				<div class="card-body">
					<?php $this->load->view('admin/component/alert', array('data' => $this->session->flashdata('package_data'))) ?>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label for="title">
									Judul Paket
								</label>
								<input type="text" name="title" class="form-control"
									   id="title" aria-describedby="title"
									   placeholder="Masukkan judul paket"
									   value="<?= $title ?>"
									   oninput="onChangeTitle()"
									   required
								>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="category">
									Kategori Paket
								</label>
								<div class="input-group">
									<select class="custom-select" id="category" name="category" required>
										<option disabled <?= !$category_id ? 'selected' : '' ?>>Pilih kategori paket
										</option>
										<?php if (isset($category_list) && sizeof($category_list) > 0) : ?>
											<?php foreach ($category_list as $i => $item) : ?>
												<option value="<?= $item->id ?>" <?= $category_id === $item->id ? 'selected' : '' ?>>
													<?= $item->name ?>
												</option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
									<div class="input-group-append">
										<a href="<?= base_url() . 'admin/category?src=' . urlencode(base_url() . 'admin/package/add' . ($url ? '?url=' . $url : '')) ?>"
										   class="btn btn-primary btn-icon-split">
											<span class="icon text-white-50">
												<i class="fas fa-plus-circle"></i>
											</span>
										</a>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="form-group">
						<label for="url_package">
							Alamat Paket
						</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fas fa-link"></i>
								</span>

							</div>
							<input type="url" class="form-control copy-text"
								   id="url_package" aria-describedby="url" value="<?= base_url() . 'package?url=' . $url ?>"
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
							   id="url_package_hidden" placeholder="Alamt Paket">
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="price">
									Harga per Paket
								</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">Rp.</span>
									</div>
									<input type="number" name="price" class="form-control"
										   id="price" aria-describedby="price"
										   value="<?= $price ?>"
										   placeholder="0" min="0" required>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="price">
									Jumlah porsi
								</label>
								<div class="input-group">
									<input type="number" name="count" class="form-control"
										   id="price" aria-describedby="price"
										   value="<?= $count ?>"
										   placeholder="0" min="0" required>
									<div class="input-group-append">
										<span class="input-group-text">pcs</span>
									</div>
								</div>

							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label for="phone">
									Nomor Telepon
								</label>
								<input type="text" name="phone" class="form-control"
									   id="title" aria-describedby="phone" value="<?= $cs_wa ?>"
									   placeholder="Nomor telepon" disabled
									   title="Anda dapat mengatur nomor pemesanan di menu pengaturan">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="summernote">
							Isi Konten
						</label>
						<textarea id="summernote" name="content" required><?= $content ?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Foto Paket</h6>
				</div>
				<div class="card-body">
					<div class="image-input-list">
						<div class="form-group image-input-group __1 <?= $photo_1 ? 'uploaded' : '' ?>">
							<label for="image1">
								<img src="<?= $photo_1 ? base_url() . 'image/' . $photo_1 : '#' ?>" alt="Image"/>
								<div class="placeholder">
									<i class="far fa-plus-square  fa-2x"></i>
									<small>
										Tambahkan Foto 1
									</small>
								</div>
							</label>
							<input type="file" onchange="onChangePic(event, 1)" accept=".gif, .jpg,.jpeg,.bmp, .png"
								   name="photo_1"
								   value="<?= $photo_1 ?>"
								   class="form-control-file"
								   id="image1">
						</div>
						<div class="form-group image-input-group __2 <?= $photo_2 ? 'uploaded' : '' ?>">
							<label for="image2">
								<img src="<?= $photo_2 ? base_url() . 'image/' . $photo_2 : '#' ?>" alt="Image"/>
								<div class="placeholder">
									<i class="far fa-plus-square  fa-2x"></i>
									<small>
										Tambahkan Foto 2
									</small>
								</div>
							</label>
							<input type="file" onchange="onChangePic(event, 2)" accept=".gif, .jpg,.jpeg,.bmp, .png"
								   name="photo_2"
								   class="form-control-file"
								   value="<?= $photo_2 ?>"
								   id="image2">
						</div>
						<div class="form-group image-input-group __3 <?= $photo_3 ? 'uploaded' : '' ?>">
							<label for="image3">
								<img src="<?= $photo_3 ? base_url() . 'image/' . $photo_3 : '#' ?>" alt="Image"/>
								<div class="placeholder">
									<i class="far fa-plus-square  fa-2x"></i>
									<small>
										Tambahkan Foto 3
									</small>
								</div>
							</label>
							<input type="file" onchange="onChangePic(event, 3)" accept=".gif, .jpg,.jpeg,.bmp, .png"
								   name="photo_3"
								   value="<?= $photo_3 ?>"
								   class="form-control-file"
								   id="image3">
						</div>
						<div class="form-group image-input-group __4 <?= $photo_4 ? 'uploaded' : '' ?>">
							<label for="image4">
								<img src="<?= $photo_4 ? base_url() . 'image/' . $photo_4 : '#' ?>" alt="Image"/>
								<div class="placeholder">
									<i class="far fa-plus-square  fa-2x"></i>
									<small>
										Tambahkan Foto 4
									</small>
								</div>
							</label>
							<input type="file" onchange="onChangePic(event, 4)" accept=".gif, .jpg,.jpeg,.bmp, .png"
								   name="photo_4"
								   value="<?= $photo_4 ?>"
								   class="form-control-file"
								   id="image4">
						</div>
					</div>
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<?php if ($date) : ?>
								<small>
									Terakhir diperbarui <?= date("l, d m Y - H:i:s", strtotime($date)); ?>
								</small>
							<?php endif; ?>
						</div>
						<div class="col-lg-6 text-right">
							<?php if ($mode === 'edit') : ?>
								<a href="<?= base_url() . 'admin/package/remove/' . $url ?>"
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
								<a href="<?= base_url() ?>admin/package" class="btn btn-danger btn-icon-split">
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
		</div>

	</div>
</form>

<script>
	const onChangeTitle = async () => {
		let title_input = $('#title');
		let url_input = $('#url_package');
		let url_input_hidden = $('#url_package_hidden');
		let url = null;
		await $.getJSON('<?= base_url() ?>api/generate_url/article?url=' + title_input.val(), function (data) {
			url = data?.data.replaceAll(/([!.,_=#~%`@*+?^$|(){}\[\]])/mg, '').replaceAll(' ', '-').replaceAll('&', '&amp;').toLowerCase()
			url_input.val('<?= base_url() ?>package?url=' + url);
			url_input_hidden.val(url);
		});
	}

	const onChangePic = (event, i) => {
		$('.image-input-group.__' + i).addClass('uploaded');
		let reader = new FileReader();
		reader.onload = function () {
			$('.image-input-group.__' + i + ' img').attr("src", reader.result);
		};
		reader.readAsDataURL(event.target.files[0]);
	}
</script>
