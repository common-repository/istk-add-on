<?php


//テンプレート選択

function istk_add_on_add_template( $template ) {
	
	//テーマファイル内に$singleがなければプラグインで用意したやつを使用
	$single = '';
	if ( 'istk_portfolio' === get_post_type() ) {
		$single = 'single-istk_portfolio.php';		
	}
	
	if( is_singular() ) {
		if ( ( !empty( $single ) ) && !file_exists( get_stylesheet_directory() . '/' . $single ) ) {
			$template = ISTK_ADDON__PLUGIN_DIR . '/templates/' . $single;
		}
	}
	return $template;
}
add_filter( 'template_include', 'istk_add_on_add_template' );
