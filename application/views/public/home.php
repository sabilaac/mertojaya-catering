<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php $this->load->view('public/component/head'); ?>
<body id="page_home">
<?php $this->load->view('public/component/preloader'); ?>
<?php $this->load->view('public/component/header'); ?>
<?php $this->load->view('public/component/responsive_handler'); ?>
<section id="head">
	<div class="container">
		<?php $this->load->view('public/component/banner_component', array('data' => array(
				'data_list' => $banner_list
		))); ?>
	</div>
</section>
<section id="education">
	<div class="container">
		<?php $this->load->view('public/component/education_component', array('data' => array(
				'data_list' => $education_list
		))); ?>
	</div>
</section>
<section id="package">
	<div class="container">
		<div class="package-header">
			<div>
				<h3>
					Pilihan Paket dari Kami
				</h3>
				<h5>
					Paket katering mulai dari Rp. 1.000.000 saja
				</h5>
			</div>
			<a href="<?= base_url() ?>package">
				Lihat Semua
			</a>
		</div>
		<div class="package-body">
			<div class="package-list">
				<div class="package-wrapper">
					<div class="package-list-item active">
                        <span>
                            Tampilkan Semua Paket
                        </span>
						<small>
							Tanpa Filter
						</small>
					</div>
					<?php if (isset($category_list)) : ?>
						<?php foreach ($category_list as $i => $item) : ?>
							<div class="package-list-item" data-filter="category_<?= $item->id ?>">
								<span>
									<?= $item->name ?>
								</span>
								<small>
									Filter <?= $i + 1 ?>
								</small>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<?php $this->load->view('public/component/package_component', array('data' => array(
					'data_list' => $package_list
			))); ?>
		</div>
	</div>
</section>
<section id="article">
	<div class="container">
		<?php $this->load->view('public/component/article_component', array('data' => array(
				'title' => 'Artikel',
				'description' => 'Aktivitas terbaru kami dalam event',
				'data_list' => $article_list
		))); ?>
	</div>
</section>
<section id="feedback">
	<div class="container">
		<div class="feedback">
			<div class="side">
				<div>
					<h3>
						Apa pendapat mereka</br>tentang
					</h3>
					<div class="brand">
						<h3>
							Mertojaya
						</h3>
						<h3>
							Catering
						</h3>
					</div>
				</div>
				<div class="arrow-wrapper">
					<div>
						<div class="arrow prev owl-prev">
							<img loading="lazy" src="<?= base_url() ?>assets/image/icon/arrow.svg" alt="Arrow"/>
						</div>
						<!--                        <div class="arrow next">-->
						<!--                            <img loading="lazy" src="<?= base_url() ?>assets/image/icon/arrow.svg" alt="Arrow"/>-->
						<!--                        </div>-->
					</div>
				</div>
			</div>
			<?php $this->load->view('public/component/feedback_component') ?>
		</div>
	</div>
</section>
<section id="gallery">
	<div class="container">
		<?php $this->load->view('public/component/gallery_component', array('data' => array(
				'title' => 'Galeri',
				'description' => 'Aktivitas terbaru kami dalam event',
				'data_list' => $gallery_list
		))); ?>
	</div>
</section>
<section id="feature">
	<div class="container">
		<div class="feature">
			<div class="feature-header">
				<h3>
					Mengapa memilih kami?
				</h3>
				<h5>
					Karena kami ada untuk Anda
				</h5>
			</div>
			<div class="feature-list">
				<div class="feature-item">
					<div class="icon">
						<div>
							<img loading="lazy" src="<?= base_url() ?>assets/image/icon/online.svg" alt="Icon"/>
						</div>
					</div>
					<b>
						Lorem ipsum dolor ismet.
					</b>
					<small>
						Keterangan teks Panjang
						2 baris untuk keunggulan
					</small>
				</div>
				<div class="feature-item">
					<div class="icon">
						<div>
							<img loading="lazy" src="<?= base_url() ?>assets/image/icon/check.svg" alt="Icon"/>
						</div>
					</div>
					<b>
						Lorem ipsum dolor ismet.
					</b>
					<small>
						Keterangan teks Panjang
						2 baris untuk keunggulan
					</small>
				</div>
				<div class="feature-item">
					<div class="icon">
						<div>
							<img loading="lazy" src="<?= base_url() ?>assets/image/icon/cart.svg" alt="Icon"/>
						</div>
					</div>
					<b>
						Lorem ipsum dolor ismet.
					</b>
					<small>
						Keterangan teks Panjang
						2 baris untuk keunggulan
					</small>
				</div>
				<div class="feature-item">
					<div class="icon">
						<div>
							<img loading="lazy" src="<?= base_url() ?>assets/image/icon/wallet.svg" alt="Icon"/>
						</div>
					</div>
					<b>
						Lorem ipsum dolor ismet.
					</b>
					<small>
						Keterangan teks Panjang
						2 baris untuk keunggulan
					</small>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="maps">
	<div class="container">
		<div class="maps">
			<div class="maps-header">
				<h3>
					Temukan kami disini
				</h3>
				<h5>
					Klik pada <i>maps</i> untuk menelusuri area
				</h5>
			</div>
			<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63220.91252899193!2d112.58655029521324!3d-7.9671875274294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78821248c4b919%3A0xe8fa960fff4c53fe!2sAngkringan%20Podjok%20Malang!5e0!3m2!1sid!2sid!4v1650035936923!5m2!1sid!2sid&zoom=12"
					width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</section>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
</body>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
