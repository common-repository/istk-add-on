<?php

function istk_add_on_posttype_portfolio() {
	$args = array(
		'label'	=>	esc_html__( 'Portfolio', 'istk-add-on' ), //'制作事例',
		'labels'	=>	array(
			//'name'	=>	'portfolio',
			'singular_name'	=>	'Production',//制作例
			'all_items'	=>	esc_html__( 'Productions', 'istk-add-on' ), //'制作事例一覧',
		),
		'description'	=>	'',
		'public'	=>	true,
		'exclude_from_search'	=>	false,
		'menu_position'	=>	5,
		'menu_icon'	=>	'dashicons-format-gallery',
		'supports'	=>	array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'revisions',
		),
		'show_in_rest'	=>	true,
		//'register_meta_box_cb'
		'taxonomies'		=>	array( 'istk_portfolio_category', 'istk_portfolio_tag' ),
		'has_archive'	=>	true,
		'rewrite'	=>	array(
			'slug'	=>	'portfolio',
		),
		
	);
    register_post_type( 'istk_portfolio', $args );
}
add_action( 'init', 'istk_add_on_posttype_portfolio' );


function istk_add_on_posttype_news() {
	$args = array(
		'label'	=>	esc_html__( 'News', 'istk-add-on' ),
		'labels'	=>	array(
			//'name'	=>	'portfolio',
			//'singular_name'	=>	'portfolio2',
			'all_items'	=>	esc_html__( 'News', 'istk-add-on' ), //'お知らせ一覧',
		),
		'description'	=>	'',
		'public'	=>	true,
		'exclude_from_search'	=>	false,
		'menu_position'	=>	6,
		'menu_icon'	=>	'dashicons-info-outline',
		'supports'	=>	array(
			'title',
			'editor',
			'author',
			//'thumbnail',
			//'excerpt',
			//'trackbacks',
			//'custom-fields',
			'revisions',
		),
		'show_in_rest'	=>	true,
		//'register_meta_box_cb'
		//'taxonomies'		=>	array( 'istk_portfolio_category', 'istk_portfolio_tag' ),
		'has_archive'	=>	true,
		'rewrite'	=>	array(
			'slug'	=>	'news',
		),
		
	);
    register_post_type( 'istk_news', $args );
}
add_action( 'init', 'istk_add_on_posttype_news' );




function istk_add_on_regsiter_taxonomies() {
	
	//作品カテゴリ
	register_taxonomy(
		'istk_portfolio_category',
		'istk_portfolio',
		array(
			'labels'	=>	array(
				'name'	=>	esc_html__( 'Production Category', 'istk-add-on' ), //'作品カテゴリー',
				//'add_new_item'	=>	'新規作品カテゴリーを追加',
			),
			'public'	=>	true,
			'show_ui'	=>	true,
			'show_in_rest'	=>	true,
			'show_admin_column'	=>	true,
			'hierarchical'	=>	true,
			'rewrite'	=>	array(
				'slug'	=>	'portfolio_category',
			),
		)
	);
	
	
	//作品タグ
	register_taxonomy(
		'istk_portfolio_tag',
		'istk_portfolio',
		array(
			'labels'	=>	array(
				'name'	=>	esc_html__( 'Production Tag', 'istk-add-on' ), //'作品タグ',
				//'add_new_item'	=>	'新規作品タグを追加',
			),
			'public'	=>	true,
			'show_ui'	=>	true,
			'show_in_rest'	=>	true,
			'show_admin_column'	=>	true,
			'rewrite'	=>	array(
				'slug'	=>	'portfolio_tag',
			),
		)
	);
}
add_action( 'init', 'istk_add_on_regsiter_taxonomies' );






