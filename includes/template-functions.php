<?php

//istk portfolio用 タクソノミー出力
function istk_add_on_portfolio_categories() {
	global $post;
	$list = get_the_terms( $post->ID, 'istk_portfolio_category' );
	
	if( !empty( $list ) ) {
		echo '<div class="post-categories post-tax"><span class="dashicons dashicons-category" title="'
			. esc_html__( 'Production Category', 'istk-add-on' )
			. '"></span><span class="screen-reader-text">'
			. esc_html__( 'Production Category', 'istk-add-on' )
			. '</span><ul>';
		
		foreach ( $list as $term ) {
			echo '<li><a href="' . get_term_link( $term->slug, 'istk_portfolio_category' ) . '">' . $term->name . '</a></li>';
		}
		
		echo  '</ul></div>';
	}
}
function istk_add_on_portfolio_tags() {
	global $post;
	$list = get_the_terms( $post->ID, 'istk_portfolio_tag' );
	
	if( !empty( $list ) ) {
		echo '<div class="post-tags post-tax"><span class="dashicons dashicons-tag" title="'
			. esc_html__( 'Production Tag', 'istk-add-on' )
			. '"></span><span class="screen-reader-text">'
			. esc_html__( 'Production Tag', 'istk-add-on' )
			. '</span><ul>';
		
		foreach ( $list as $term ) {
			echo '<li><a href="' . get_term_link( $term->slug, 'istk_portfolio_tag' ) . '">' . $term->name . '</a></li>';
		}
		
		echo  '</ul></div>';
	}
}



//全体の作品タグ一覧
function istk_add_on_portfolio_tag_list() {
	$tagcloud = wp_tag_cloud( array(
		'taxonomy'	=>	'istk_portfolio_tag',
		'orderby'	=>	'count',
		'order'	=>	'DESC',
		'echo'	=>	0,
		'format'	=>	'flat',
		'largest'	=>	18,
		'smallest'	=>	11,
	));
	return $tagcloud;
}



//フロントページにnews出力
function istk_add_on_news_list() {
	if ( ! post_type_exists( 'istk_news' ) ) { return; }
	
	//出力しない設定//後で
	$post_type_obj = get_post_type_object( 'istk_news' ); 
	$posts_per_page = 5;
	$the_query = new WP_Query(array(
		'post_type'	=>	'istk_news',
		'posts_per_page'	=>	$posts_per_page,
		'post_status'	=>	'published',
	));

	if ( $the_query->have_posts() ) {
		$all_num = $the_query->found_posts;
		
		?><section class="news"><div class="container">
		<h1><?php echo $post_type_obj->labels->name; ?></h1>
		<ul class="content-list-news">
		
		<?php
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			?>
			<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<span class="date"><time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date(); ?></time></span>
				<a href="<?php the_permalink(); ?>" class="title_str"><?php the_title(); ?></a>
			</li>
			<?php
		}
		wp_reset_postdata();
		
		?></ul>
		<?php
		if ( ( $all_num > $posts_per_page ) && ( get_post_type_archive_link( 'istk_news' ) ) ) {
			echo '<div class="wp-block-button is-style-outline aligncenter"><a href="' . get_post_type_archive_link( 'istk_news' ) . '" class="wp-block-button__link">' . $post_type_obj->labels->all_items . '</a>';
		}
		?>
		</div></section><?php
	}
}


function istk_add_on_posttype_title() {
	//istk_portfolio_posttype_titleから移植
	/*
		デフォルト→post-typeの設定
		自力の設定があればそうする→テーマ設定かadmin設定ページで変更//あとで作る
		なければportfolioとかでいいか。
	*/
	$post_type = 'istk_portfolio';
	if ( post_type_exists( $post_type ) ) {
		$post_type_obj = get_post_type_object( $post_type );
		return $post_type_obj->label;
	} else {
		return esc_html__( 'Portfolio', 'istk-add-on' );
	}


}





function istk_add_on_portfolio_category_panel() {
	//作品カテゴリのパネル表示
	$category = 'istk_portfolio_category';
	
	//作品カテゴリ一覧を取得
	$args = array(
		'orderby'       => 'slug', 
		//'order'         => 'ASC',
		//'hide_empty'    => true, 
		//'exclude'       => array(), 
		//'exclude_tree'  => array(), 
		//'include'       => array(),
		//'number'        => '', 
		//'fields'        => 'all', 
		//'slug'          => '', 
		//'parent'        => '',
		//'hierarchical'  => true, 
		//'child_of'      => 0, 
		//'childless'     => false,
		//'get'           => '', 
		//'name__like'    => '',
		//'description__like' => '',
		//'pad_counts'    => false, 
		//'offset'        => '', 
		//'search'        => '', 
		//'cache_domain'  => 'core'
	);
	$terms = get_terms( $category, $args );
	
	
	if ( !empty( $terms ) ) {
		ob_start();
		echo '<ul class="portfolio-categories count' . count( $terms ) . '">';
		
		foreach ( $terms as $term ) {
			$img_id = get_term_meta( $term->term_id, 'istk_add_on_category_image_id', 1 );
			$img = '';
			if ( !empty( $img_id ) ) {
				$img = wp_get_attachment_image( $img_id, 'medium' );
			}
			$url = get_term_link( $term->term_id );
			//$term->name//名前
			
			echo '<li><a href="' . get_term_link( $term->term_id ) . '">'
				. $img
				. '<div class="title"><span>' . $term->name . '</span></div>'
				. '</a></li>';
			
		}
		
		echo '</ul>';
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
	}
	return false;
}



function istk_add_on_portfolio_category_panel_in_cta() {
	//フッタ前に表示
	
	//もし設定でONになってたら
	$setting = get_option( 'istk_add_on_portfolio_category_display_footer', 1 );
	if ( empty( $setting ) ) {
		return false;
	}
	
	//フロントページでは出すかどうかの設定
	$front = get_option( 'istk_add_on_portfolio_category_display_footer_in_front', 1 );
	if ( is_front_page() && !empty( $front ) ) {
		return false;
	}
	
	//タイトル
	$title = 'カテゴリ別 制作例';
	$title_op = get_option( 'istk_add_on_portfolio_category_title' );
	if ( !empty( $title_op ) ) {
		$title = $title_op;
	}
	
	echo '<section class="istk-cta category_panel"><div class="container">'
		. '<h1>' . $title . '</h1>'
		. istk_add_on_portfolio_category_panel()
		. '</div></section>';
}
add_filter( 'istk_portfolio_cta', 'istk_add_on_portfolio_category_panel_in_cta', 5 );



/* */
