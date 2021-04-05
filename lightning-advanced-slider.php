<?php
/**
 * Plugin Name:     Lightning Advanced Slider
 * Plugin URI:      https://lightning.nagoya/
 * Description:     Lightning用の新しいスライダーの先行開発版です。スライダープラグインとして非常に評価の高いswiperを使用しています。標準のLightningではスライドエフェクトが「スライド」しか使えませんが、このプラグインを有効化すると 外観 > カスタマイズ 画面「Lighhtning スライドショー」パネルよりフェードなどが選択できるようになります。
 * Author:          Vektor,Inc.
 * Author URI:      https://lightning.nagoya/
 * Text Domain:     lightning-advanced-slider
 * Domain Path:     /languages
 * Version:         0.6.2
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
	$current_theme = get_template();
// テーマがLightning でも G3 だったら処理を終了
	if ( 'lightning' === $current_theme && 'g3' === get_option( 'lightning_theme_generation' ) ) {
		return;
	} elseif ( 'lightning' !== $current_theme && 'lightning-pro' !== $current_theme ) {
		return;
	} else {
		// swiperを利用する時の共通ライブラリ
		require_once 'inc/vk-swiper/config.php';
		// Lightning 専用ファイルの読み込み
		require_once 'inc/top-slide/top-slide.php';
	}
}


/**
 * 停止を勧告するメッセージ（国内向けにしか配布していないので翻訳なし）
 */
function las_get_notice_body(){

	$html = '<ul>';
	$html .= '<li>プラグイン「Lightning Advanced Slider」の機能は Lightning 及び VK Blocks Pro のスライダーブロックに実装済みにつきメンテナンスを終了しています。</li>';
	$html .= '<li><a href="' . admin_url() . 'plugins.php' . '" target="_blank">プラグイン画面</a>で「Lightnig Advanced Slider」を停止してください。</li>';
	$html .= '<li>停止して問題のある機能・要望がある場合については<a href="https://vws.vektor-inc.co.jp/forums" target="_blank">フォーラム</a>に投稿ください。</li>';
	$html .= '</ul>';
	return $html;
}

/**
 * ダッシュボードにメッセージを表示
 */
function las_add_admin_notice(){
	global $pagenow;
	if ( $pagenow != 'index.php' || ! current_user_can( 'administrator' ) ) {
		return;
	}
	$html = '';
	$html .= '<div class="error">';
	$html .= las_get_notice_body();
	$html .= '</div>';

	echo $html;
}
add_action( 'admin_notices', 'las_add_admin_notice' );

/**
 * プラグイン一覧にメッセージを表示
 */
function las_add_plugin_notice( $plugin_file, $plugin_data, $status ){
	echo '<tr class="active"><th class="check-column"></th><td colspan="2"><div class="vk-plugin-list-notice">' . las_get_notice_body() .  '</div><td></</tr>';
}
add_action( 'after_plugin_row_lightning-advanced-slider/lightning-advanced-slider.php', 'las_add_plugin_notice', 10, 3 );

/**
 * 管理画面用のCSS調整
 */
function las_add_admin_notice_style() {
	echo '<style>
	.plugins tr[data-slug=lightning-advanced-slider] th,
	.plugins tr[data-slug=lightning-advanced-slider] td { box-shadow:none; }
	.vk-plugin-list-notice {
		border:1px solid #ccc;
		padding:0 1em;
		background-color:#fff;
	}
	</style>'.PHP_EOL;
  }
  add_action('admin_print_styles', 'las_add_admin_notice_style');
