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
		}

		public static function swiper_paras_json( $paras = '' ) {

			$default = array(
				'spaceBetween' => 30,
				'loop'         => true,
				'autoplay'     => array(
					'delay' => 4000,
				),
				'pagination'   => array(
					'el'        => '.swiper-pagination',
					'clickable' => true,
				),
				'navigation'   => array(
					'nextEl' => '.swiper-button-next',
					'prevEl' => '.swiper-button-prev',
				),
			);

			$paras = wp_parse_args( $paras, $default );
			$json  = json_encode( $paras );
			return $json;
		}

	}
	Vk_Swiper::init();

} // if ( ! class_exists( 'Vk_Swiper' ) ) {
