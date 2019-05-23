<?php

function las_get_slide_html() {

	$lightning_theme_options = lightning_get_theme_options();

	// count top slide
	$top_slide_count_max = lightning_top_slide_count_max();
	$top_slide_count     = lightning_top_slide_count( $lightning_theme_options );
	// $top_slide_count     = apply_filters( 'lightning_top_slide_count', $top_slide_count );
	$top_slide_html = '';

	if ( $top_slide_count ) {

		$top_slide_html .= '<div class="swiper-container slide">';
		$top_slide_html .= '<div class="swiper-wrapper slide-inner">';

		// Why end point is $top_slide_count_max that not $top_slide_count, image exist 1,2,5
		for ( $i = 1; $i <= $top_slide_count_max;$i++ ) {

			$top_slide_url = '';

			// If Alt exist
			$top_slide_alt = '';
			if ( ! empty( $lightning_theme_options[ 'top_slide_alt_' . $i ] ) ) {
				$top_slide_alt = $lightning_theme_options[ 'top_slide_alt_' . $i ];
			} elseif ( ! empty( $lightning_theme_options[ 'top_slide_title_' . $i ] ) ) {
				$top_slide_alt = $lightning_theme_options[ 'top_slide_title_' . $i ];
			} else {
				$top_slide_alt = '';
			}

			// Slide Display
			if ( ! empty( $lightning_theme_options[ 'top_slide_image_' . $i ] ) ) {
				$link_target = ( isset( $lightning_theme_options[ 'top_slide_link_blank_' . $i ] ) && $lightning_theme_options[ 'top_slide_link_blank_' . $i ] ) ? ' target="_blank"' : '';

				// 画像１つのdiv
				$top_slide_html .= '<div class="swiper-slide item-' . $i . '">';

				if ( lightning_is_slide_outer_link( $lightning_theme_options, $i ) ) {

					$top_slide_html .= '<a href="' . esc_url( $lightning_theme_options[ 'top_slide_url_' . $i ] ) . '"' . $link_target . '>';
				}

				$top_slide_html .= '<picture>';

					// If Mobile Image exist
				if ( ! empty( $lightning_theme_options[ 'top_slide_image_mobile_' . $i ] ) ) {
					  $top_slide_html .= '<source media="(max-width: 767px)" srcset="' . esc_attr( $lightning_theme_options[ 'top_slide_image_mobile_' . $i ] ) . '">';
				}

				$top_slide_html .= '<img src="' . esc_attr( $lightning_theme_options[ 'top_slide_image_' . $i ] ) . '" alt="' . esc_attr( $top_slide_alt ) . '" class="slide-item-img">';
				$top_slide_html .= '</picture>';

				/*
				  slide-cover
				/*-------------------------------------------*/

				$cover_style = lightning_slide_cover_style( $lightning_theme_options, $i );

				if ( $cover_style ) {
					$cover_style     = ( $cover_style ) ? ' style="' . esc_attr( $cover_style ) . '"' : '';
					$top_slide_html .= '<div class="slide-cover"' . $cover_style . '></div>';
				}

				if ( lightning_is_slide_outer_link( $lightning_theme_options, $i ) ) {
					$top_slide_html .= '</a>';
				}

				/*
				  mini_content
				/*-------------------------------------------*/

				$mini_content_args['style_class']  = 'mini-content-' . $i;
				$mini_content_args['align']        = ( ! empty( $lightning_theme_options[ 'top_slide_text_align_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_text_align_' . $i ] : '';
				$mini_content_args['title']        = ( ! empty( $lightning_theme_options[ 'top_slide_text_title_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_text_title_' . $i ] : '';
				$mini_content_args['caption']      = ( ! empty( $lightning_theme_options[ 'top_slide_text_caption_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_text_caption_' . $i ] : '';
				$mini_content_args['text_color']   = ( ! empty( $lightning_theme_options[ 'top_slide_text_color_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_text_color_' . $i ] : '#333';
				$mini_content_args['link_url']     = ( ! empty( $lightning_theme_options[ 'top_slide_url_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_url_' . $i ] : '';
				$mini_content_args['link_target']  = ( ! empty( $lightning_theme_options[ 'top_slide_link_blank_' . $i ] ) ) ? ' target="_blank"' : '';
				$mini_content_args['btn_text']     = ( ! empty( $lightning_theme_options[ 'top_slide_text_btn_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_text_btn_' . $i ] : '';
				$mini_content_args['btn_color']    = ( ! empty( $lightning_theme_options[ 'top_slide_text_color_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_text_color_' . $i ] : '#337ab7';
				$mini_content_args['btn_bg_color'] = ( ! empty( $lightning_theme_options['color_key'] ) ) ? $lightning_theme_options['color_key'] : '#337ab7';
				$mini_content_args['shadow_use']   = ( ! empty( $lightning_theme_options[ 'top_slide_text_shadow_use_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_text_shadow_use_' . $i ] : false;
				$mini_content_args['shadow_color'] = ( ! empty( $lightning_theme_options[ 'top_slide_text_shadow_color_' . $i ] ) ) ? $lightning_theme_options[ 'top_slide_text_shadow_color_' . $i ] : '#fff';

				// lightning_mini_content( $mini_content_args );
				$style = '';
				if ( $mini_content_args['align'] ) {
					$style = ' style="text-align:' . esc_attr( $mini_content_args['align'] ) . '"';
				}

				$top_slide_html .= '<div class="slide-text-set mini-content ' . esc_attr( $mini_content_args['style_class'] ) . '"' . $style . '>';
				$top_slide_html .= '<div class="container">';

				$font_style = '';
				if ( $mini_content_args['text_color'] ) {
					$font_style .= 'color:' . $mini_content_args['text_color'] . ';';
				} else {
					$font_style .= '';
				}

				if ( $mini_content_args['shadow_use'] ) {
					if ( $mini_content_args['shadow_color'] ) {
						$font_style .= 'text-shadow:0 0 2px ' . $mini_content_args['shadow_color'];
					} else {
						$font_style .= 'text-shadow:0 0 2px #000';
					}
				}

				$font_style = ( $font_style ) ? ' style="' . esc_attr( $font_style ) . '"' : '';

							// If Text Title exist
				if ( $mini_content_args['title'] ) {

					$top_slide_html .= '<h3 class="slide-text-title"' . $font_style . '>';
					$top_slide_html .= nl2br( wp_kses_post( $mini_content_args['title'] ) );
					$top_slide_html .= '</h3>';

				}

					// If Text caption exist
				if ( $mini_content_args['caption'] ) {
					$top_slide_html .= '<div class="slide-text-caption"' . $font_style . '>';
					$top_slide_html .= nl2br( esc_textarea( $mini_content_args['caption'] ) );
					$top_slide_html .= '</div>';
				}

					// If Button exist
				if ( $mini_content_args['link_url'] && $mini_content_args['btn_text'] ) {
					// Shadow
					$box_shadow  = '';
					$text_shadow = '';
					if ( $mini_content_args['shadow_use'] ) {
						if ( $mini_content_args['shadow_color'] ) {
							$box_shadow  = 'box-shadow:0 0 2px ' . $mini_content_args['shadow_color'] . ';';
							$text_shadow = 'text-shadow:0 0 2px ' . $mini_content_args['shadow_color'] . ';';
						} else {
							$box_shadow  = 'box-shadow:0 0 2px #000;';
							$text_shadow = 'text-shadow:0 0 2px #000;';
						}
					}

					$style_class     = esc_attr( $mini_content_args['style_class'] );
					$top_slide_html .= '<style type="text/css">';
					$top_slide_html .= '.' . $style_class . ' .btn-ghost { border-color:' . $mini_content_args['text_color'] . ';color:' . $mini_content_args['text_color'] . ';' . $box_shadow . $text_shadow . ' }';
					$top_slide_html .= '.' . $style_class . ' .btn-ghost:hover { border-color:' . $mini_content_args['btn_bg_color'] . '; background-color:' . $mini_content_args['btn_bg_color'] . '; color:#fff; text-shadow:none; }';
					$top_slide_html .= '</style>';
					$top_slide_html .= '<a class="btn btn-ghost" href="' . esc_url( $mini_content_args['link_url'] ) . '"' . $mini_content_args['link_target'] . '>' . wp_kses_post( $mini_content_args['btn_text'] ) . '</a>';

				} // if ( $mini_content_args['link_url'] && $mini_content_args['btn_text'] ) {

				$top_slide_html .= '</div><!-- .container -->';
				$top_slide_html .= '</div><!-- [ /.slide-text-set.mini-content  ] -->';
				$top_slide_html .= '</div><!-- [ /.item ] -->';

			} // if ( $top_slide_image_src ) {
		} // for ( $i = 1; $i <= $top_slide_count_max;$i++ ) {

		$top_slide_html .= '</div><!-- [ /.swiper-wrapper ] -->';
		if ( $top_slide_count >= 2 ) {
			// Add Pagination
			$top_slide_html .= '<div class="swiper-pagination swiper-pagination-white"></div>';
			// Add Arrows
			$top_slide_html .= '<div class="swiper-button-next swiper-button-white"></div>';
			$top_slide_html .= '<div class="swiper-button-prev swiper-button-white"></div>';
		}

		$top_slide_html .= '</div><!-- [ /.swiper-container ] -->';

	} // if ( $top_slide_count ) {

	return $top_slide_html;

} // function las_get_slide_html(){
