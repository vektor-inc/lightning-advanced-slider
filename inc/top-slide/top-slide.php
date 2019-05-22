<?php

/*
標準のスライドショーをオフにする。
スライドショーに登録されている枚数で判断しているので false で返すと表示されなくなる
 */
function las_kill_lightning_top_slide_count() {
	return false;
}
add_filter( 'lightning_top_slide_count', 'las_kill_lightning_top_slide_count' );

/*
	スライド本体読み込み
/*-------------------------------------------*/
require_once( 'top-slide-view.php' );

/*
	Lightningトップページにスライドを出力
/*-------------------------------------------*/
function las_front_page_slide() {
	if ( is_front_page() && function_exists( 'lightning_get_theme_options' ) ) {
		echo las_get_slide_html();
	}
}
add_action( 'lightning_header_after', 'las_front_page_slide' );

/*
	ショートコード
/*-------------------------------------------*/
add_shortcode( 'lightning_slide', 'las_get_slide_html' );


/*
	スライド用の js 設定値を出力
/*-------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'las_add_slide_script' );
function las_add_slide_script() {

	if ( function_exists( 'lightning_get_theme_options' ) ) {
		$lightning_theme_options = lightning_get_theme_options();
	} else {
		$lightning_theme_options = get_option( 'lightning_theme_options' );
	}

	$top_slide_count = lightning_top_slide_count( $lightning_theme_options );

	if ( $top_slide_count < 2 ) {
		$paras['loop'] = false;
	}

	if ( empty( $lightning_theme_options['top_slide_time'] ) ) {
		$paras['autoplay']['delay'] = 4000;
	} else {
		$paras['autoplay']['delay'] = esc_attr( $lightning_theme_options['top_slide_time'] );
	}

	if ( empty( $lightning_theme_options['top_slide_effect'] ) ) {
		$paras['effect'] = 'slide';
	} else {
		$paras['effect'] = esc_attr( $lightning_theme_options['top_slide_effect'] );
	}

	$swiper_paras = Vk_Swiper::swiper_paras_json( $paras );

	$tag = "var swiper = new Swiper('.swiper-container', " . $swiper_paras . ');';

	wp_add_inline_script( 'swiper-js', $tag, 'after' );
}

/*
	swiper用のカスタマイズ項目
/*-------------------------------------------*/
add_action( 'customize_register', 'las_customize_register_top_slide_swiper' );
function las_customize_register_top_slide_swiper( $wp_customize ) {
	// Slide interval time
	$wp_customize->add_setting(
		'lightning_theme_options[top_slide_effect]', array(
			'default'           => 'slide',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'top_slide_effect', array(
			'label'       => __( 'Slide effect', 'lightning-pro' ),
			'section'     => 'lightning_slide',
			'settings'    => 'lightning_theme_options[top_slide_effect]',
			'type'        => 'select',
			'choices'     => array(
				'slide'     => 'slide',
				'fade'      => 'fade',
				'cube'      => 'cube',
				'coverflow' => 'coverflow',
				'flip'      => 'flip',
			),
			'priority'    => 604,
			'description' => '',
			'input_after' => '',
		)
	);
}
