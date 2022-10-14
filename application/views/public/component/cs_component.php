<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="floating-action-button">
	<?php if(isset($cs_phone)) : ?>
	<div class="item">
		<a href="tel:<?= $cs_phone ?>" target="_blank">
			<div class="icon" style="background: #F58F00">
				<img src="<?= base_url() ?>assets/image/icon/call.svg" alt="Icon"/>
			</div>
			<div class="title">
				<?= str_replace('+62', '0', $cs_phone) ?>
			</div>
		</a>
	</div>
	<?php endif; ?>
	<?php if(isset($cs_email)) : ?>
	<div class="item">
		<a href="mailto:<?= $cs_email ?>" target="_blank">
			<div class="icon" style="background: #669934">
				<img src="<?= base_url() ?>assets/image/icon/email.svg" alt="Icon"/>
			</div>
			<div class="title">
				<?= $cs_email ?>
			</div>
		</a>
	</div>
	<?php endif; ?>
	<?php if(isset($cs_wa)) : ?>
	<div class="item">
		<a href="https://wa.me/<?= $cs_wa ?>" target="_blank">
			<div class="icon" style="background: #1BD741">
				<img src="<?= base_url() ?>assets/image/icon/wa.svg" alt="Icon"/>
			</div>
			<div class="title">
				<?= str_replace('62', '0', $cs_wa) ?>
			</div>
		</a>
	</div>
	<?php endif; ?>
</div>
