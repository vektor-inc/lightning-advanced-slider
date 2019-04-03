<?php
// Set version number.
define( 'VK_SWIPER_VERSION', '0.0.0' );

if ( ! class_exists( 'Vk_Swiper' ) ) {

	class Vk_Swiper {

		static function init() {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_swiper' ) );
		}

		public static function load_swiper() {
			global $vk_swiper;
			wp_enqueue_style( 'swiper-style', $vk_swiper['url'] . 'dist/css/swiper.min.css', '', VK_SWIPER_VERSION );
			wp_enqueue_script( 'swiper-js', $vk_swiper['url'] . 'dist/js/swiper.min.js', array(), VK_SWIPER_VERSION, true );
			$tag     = '';
				$tag = "
				var swiper = new Swiper('.swiper-container', {
					spaceBetween: 30,
					loop:true,
					autoplay: {
						delay: 2500,
						disableOnInteraction: false,
					},
					effect: 'flip',
					// slide / fade / cube / coverflow / flip
					pagination: {
						el: '.swiper-pagination',
						clickable: true,
					},
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
				});
				";

			wp_add_inline_script( 'swiper-js', $tag, 'after' );
		}

	}
	Vk_Swiper::init();

}
