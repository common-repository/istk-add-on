<?php


//[istk_portfolio_category]
function istk_add_on_shortcode_production_category( $atts ){
	return istk_add_on_portfolio_category_panel();
}
add_shortcode( 'istk_portfolio_category', 'istk_add_on_shortcode_production_category' );


//[istk_portfolio_tags]
function istk_add_on_shortcode_production_tags( $atts ){
	return istk_add_on_portfolio_tag_list();
}
add_shortcode( 'istk_portfolio_tags', 'istk_add_on_shortcode_production_tags' );

//[istk_cta_contact]
function istk_add_on_shortcode_cta_contact( $atts ){
	if ( function_exists( 'istk_portfolio_button_contact_section' ) ) {
		ob_start();
		istk_portfolio_button_contact_section();
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
	}
	return;
}
add_shortcode( 'istk_cta_contact', 'istk_add_on_shortcode_cta_contact' );

//[istk_cta_download]
function istk_add_on_shortcode_cta_download( $atts ){
	if ( function_exists( 'istk_portfolio_button_download_section' ) ) {
		ob_start();
		istk_portfolio_button_download_section();
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
	}
	return;
}
add_shortcode( 'istk_cta_download', 'istk_add_on_shortcode_cta_download' );



