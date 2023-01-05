<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<h1 class="h3 mb-4 text-gray-800">Daftar Edukasi</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Edukasi yang tersedia</h6>
	</div>
	<div class="card-body">
		<?php $this->load->view('admin/component/alert', array('data' => $this->session->flashdata('education_data'))) ?>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th style="width: 5%">No</th>
					<th style="width: 10%">Foto Header</th>
					<th style="width: 18%">Judul Edukasi</th>
					<th style="width: 15%">Tanggal dibuat</th>
					<th style="width: 15%">Tool</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<th colspan="4">Total</th>
					<th><?= sizeof($education_list) ?></th>
				</tr>
				</tfoot>
				<tbody>
				<?php if (isset($education_list)) : ?>
					<?php foreach ($education_list as $i => $item) : ?>
						<tr>
							<td><?= $i + 1 ?></td>
							<td>
								<img src="<?= base_url() . 'image/' . $item->thumbnail_uuid ?>" alt="Thumbnail" width="72"
									 height="72"/>
							</td>
							<td><b><?= $item->title ?></b></td>
							<td><?= date("l, d F Y", strtotime($item->date_created)); ?></td>
							<td>
								<a href="<?= base_url() . 'admin/education/remove/' . $item->id ?>"
								   class="btn btn-danger">
									<i class="fas fa-ban"></i>
								</a>
								<a href="<?= base_url() . 'admin/education/edit/' . $item->id ?>"
								   class="btn btn-primary">
									<i class="fas fa-pencil-alt"></i>
								</a>
								<?php if ($item->status === '1') : ?>
									<a href="<?= base_url() . 'admin/education/visibility/' . $item->id ?>"
									   class="btn btn-dark">
										<i class="far fa-eye"></i>
									</a>
								<?php else: ?>
									<a href="<?= base_url() . 'admin/education/visibility/' . $item->id ?>"
									   class="btn btn-dark">
										<i class="fas fa-eye-slash"></i>
									</a>
								<?php endif; ?>
								<a href="<?= base_url() . 'education?url=' . $item->url ?>"
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


