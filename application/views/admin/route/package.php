<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<h1 class="h3 mb-4 text-gray-800">Daftar Paket</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Paket yang tersedia</h6>
	</div>
	<div class="card-body">
		<?php $this->load->view('admin/component/alert', array('data' => $this->session->flashdata('package_data'))) ?>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th style="width: 5%">No</th>
					<th style="width: 10%">Foto Paket</th>
					<th style="width: 18%">Nama Paket</th>
					<th style="width: 15%">Kategori</th>
					<th style="width: 10%">Harga</th>
					<th style="width: 10%">Minimum Porsi</th>
					<th style="width: 17%">Direkomendasikan</th>
					<th style="width: 15%">Tool</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<th colspan="7">Total</th>
					<th><?= sizeof($package_list_force_status) ?></th>
				</tr>
				</tfoot>
				<tbody>
				<?php if (isset($package_list_force_status)) : ?>
					<?php foreach ($package_list_force_status as $i => $item) : ?>
						<tr>
							<td><?= $i + 1 ?></td>
							<td>
								<?php if ($item->photo_1) : ?>
									<img src="<?= base_url() . 'cdn/' . $item->photo_1 ?>" alt="Thumbnail" width="72"
										 height="72"/>
								<?php elseif ($item->photo_2) : ?>
									<img src="<?= base_url() . 'cdn/' . $item->photo_2 ?>" alt="Thumbnail" width="72"
										 height="72"/>
								<?php elseif ($item->photo_3) : ?>
									<img src="<?= base_url() . 'cdn/' . $item->photo_3 ?>" alt="Thumbnail" width="72"
										 height="72"/>
								<?php elseif ($item->photo_4) : ?>
									<img src="<?= base_url() . 'cdn/' . $item->photo_4 ?>" alt="Thumbnail" width="72"
										 height="72"/>
								<?php else : ?>
									(Tidak ada Foto)
								<?php endif; ?>
							</td>
							<td><b><?= $item->title ?></b></td>
							<td><?= $item->category_name ?></td>
							<td>Rp. <?= number_format($item->price, 0, ",", ".") ?>,-</td>
							<td><?= $item->count ?> pcs</td>
							<td>
								<?php if ($item->promoted_id) : ?>
									<a href="<?= base_url() . 'admin/package/dispatch_recommendation?id=' .$item->promoted_id ?>" class="btn btn-danger">
										<span class="text">Lepas rekomendasi</span>
									</a>
								<?php else : ?>
									<button onclick="toggleRecommendation('<?= $item->id ?>')" data-toggle="modal"
											data-target="#AddRecommendation"
											class="btn btn-primary">
										<span class="text">Tambahkan ke rekomendasi</span>
									</button>
								<?php endif; ?>
							</td>
							<td>
								<a href="<?= base_url() . 'admin/package/remove?url=' . $item->url ?>"
								   class="btn btn-danger">
									<i class="fas fa-ban"></i>
								</a>
								<a href="<?= base_url() . 'admin/package/edit?url=' . $item->url ?>"
								   class="btn btn-primary">
									<i class="fas fa-pencil-alt"></i>
								</a>
								<?php if ($item->status === '1') : ?>
									<a href="<?= base_url() . 'admin/package/visibility?url=' . $item->url ?>"
									   class="btn btn-dark">
										<i class="far fa-eye"></i>
									</a>
								<?php else: ?>
									<a href="<?= base_url() . 'admin/package/visibility?url=' . $item->url ?>"
									   class="btn btn-dark">
										<i class="fas fa-eye-slash"></i>
									</a>
								<?php endif; ?>
								<a href="<?= base_url() . 'package?url=' . $item->url ?>"
								   class="btn btn-success" target="_blank">
									<i class="fas fa-external-link-alt"></i>
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


<div class="modal fade" id="AddRecommendation" tabindex="-1" role="dialog" aria-labelledby="modal"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambahkan ke Rekomendasi</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<?php $this->load->view('admin/component/alert', array('data' => array(
						'id' => 'alertRecommendation',
						'show' => false,
						'cancel' => false,
				))) ?>
				<div class="form-group">
					<label for="video_url">
						Alamat Video
					</label>
					<input type="url" class="form-control"
						   id="videoUrl" aria-describedby="video"
						   placeholder="Masukkan alamat link video"
					>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
				<button id="btnSubmit" onclick="addToRecommendation()" class="btn btn-primary" type="button">Tambahkan
				</button>
				<button id="btnLoading" class="btn btn-primary" type="button" disabled>
					<div class="d-flex align-items-center justify-content-center">
						<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
						Menambahkan
					</div>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	let idTarget = null;
	const toggleRecommendation = (id) => {
		$('#alertRecommendation').hide();
		$('#btnLoading').hide();
		idTarget = id;
	}
	const addToRecommendation = async () => {
		let videoUrl = $('#videoUrl').val();
		$('#btnLoading').show();
		$('#btnSubmit').hide();
		await $.post("<?= base_url() ?>api/promoted/add", {
			package_id: idTarget,
			video_url: videoUrl
		}, function (data) {
			let res = JSON.parse(data);
			$('#alertRecommendation').removeClass('alert-danger');
			$('#alertRecommendation').removeClass('alert-success');
			$('#alertRecommendation').addClass(res?.success ? 'alert-success' : 'alert-danger');
			$('#alertRecommendationMessage').text(res?.message);
			$('#alertRecommendation').show();
			if (res?.success) {
				setTimeout(() => {
					location.reload();
				}, 1000)
			} else {
				$('#btnLoading').hide();
				$('#btnSubmit').show();
			}
		});
	}


</script>


