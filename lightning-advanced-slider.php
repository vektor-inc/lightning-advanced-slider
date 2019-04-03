<?php
/**
 * Plugin Name:     Lightning Advanced Slider
 * Plugin URI:      https://lightning.nagoya/
 * Description:
 * Author:          Vektor,Inc.
 * Author URI:      https://lightning.nagoya/
 * Text Domain:     lightning-advanced-slider
 * Domain Path:     /languages
 * Version:         0.0.0
 *
 * @package         Lightning_Advanced_Slider
 */

 /*
  ---------------------------------------------
	 updater
 --------------------------------------------- */
 require 'inc/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://lightning.nagoya/wp-content/vk-data-files/lightning-advanced-slider-73629846/plugin-update-config.json',
	__FILE__,
	'lightning-advanced-slider'
);


// Your code starts here.
define( 'VK_SLIDER_DIR', plugin_dir_path( __FILE__ ) );

// require_once( VK_SLIDER_DIR . 'inc/term-color-config.php' );
require_once( 'inc/config-swiper.php' );
require_once( 'inc/top-slide/top-slide.php' );
