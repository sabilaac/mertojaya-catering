<?php
defined('BASEPATH') or exit('No direct script access allowed');
$title = null;
$full_name = null;
$date = null;
$thumbnail = null;
$content = null;
$tags = null;
if (isset($article_detail)) {
	$title = isset($article_detail->title) ? $article_detail->title : '(Tidak ada Judul)';
	$full_name = isset($article_detail->full_name) ? $article_detail->full_name : '(Tidak ada Nama)';
	$date = isset($article_detail->date_created) ? $article_detail->date_created : null;
	$thumbnail = isset($article_detail->thumbnail) ? $article_detail->thumbnail : null;
	$content = isset($article_detail->content) ? $article_detail->content : null;
	$tags = isset($article_detail->category_tag) ? $article_detail->category_tag : array();
}
?>
<?php $this->load->view('public/component/head',array('title' => $title)); ?>
<body>
<?php $this->load->view('public/component/preloader'); ?>
<?php $this->load->view('public/component/header'); ?>
<section id="detail-article-page" class="detailed-page">
	<div class="container">
		<?php $this->load->view('public/component/breadcrumb'); ?>
		<div class="content-wrapper">
			<div>
				<h4>
					<?= $title ?>
				</h4>
				<div class="info">
					<div class="description">
						<div>
							<img src="<?= base_url() ?>assets/image/icon/user.svg" alt="Icon"/>
							<small>
								<?= $full_name ?>
							</small>
						</div>
						<div>
							<img src="<?= base_url() ?>assets/image/icon/date.svg" alt="Icon"/>
							<small>
								<?= date("l, d F Y", strtotime($date)); ?>
							</small>
						</div>
					</div>
					<img src="<?= base_url() ?>assets/image/icon/dummy-share.jpg" alt="Icon"/>
				</div>
			</div>
		</div>
		<div class="content-wrapper">
			<div class="content">
				<div class="thumbnail">
					<img src="<?= base_url() . 'image/' . $thumbnail ?>" alt="Thumbnail"/>
				</div>
				<?= $content ?>
				<div class="separator"></div>
				<?php $this->load->view('public/component/tags_component', array('data' => $tags)); ?>
			</div>
			<div class="related">
				<div class="related-list">
					Artikel Terkait
					<?php if (isset($article_related)) : ?>
						<?php foreach ($article_related as $i => $item) : ?>
							<a href="<?= base_url() . 'article?url=' . $item->url ?>">
								<div class="related-list-item">
									<div class="thumbnail">
										<img src="<?= base_url() . 'image/' . $thumbnail ?>"
											 alt="Thumbnail"/>
									</div>
									<div>
										<span class="ellipsis">
											<?= $item->title ?>
										</span>
										<small class="ellipsis">
											<?= strip_tags($item->content) ?>
										</small>
									</div>
								</div>
							</a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('public/component/cs_component'); ?>
<?php $this->load->view('public/component/floating-recommendation-component', array('data' => array('data_list' => $package_recommendation_list))); ?>
<?php $this->load->view('public/component/footer'); ?>
<?php $this->load->view('public/component/foot'); ?>
