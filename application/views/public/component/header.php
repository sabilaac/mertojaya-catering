<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="header">
	<div class="container">
		<div class="brand">
			<a href="<?= base_url()?>">
				<img src="<?= base_url() ?>assets/image/logo/brand.jpg" alt="Logo"/>
			</a>
		</div>
		<div class="hamburger">
			<input type="checkbox" id="hamburger">
			<label for="hamburger">
				<img src="<?= base_url() ?>assets/image/icon/hamburger.svg" alt="Menu"/>
			</label>
		</div>
		<div class="context">
			<ol class="menu">
				<li>
					<a href="<?= base_url() ?>" class="item page_home">
                        <span>
                            Beranda
                        </span>
					</a>
				</li>
				<li>
					<a href="<?= base_url() ?>package" class="item page_package">
                        <span>
                            Paket Katering
                        </span>
					</a>
					<?php if (isset($package_category) && sizeof($package_category) > 0) : ?>
						<ol class="submenu">
							<?php foreach ($package_category as $i => $item) : ?>
								<li>
									<a href="<?= base_url() . 'package?category=' . $item->id ?>">
										<?= $item->name ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ol>
					<?php endif; ?>
				</li>
				<li>
					<a href="<?= base_url() ?>rent" class="item page_rent">
                        <span>
                            Persewaan Alat Katering
                        </span>
					</a>
				</li>
				<li>
					<a href="<?= base_url() ?>gallery" class="item page_gallery">
                        <span>
                            Galeri
                        </span>
					</a>
				</li>
				<li>
					<a href="<?= isset($cs_wa) ? 'https://wa.me/' . $cs_wa : '#' ?>" class="item">
                        <span>
                            Hubungi Kami
                        </span>
					</a>
				</li>
			</ol>
		</div>
	</div>
</div>
