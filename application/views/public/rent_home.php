<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php $this->load->view('public/component/head', array('title' => 'Persewaan Alat Katering')); ?>
<body id="page_rent">
<?php $this->load->view('public/component/preloader'); ?>
<?php $this->load->view('public/component/header'); ?>
<div class="container">
	<?php $this->load->view('public/component/breadcrumb'); ?>
	<h3>
		Persewaan Alat Catering
	</h3>
	<h5>
		Mertojaya Catering
	</h5>
	<table id="datatable" class="display" style="width:100%">
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>Satuan</th>
			<th>Harga Sewa</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>1</td>
			<td>Meja Bundar / Round Table O 120 cm</td>
			<td>Unit</td>
			<td>Rp75.000</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Meja Saji 60cm × 120cm</td>
			<td>Unit</td>
			<td>Rp50.000</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Meja Gubukan 90cm x 120 cm</td>
			<td>Unit</td>
			<td>Rp65.000</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Taplak Meja Skirting + Lace</td>
			<td>Piece</td>
			<td>Rp30.000</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Meja Bundar + Skriting + Lace</td>
			<td>Set</td>
			<td>Rp100.000</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Meja Saji + Taplak Skirting + Lace</td>
			<td>Set</td>
			<td>Rp150.000</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Meja Stall / Gubukan / Pondokan + Cover</td>
			<td>Set</td>
			<td>Rp150.000</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Roll Top Besar (Kotak) 9 liter</td>
			<td>Unit</td>
			<td>Rp100.000</td>
		</tr>
		<tr>
			<td>9</td>
			<td>Roll Top sedang (Bulat) 6,8 liter</td>
			<td>Unit</td>
			<td>Rp100.000</td>
		</tr>
		<tr>
			<td>10</td>
			<td>Pemanas Prasmanan Kecil (Kotak)</td>
			<td>Unit</td>
			<td>Rp25.000</td>
		</tr>
		<tr>
			<td>11</td>
			<td>Pemanas Sayur / Soup (Bulat)</td>
			<td>Unit</td>
			<td>Rp30.000</td>
		</tr>
		<tr>
			<td>12</td>
			<td>Sendok Makan grade A</td>
			<td>Piece</td>
			<td>Rp1.000</td>
		</tr>
		<tr>
			<td>13</td>
			<td>Sendok Makan grade B</td>
			<td>Piece</td>
			<td>Rp500</td>
		</tr>
		<tr>
			<td>14</td>
			<td>Sendok Kopi grade A</td>
			<td>Piece</td>
			<td>Rp750</td>
		</tr>
		<tr>
			<td>15</td>
			<td>Sendok Snack grade A</td>
			<td>Piece</td>
			<td>Rp750</td>
		</tr>
		<tr>
			<td>16</td>
			<td>Garpu Makan grade A</td>
			<td>Piece</td>
			<td>Rp1.000</td>
		</tr>
		<tr>
			<td>17</td>
			<td>Garpu Snack grade A</td>
			<td>Piece</td>
			<td>Rp1.000</td>
		</tr>
		<tr>
			<td>18</td>
			<td>Scoop Es Besar</td>
			<td>Piece</td>
			<td>Rp10.000</td>
		</tr>
		<tr>
			<td>19</td>
			<td>Scoop Es Kecil</td>
			<td>Piece</td>
			<td>Rp5.000</td>
		</tr>
		<tr>
			<td>20</td>
			<td>Gayung</td>
			<td>Piece</td>
			<td>Rp5.000</td>
		</tr>
		<tr>
			<td>21</td>
			<td>Cake Tong / Jepitan Kue</td>
			<td>Piece</td>
			<td>Rp3.000</td>
		</tr>
		<tr>
			<td>22</td>
			<td>Pisau</td>
			<td>Piece</td>
			<td>Rp3.000</td>
		</tr>
		<tr>
			<td>23</td>
			<td>Serving Spoon</td>
			<td>Piece</td>
			<td>Rp3.000</td>
		</tr>
		<tr>
			<td>24</td>
			<td>Toples Kerupuk Besar</td>
			<td>Piece</td>
			<td>Rp10.000</td>
		</tr>
		<tr>
			<td>25</td>
			<td>Toples kecil / Condiment Set Kopi / Gula / Krimer</td>
			<td>Piece</td>
			<td>Rp5.000</td>
		</tr>
		<tr>
			<td>26</td>
			<td>Nampan</td>
			<td>Piece</td>
			<td>Rp5.000</td>
		</tr>
		<tr>
			<td>27</td>
			<td>Bowl Jumbo Bening Medium untuk Es</td>
			<td>Piece</td>
			<td>Rp15.000</td>
		</tr>
		<tr>
			<td>28</td>
			<td>Bowl Jumbo Big warna silver untuk Es</td>
			<td>Piece</td>
			<td>Rp20.000</td>
		</tr>
		<tr>
			<td>29</td>
			<td>Bowl/Mangkok(bakso/siomay/gado-gado/tahu campur)</td>
			<td>Piece</td>
			<td>Rp2.000</td>
		</tr>
		<tr>
			<td>30</td>
			<td>Piring Makan Standar 9 inch</td>
			<td>Piece</td>
			<td>Rp2.000</td>
		</tr>
		<tr>
			<td>31</td>
			<td>Piring Makan Flat / Ceper 10 inch</td>
			<td>Piece</td>
			<td>Rp2.500</td>
		</tr>
		<tr>
			<td>32</td>
			<td>Piring Snack / BnB Plate 7 inch</td>
			<td>Piece</td>
			<td>Rp1.500</td>
		</tr>
		<tr>
			<td>33</td>
			<td>Tatakan Cangkir / Saucer</td>
			<td>Piece</td>
			<td>Rp1.000</td>
		</tr>
		<tr>
			<td>34</td>
			<td>Dispenser Juice Stainless </td>
			<td>Piece</td>
			<td>Rp75.000</td>
		</tr>
		<tr>
			<td>35</td>
			<td>Cangkir / Tea Cup + Saucer / Tatakan</td>
			<td>Set</td>
			<td>Rp2.500</td>
		</tr>
		<tr>
			<td>36</td>
			<td>Termos Es / Nasi besar</td>
			<td>Piece</td>
			<td>Rp25.000</td>
		</tr>
		<tr>
			<td>37</td>
			<td>Kompor Gas Portable 1 Tungku (tanpa isi) </td>
			<td>Unit</td>
			<td>Rp25.000</td>
		</tr>
		<tr>
			<td>38</td>
			<td>Bak Industri (piring kotor)</td>
			<td>Unit</td>
			<td>Rp20.000</td>
		</tr>
		<tr>
			<td>39</td>
			<td>Vas besar + bunga</td>
			<td>Unit</td>
			<td>Rp100.000</td>
		</tr>
		<tr>
			<td>40</td>
			<td>Jasa Dekorasi Buffee Catering </td>
			<td>Unit</td>
			<td>Rp250.000</td>
		</tr>

		</tbody>
	</table>
	<div class="separator"></div>
	<div style="display: flex; align-items: center; flex-direction: column; gap: 1rem">
		<small>
			Update harga terbaru (April 2022)
		</small>
		<span>
			Jika ada pertanyaan seputar harga atau ketersediaan alat lainnya dapat menekan tombol dibawah untuk bertanya
		</span>
		<button onclick="location.href = 'https://wa.me/<?= $cs_wa . '?text=' . urlencode('Saya ingin bertanya tentang persewaan alat katering. Alamat paket (' . base_url() . 'rent)')?>'">
			<img src="<?= base_url()?>assets/image/icon/wa.svg" alt="Icon" />
			Tanya
		</button>
	</div>

</div>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/footer'); ?>
<script>

</script>
<?php $this->load->view('public/component/foot'); ?>
