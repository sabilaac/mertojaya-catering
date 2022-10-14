<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<h1 class="h3 mb-4 text-gray-800">Daftar Artikel</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Artikel yang tersedia</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th style="width: 5%">No</th>
					<th style="width: 30%">Judul Artikel</th>
					<th style="width: 25%">Pembuat</th>
					<th style="width: 15%">Kategori</th>
					<th style="width: 15%">Tanggal Dibuat</th>
					<th style="width: 10%">Tool</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<th colspan="5">Total</th>
					<th><?= sizeof($package_list) ?></th>
				</tr>
				</tfoot>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>


