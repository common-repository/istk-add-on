<?php get_header();
istk_portfolio_page_header();
?>
<div id="main-area">
	<div id="site-content"><main id="main" role="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<?php
$theme = wp_get_theme();
if( $theme->name == 'ISTK Portfolio' ) {
	if ( has_post_thumbnail() ) {
		$img_tag = get_the_post_thumbnail( $post->ID, 'istk_portfolio_head_img' );
	} else {
		$img_tag = '<img src="' .  get_stylesheet_directory_uri() . '/assets/images/no-image.png">';
	}
?>
	<div class="portfolio-main-image">
	<figure class="portfolio-main-img-frame"><?php echo $img_tag; ?></figure>
	<div class="blur-bg"><?php echo $img_tag; ?></div>
	</div>
<?php
}
?>

<div class="container wrap">
<?php
//get_template_part( 'content' );
?>
<article <?php post_class( 'main-article' ); ?> id="post-<?php the_ID(); ?>">
<header class="entry-header">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<?php
	istk_add_on_portfolio_categories();
	istk_add_on_portfolio_tags();
	?>
</header>
<div class="container main-article-contents">
    
<?php
if ( function_exists( 'istk_add_on_echo_data_table' ) ) {
	istk_add_on_echo_data_table();
}
?>
	
	
	<div class="contents"><?php the_content(); ?></div>
	
	<footer class="entry-footer">
		<?php
		if ( function_exists( 'istk_portfolio_post_date' ) ) {
			istk_portfolio_post_date();
		}
		istk_add_on_portfolio_categories();
		istk_add_on_portfolio_tags();
		?>
	</footer>
</div>
</article>
</div>



<?php endwhile; endif; ?>

	</main></div>
</div>
<?php get_footer(); ?>