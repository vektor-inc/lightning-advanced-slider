<?php
/**
 * Plugin Name:     Lightning Advanced Slider
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     lightning-advanced-slider
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Lightning_Advanced_Slider
 */

// Your code starts here.
define( 'VK_SLIDER_DIR', plugin_dir_path( __FILE__ ) );

// require_once( VK_SLIDER_DIR . 'inc/term-color-config.php' );
require_once( 'inc/config-swiper.php' );

/*
標準のスライドショーをオフにする。
スライドショーに登録されている枚数で判断しているので false で返すと表示されなくなる
 */
function las_kill_lightning_top_slide_count() {
	return false;
}
add_filter( 'lightning_top_slide_count', 'las_kill_lightning_top_slide_count' );

// スライドショーを出力
function las_front_page_slide() {
	if ( ! is_front_page() ) {
		return false;
	}
	require_once( 'module_slide.php' );
}
add_action( 'lightning_header_after', 'las_front_page_slide' );
