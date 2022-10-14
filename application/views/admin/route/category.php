<?php
defined('BASEPATH') or exit('No direct script access allowed');
$src = $this->input->get('src');
?>
<h1 class="h3 mb-4 text-gray-800">Kategori Paket</h1>
<div class="row">
	<div class="col-lg-6">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
			</div>
			<div class="card-body">
				<?php $this->load->view('admin/component/alert', array('data' => $this->session->flashdata('category_data'))) ?>
				<form action="<?= base_url() . 'admin/category/add' ?>" method="post" class="form-group">
					<div class="form-group">
						<label for="name">
							Judul Paket
						</label>
						<input type="text" name="name" class="form-control"
							   id="name" aria-describedby="name"
							   placeholder="Masukkan kategori paket"
							   required
						>
					</div>
					<a href="<?= $src ?>" class="btn btn-danger btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-arrow-left"></i>
								</span>
						<span class="text">Kembali</span>
					</a>
					<button type="submit" name="add" class="btn btn-primary btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-save"></i>
								</span>
						<span class="text">Tambah</span>
					</button>

				</form>
				<hr>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
						<tr>
							<th style="width: 5%">No</th>
							<th style="width: 60%">Judul Kategori Paket</th>
							<th style="width: 30%">Tanggal dibuat</th>
							<th style="width: 5%">Tool</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($category_list)) : ?>
							<?php foreach ($category_list as $i => $item) : ?>
								<tr>
									<td><?= $i + 1 ?></td>
									<td><?= $item->name ?></td>
									<td><?= date("d/m/Y - H:i", strtotime($item->date_created)); ?></td>
									<td>
										<a href="<?= base_url() . 'admin/category/remove?id=' . $item->id ?>"
										   class="btn btn-danger">
											<i class="far fa-trash-alt"></i>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
