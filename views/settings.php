<div class="wrap">
<h1 class="wp-heading-inline"><?php _e( 'ISTK Portfolio Settings', 'istk-add-on' ); ?></h1>

<div class="istk-ao-settings-row">

<div class="istk-ao-options">
<form method="post" action="options.php">
<?php
	settings_fields( 'istk_add_on_setting' );
	do_settings_sections( 'istk_add_on_setting' );
	submit_button();
?>
</form>
</div>

<div class="istk-ao-settings-side">
<!-- side -->
<div class="postbox">
<div class="postbox-header">
	<h2><span class="dashicons dashicons-welcome-learn-more"></span>ポートフォリオサイトの作り方</h2>
</div>
<div class="inside note">
	<p class="img"><a href="https://note.com/istkweb/n/n2fe11310988a?magazine_key=me7fde5ff3251"><img src="<?php echo ISTK_ADDON__PLUGIN_DIR_URL; ?>/assets/magazine-header.png" width="274" height="159" alt="WordPressでポートフォリオサイトを作る全手順"></a></p>
	<p>WordPressテーマ「いしつく!ポートフォリオ (ISTK Portfolio)」を使ってイラストレーターのポートフォリオを作る細かな手順を解説したnoteマガジン「<a href="https://note.com/istkweb/n/n2fe11310988a?magazine_key=me7fde5ff3251">WordPressでポートフォリオサイトの作り方徹底解説</a>」。</p>
	
	<p><strong>仕事の依頼の来る</strong>ポートフォリオサイトとは? 詳しい作り方を知りたい方におすすめです。</p>
	<a class="button button-primary button-hero" href="https://note.com/istkweb/n/n2fe11310988a?magazine_key=me7fde5ff3251">まえがきを読んでみる</a>
</div>
</div>



<div class="postbox">
<div class="postbox-header">
	<h2><span class="dashicons dashicons-info-outline"></span>いしつく! とは</h2>
</div>
<div class="inside note">
	<p>イラストレーターやクリエイターに向けて、仕事の依頼を増やすためにはポートフォリオサイトをどう作ればいいか、などをお伝えする情報サイトです。ぜひチェックしてください。</p>
		
	<ul>
		<li><span class="dashicons dashicons-admin-site-alt3"></span><a href="https://istkweb.com">いしつく!</a></li>
		<li><span class="dashicons dashicons-twitter"></span>Twitter <a href="https://twitter.com/istk_web">@istk_web</a></li>
	</ul>
</div>
</div>



<!--//side-->
</div>


</div>
</div><!--//.wrap-->