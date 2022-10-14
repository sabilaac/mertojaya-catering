<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<section id="footer">
	<div class="container">
		<div class="footer">
			<div class="separator"></div>
			<div class="brand">
				<img src="<?= base_url() ?>assets/image/logo/footer.jpg" alt="Logo"/>
			</div>
			<div class="menus">
				<div class="menus-item">
					<div class="menus-item-title">
                        <span>
                            Sitemap
                        </span>
					</div>
					<ol class="menus-item-content">
						<li>
							<a href="<?= base_url() ?>">
								Beranda
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>package">
								Paket Katering
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>rent">
								Persewaan Alat Katering
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>gallery">
								Galeri Foto
							</a>
						</li>
						<li>
							<a href="#">
								Hubungi Kami
							</a>
						</li>
					</ol>
				</div>
				<div class="menus-item">
					<div class="menus-item-title">
                        <span>
                            Dukungan
                        </span>
					</div>
					<ol class="menus-item-content">
						<li>
							<a href="#">
								Syarat dan Ketentuan
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>csr">
								Corporate Social responsibility (CSR)
							</a>
						</li>
						<li>
							<a href="<?= base_url() ?>career">
								Portal Karir
							</a>
						</li>
						<li>
							<a href="<?= isset($cs_email) ? 'mailto:' . $cs_email : '#' ?>">
								<img src="<?= base_url() ?>assets/image/icon/email-black.svg" alt="Icon"/><?= isset($cs_email) ? $cs_email : '#' ?>
							</a>
						</li>
						<li>
							<a href="<?= isset($cs_wa) ? 'https://wa.me/' . $cs_wa : '#' ?>">
								<img src="<?= base_url() ?>assets/image/icon/call-black.svg" alt="Icon"/><?= isset($cs_wa) ? $cs_wa : '#' ?>
							</a>
						</li>
					</ol>
				</div>
				<div class="menus-item">
					<div class="menus-item-title">
                        <span>
                            Alamat
                        </span>
					</div>
					<ol class="menus-item-content">
						<li>
							<?= $address ? $address : '(Alamat tidak tersedia)' ?>
							<br/>
							<a href="<?= $maps_url ? $maps_url : '#' ?>">
								<img src="<?= base_url() ?>assets/image/icon/maps.svg" alt="Icon"/>Buka di maps
							</a>
						</li>
					</ol>
				</div>
				<div>
					<div class="menus-item">
						<div class="menus-item-title">
                        <span>
                            Ikuti Kami
                        </span>
						</div>
						<div class="menus-item-icon">
							<div>
								<a href="<?= $ig_url ? $ig_url : '#' ?>">
									<img src="<?= base_url() ?>assets/image/icon/ig.svg" alt="Icon"/>
								</a>
							</div>
							<div>
								<a href="<?= $fb_url ? $fb_url :  '#' ?>">
									<img src="<?= base_url() ?>assets/image/icon/fb.svg" alt="Icon"/>
								</a>
							</div>
							<div>
								<a href="<?= $tiktok_url ? $tiktok_url :  '#' ?>">
									<img src="<?= base_url() ?>assets/image/icon/tiktok.svg" alt="Icon"/>
								</a>
							</div>
							<div>
								<a href="<?= $yt_url ? $yt_url :  '#' ?>">
									<img src="<?= base_url() ?>assets/image/icon/yt.svg" alt="Icon"/>
								</a>
							</div>
						</div>
					</div>
					<div class="mt-3 mt-md-4">
						<!--						<img src="--><?//= base_url() ?><!--assets/image/stat.jpg" alt="Stat"/>-->
						<div id="histats_counter"></div>
					</div>
				</div>
			</div>
			<div class="separator"></div>
			<div class="copy">
				<div>
                    <span>
                        Made with
                    </span>
					<img src="<?= base_url() ?>assets/image/icon/favorite.svg" alt="Love"/>
					<span>
                        from Malang. <b>Mertojaya Catering</b> &copy; <?= date("Y"); ?>
                    </span>
				</div>
				<button class="icon ms-2" onclick="goTop();">
					<img src="<?= base_url() ?>assets/image/icon/expand-less.svg" alt="Icon"/>
				</button>
			</div>
		</div>
	</div>
</section>
