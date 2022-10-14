let priceBlinked = false;
let showRecommendation = localStorage.getItem("showRecommendation") === 'false';
let alert = $('.alert');

var _Hasync = _Hasync || [];
_Hasync.push(['Histats.start', '1,4659040,4,111,175,25,00011111']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);

(function () {
	var hs = document.createElement('script');
	hs.type = 'text/javascript';
	hs.async = true;
	hs.src = ('');
	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();

const swiperCarousel = new Swiper('.carousel .swiper', {
	// Optional parameters
	direction: 'horizontal',
	loop: true,
	// autoplay: {
	//     delay: 3000
	// },
	speed: 400,
	effect: 'slide',
	pagination: {
		el: '.carousel .swiper-pagination',
		clickable: true,
	},
	navigation: {
		nextEl: '.carousel .arrow.next',
		prevEl: '.carousel .arrow.prev',
	},
});

const goTop = () => {
	window.scrollTo(0, 0)
}

const onCloseAlert = () => {
	$('#promoted_video')[0].pause();
	$('#promoted_video')[0].currentTime = 0;
	alert.fadeOut();
}

const onShowAlert = (url) => {
	$('#promoted_video').attr('src', url)  ;
	$('#promoted_video')[0].play()
	if ($('#promoted_video')[0].play()) {
		$('#promoted_video')[0].play().then(function() {
			alert.fadeIn();
		}).catch(function(error) {
			console.log(error);
		});
	}

}
const toggleRecommendation = () => {
	if (!showRecommendation) {
		$('.floating-recommendation').addClass('opened');
	} else {
		$('.floating-recommendation').removeClass('opened');
	}
	showRecommendation = !showRecommendation;
	localStorage.setItem('showRecommendation', showRecommendation);
}

$(window).scroll(function (event) {
	const pos = $(window).scrollTop();
	if (pos > 20) {
		$('.header').addClass('scrolled');
	} else {
		$('.header').removeClass('scrolled');
	}
});

setInterval(() => {
	if (priceBlinked) {
		$('.floating-recommendation .price').fadeIn();
	} else {
		$('.floating-recommendation .price').fadeOut();
	}
	priceBlinked = !priceBlinked;
}, 250)

const filterPackageShowcase = (filter) => {
	$(".package-body .package-showcase").isotope({
		itemSelector: '.package-showcase-item',
		layoutMode: "masonry",
		filter: '.' + (filter ?? 'package-showcase-item'),
		transitionDuration: '0.5s'
	});
}

const initScrollSpy = () => {
	let section = document.querySelectorAll("body");
	let sections = {};
	let i = 0;

	Array.prototype.forEach.call(section, function (e) {
		sections[e.id] = e.offsetTop;
	});

	window.onscroll = function () {
		let scrollPosition = document.documentElement.scrollTop + 224 || document.body.scrollTop;

		for (i in sections) {
			if (sections[i] <= scrollPosition) {
				$('.header .menu .item').removeClass('active');
				$('.header .menu .item.' + i).addClass('active');
			}
		}
	};
}


const initFeedbackSlider = () => {
	let owl = $(".feedback-list");
	owl.owlCarousel({
		loop: true,
		dots: false,
		// slideTransition: '',
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 300,
		responsive: {
			0: {
				items: 1
			},
			1366: {
				items: 3
			},
			1440: {
				items: 3
			},
			1920: {
				items: 2
			}
		}
	});
	$(".owl-prev").click(function () {
		owl.trigger('next.owl.carousel');
	})
}

const initPreloader = () => {
	$(".preloader").delay(500).fadeOut();
}


const initThumbnailSlider = () => {
	let owl = $(".thumbnail-list");
	owl.owlCarousel({
		loop: true,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 300,
		// slideTransition: '',
		responsive: {
			0: {
				items: 1
			},
			1366: {
				items: 1
			},
			1440: {
				items: 1
			},
			1920: {
				items: 1
			}
		}
	});
}

const initDatatable = () => {
	$('#datatable').DataTable({
		"language": {
			"lengthMenu": "_MENU_ baris per halaman",
			"zeroRecords": "Data tidak ditemukan",
			"info": "Halaman ke _PAGE_ dari _PAGES_",
			"infoEmpty": "Tidak ada data",
			"search": "Cari : ",
			"paginate": {
				"first":      "Awal",
				"last":       "Akhir",
				"next":       "Lanjut",
				"previous":   "Kembali"
			},
		}
	});
}
const initSmallThumbnailList = () => {
	let owl = $(".small-thumbnail-list");
	owl.owlCarousel({
		loop: true,
		dots: false,
		margin: 16,
		// slideTransition: '',
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 300,
		responsive: {
			0: {
				items: 4
			},
			1366: {
				items: 8
			},
			1440: {
				items: 10
			},
			1920: {
				items: 12
			}
		}
	});
}

const initTab = () => {
	$('.tab-component .tab-list .tab-item').click(function(){
		let target =$(this).data("target")

		if(!$(this).hasClass('active')){ //this is the start of our condition
			$('.tab-component .tab-list .tab-item').removeClass('active');
			$(this).addClass('active');

			console.log(target);
			$('.tab-container > div').hide();
			$(target).fadeIn('slow');
		}
	});
}

$('.package-list-item').on("click", function () {
	let selector;
	if ($(this).hasClass('active')) {
		$(".package-list-item").removeClass("active");
	} else {
		$(".package-list-item").removeClass("active");
		$(this).addClass("active");
		selector = $(this).attr("data-filter");
	}
	filterPackageShowcase(selector);
});

$('#hamburger').on("click", function () {
	if (this.checked) {
		$('.header').addClass('opened');
	} else {
		$('.header').removeClass('opened');
	}

});

$('#back').on("click", function () {
	history.back();
});


$(document).ready(function () {
	initPreloader();
	filterPackageShowcase();
	initFeedbackSlider();
	initThumbnailSlider();
	initScrollSpy();
	initSmallThumbnailList();
	initDatatable();
	initTab();
	toggleRecommendation();
});
