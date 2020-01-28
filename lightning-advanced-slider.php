<?php
/**
 * Plugin Name:     Lightning Advanced Slider
 * Plugin URI:      https://lightning.nagoya/
 * Description:     Lightning用の新しいスライダーの先行開発版です。スライダープラグインとして非常に評価の高いswiperを使用しています。標準のLightningではスライドエフェクトが「スライド」しか使えませんが、このプラグインを有効化すると 外観 > カスタマイズ 画面「Lighhtning スライドショー」パネルよりフェードなどが選択できるようになります。
 * Author:          Vektor,Inc.
 * Author URI:      https://lightning.nagoya/
 * Text Domain:     lightning-advanced-slider
 * Domain Path:     /languages
 * Version:         0.4.1
 *
 * @package         Lightning_Advanced_Slider
 */

 /*
---------------------------------------------
	updater
--------------------------------------------- */
require 'inc/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
'https://github.com/vektor-inc/lightning-advanced-slider',
__FILE__,
'lightning-advanced-slider'
);
$myUpdateChecker->setBranch( 'master' );

// Your code starts here.
define( 'VK_SLIDER_DIR', plugin_dir_path( __FILE__ ) );

/*
 ---------------------------------------------
	Plugin Theme Activation
--------------------------------------------- */
add_action( 'after_setup_theme', 'las_plugin_active' );
function las_plugin_active() {
	// テーマがLightning系じゃなかったら処理を終了
	if ( ! function_exists( 'lightning_get_theme_name' ) ) {
		return;
	} else {
		// swiperを利用する時の共通ライブラリ
		require_once 'inc/swiper/config-swiper.php';
		// Lightning 専用ファイルの読み込み
		require_once 'inc/top-slide/top-slide.php';
	}
}
