<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_page = $this->uri->segment(2);
$active_route = $this->uri->segment(3);
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>admin">
		<div class="sidebar-brand-icon">
			<i class="fas fa-utensils"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Mertojaya Catering</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item <?= !$active_page ? 'active' : '' ?>"
	">
	<a class="nav-link" href="<?= base_url() ?>admin">
		<i class="fas fa-fw fa-tachometer-alt"></i>
		<span>Analitik</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Kelola Paket
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item <?= $active_page === 'package' && isset($active_route) ? 'active' : '' ?>">
		<a class="nav-link" href="<?= base_url() ?>admin/package/add">
			<i class="fas fa-plus-circle"></i>
			<span>Tambah Paket</span></a>
	</li>
	<li class="nav-item <?= $active_page === 'package' && !isset($active_route) ? 'active' : '' ?>">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#packageListCollapse"
		   aria-expanded="true" aria-controls="packageListCollapse">
			<i class="far fa-list-alt"></i>
			<span>Daftar Paket</span>
		</a>
		<div id="packageListCollapse"
			 class="collapse <?= $active_page === 'package' && !isset($active_route) ? 'show' : '' ?>"
			 aria-labelledby="packageList" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<?php if (isset($package_list) && sizeof($package_list) > 0) : ?>
					<?php foreach ($package_list as $i => $item) : ?>
						<a class="collapse-item <?= $active_page === 'package' && $active_route === $item->url ? 'active' : '' ?>"
						   href="<?= base_url() ?>admin/package/edit/<?= $item->url ?>">
							<span class="ellipsis">
							<?= $item->title ?>
							</span>
						</a>
					<?php endforeach; ?>
				<?php else : ?>
					<h6 class="collapse-header">Paket kosong</h6>
				<?php endif; ?>
			</div>
		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>admin/package?filter=recommendation">
			<i class="fas fa-archive"></i>
			<span>Daftar Rekomendasi Paket</span></a>
	</li>

	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Kelola Promo
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>admin/promo/add">
			<i class="fas fa-plus-circle"></i>
			<span>Tambah Promo</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>admin/promo">
			<i class="fas fa-percent"></i>
			<span>Konten Promo</span></a>
	</li>

	<!-- Nav Item - Utilities Collapse Menu -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Kelola Konten
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item <?= $active_page === 'article' ? 'active' : '' ?>">
		<a class="nav-link <?= $active_page === 'article' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse"
		   data-target="#articleListCollapse"
		   aria-expanded="true" aria-controls="articleList">
			<i class="far fa-newspaper"></i>
			<span>Artikel</span>
		</a>
		<div id="articleListCollapse"
			 class="collapse <?= $active_page === 'article' ? 'show' : '' ?>"
			 aria-labelledby="articleList" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $active_page === 'article' && isset($active_route) && $active_route === 'add' ? 'active' : '' ?>"
				   href="<?= base_url() ?>admin/article/add">Tambah Artikel</a>
				<a class="collapse-item <?= $active_page === 'article' && !isset($active_route) ? 'active' : '' ?>"
				   href="<?= base_url() ?>admin/article">Kelola Artikel</a>
			</div>
		</div>
	</li>
	<li class="nav-item <?= $active_page === 'education' ? 'active' : '' ?>">
		<a class="nav-link <?= $active_page === 'education' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse"
		   data-target="#educationListCollapse"
		   aria-expanded="true" aria-controls="educationList">
			<i class="fas fa-graduation-cap"></i>
			<span>Edukasi</span>
		</a>
		<div id="educationListCollapse"
			 class="collapse <?= $active_page === 'education' ? 'show' : '' ?>"
			 aria-labelledby="educationList"
			 data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $active_page === 'education' && isset($active_route) && $active_route === 'add' ? 'active' : '' ?>"
				   href="<?= base_url() ?>admin/education/add">Tambah Kontent Edukasi</a>
				<a class="collapse-item <?= $active_page === 'education' && !isset($active_route) ? 'active' : '' ?>"
				   href="<?= base_url() ?>admin/education">Kelola Edukasi</a>
			</div>
		</div>
	</li>
	<li class="nav-item <?= $active_page === 'feedback' ? 'active' : '' ?>">
		<a class="nav-link <?= $active_page === 'feedback' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse"
		   data-target="#feedbackListCollapse"
		   aria-expanded="true" aria-controls="feedbackList">
			<i class="far fa-comments"></i>
			<span>Ulasan</span>
		</a>
		<div id="feedbackListCollapse"
			 class="collapse <?= $active_page === 'feedback' ? 'show' : '' ?>"
			 aria-labelledby="feedbackList" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $active_page === 'feedback' && isset($active_route) && $active_route === 'add' ? 'active' : '' ?>"
				   href="<?= base_url() ?>admin/feedback/add">Tambah Custom Ulasan</a>
				<a class="collapse-item <?= $active_page === 'feedback' && !isset($active_route) ? 'active' : '' ?>"
				   href="<?= base_url() ?>admin/feedback">Kelola Ulasan</a>
			</div>
		</div>
	</li>
	<li class="nav-item <?= $active_page === 'gallery' ? 'active' : '' ?>">
		<a class="nav-link <?= $active_page === 'gallery' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse"
		   data-target="#galleryListCollapse"
		   aria-expanded="true" aria-controls="galleryList">
			<i class="far fa-images"></i>
			<span>Galeri</span>
		</a>
		<div id="galleryListCollapse"
			 class="collapse <?= $active_page === 'gallery' ? 'show' : '' ?>"
			 aria-labelledby="galleryList" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $active_page === 'gallery' && isset($active_route) && $active_route === 'add' ? 'active' : '' ?>"
				   href="<?= base_url() ?>admin/gallery/add">Tambah Foto Galeri</a>
				<a class="collapse-item <?= $active_page === 'gallery' && !isset($active_route) ? 'active' : '' ?>"
				   href="<?= base_url() ?>admin/gallery">Kelola Galeri</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Charts -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Lainnya
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url() ?>admin/config">
			<i class="fas fa-fw fa-cog"></i>
			<span>Pengaturan</span></a>
	</li>

	<hr class="sidebar-divider d-none d-md-block">
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
	<!--	<div class="sidebar-card d-none d-lg-flex">-->
	<!--		<img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">-->
	<!--		<p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!-->
	<!--		</p>-->
	<!--		<a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>-->
	<!--	</div>-->

</ul>
