<?php
?>

<div class="responsive-handler">
	<div class="container">
		<lottie-player src="https://assets5.lottiefiles.com/packages/lf20_AQcLsD.json" loop
					   background="transparent" speed="1" style="width: 300px; height: 300px;"
					   autoplay></lottie-player>
		<h4>
			Mohon maaf,
		</h4>
		<small>
			Mertojaya Catering belum tersedia pada tampilan mobile. Silahkan untuk mengunjungi kami di PC atau komputer
			Anda
		</small>
		<button onclick="location.href = 'https://wa.me/<?= $cs_wa ?>'">
			<img src="<?= base_url() ?>assets/image/icon/wa.svg" alt="Icon"/>
			Hubungi Kami
		</button>
		<img src="<?= base_url() ?>assets/image/brand.jpg" alt="Brand"/>
	</div>

</div>

<script>
	function myFunction(x) {
		if (x.matches) { // If media query matches
			document.body.style.overflow = "hidden";
		} else {
			document.body.style.overflow = "auto";
		}
	}

	let x = window.matchMedia("(max-width: 768px)")
	myFunction(x) // Call listener function at run time
	x.addListener(myFunction) // Attach listener function on state changes
</script>
