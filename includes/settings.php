<?php
//プラグインの設定ページ

//サブメニュー登録
function istk_add_on_register_setting_page(){
	add_submenu_page(
		'options-general.php',
		esc_html__( 'ISTK Portfolio Settings', 'istk-add-on' ),
		esc_html__( 'ISTK Portfolio Settings', 'istk-add-on' ),
		'manage_options',
		'istk_add_on_setting',
		'istk_add_on_setting_page_display',
	);
}
add_action( 'admin_menu', 'istk_add_on_register_setting_page' );


//フォームのガワ
function istk_add_on_setting_page_display() {
	include( ISTK_ADDON__PLUGIN_DIR . 'views/settings.php' );
}



//つけたいもの
/*

portfolioデータの後の説明書き
作品カテゴリのショートコード
作品カテゴリをcta部に出すかどうか
	出す場合はタイトル
	フロントページはむし

*/
function istk_add_on_add_settings_init() {
	$group_name = 'istk_add_on_setting';
	
	
	add_settings_section(
		'istk_add_on_setting_section_cta',
		esc_html__( 'Portfolio category panel', 'istk-add-on' ), //'作品カテゴリパネル',
		'istk_add_on_setting_section_cta_header',
		$group_name
	);
	
	//cta フッタ前に出すかどうか
	add_settings_field(
		'istk_add_on_portfolio_category_display_footer',
		esc_html__( 'Display before the site footer or not', 'istk-add-on' ), //'フッタ前に出すかどうか',
		'istk_add_on_portfolio_category_display_footer_display',
		$group_name,
		'istk_add_on_setting_section_cta',
		//array( 'label_for' => 'myprefix_setting-id' )
	);
	register_setting(
		$group_name,
		'istk_add_on_portfolio_category_display_footer',
		'sanitize_text_field'
	);
	//cta フロントページでは無視
	add_settings_field(
		'istk_add_on_portfolio_category_display_footer_in_front',
		esc_html__( 'Exclude front page', 'istk-add-on' ), //'フロントページ例外',
		'istk_add_on_portfolio_category_display_footer_in_front_display',
		$group_name,
		'istk_add_on_setting_section_cta',
	);
	register_setting(
		$group_name,
		'istk_add_on_portfolio_category_display_footer_in_front',
		'sanitize_text_field'
	);
	//cta タイトル
	add_settings_field(
		'istk_add_on_portfolio_category_title',
		esc_html__( 'Title', 'istk-add-on' ), //'タイトル',
		'istk_add_on_portfolio_category_title_display',
		$group_name,
		'istk_add_on_setting_section_cta',
	);
	register_setting(
		$group_name,
		'istk_add_on_portfolio_category_title',
		'sanitize_text_field'
	);
	
	//-------------
	
	
	add_settings_section(
		'istk_add_on_setting_section_shortcodes',
		esc_html__( 'Shortcodes', 'istk-add-on' ), //'ショートコード',
		'istk_add_on_setting_section_shortcodes_header',
		$group_name
	);
	//cta カテゴリのショートコード
	add_settings_field(
		'istk_add_on_portfolio_category_shortcode',
		esc_html__( 'Portfolio category panel', 'istk-add-on' ), //'カテゴリパネル',
		'istk_add_on_portfolio_category_shortcode_display',
		$group_name,
		'istk_add_on_setting_section_shortcodes',
	);
	//タグクラウドのショートコード
	add_settings_field(
		'istk_add_on_portfolio_tag_shortcode',
		esc_html__( 'Portfolio tag cloud', 'istk-add-on' ), //'作品タグクラウド',
		'istk_add_on_portfolio_tag_shortcode_display',
		$group_name,
		'istk_add_on_setting_section_shortcodes',
	);
	//cta コンタクトのショートコード
	add_settings_field(
		'istk_add_on_portfolio_contact_shortcode',
		esc_html__( 'Action button area for contact', 'istk-add-on' ), //'問い合わせフォームへの誘導ボタン',
		'istk_add_on_portfolio_contact_shortcode_display',
		$group_name,
		'istk_add_on_setting_section_shortcodes',
	);
	//cta ダウンロードのショートコード
	add_settings_field(
		'istk_add_on_portfolio_download_shortcode',
		esc_html__( 'Action button area for download', 'istk-add-on' ), //'資料ダウンロードへの誘導ボタン',
		'istk_add_on_portfolio_download_shortcode_display',
		$group_name,
		'istk_add_on_setting_section_shortcodes',
	);
	
	
	
	//-------------
	
	add_settings_section(
		'istk_add_on_setting_section_portfolio',
		esc_html__( 'Portfolio page', 'istk-add-on' ), //'ポートフォリオページ',
		'istk_add_on_setting_section_portfolio_header',
		$group_name
	);
	add_settings_field(
		'istk_add_on_portfolio_data_description',
		esc_html__( 'Description after the data table', 'istk-add-on' ), //'データのあとの説明文',
		'istk_add_on_portfolio_data_description_display',
		$group_name,
		'istk_add_on_setting_section_portfolio',
		//array( 'label_for' => 'myprefix_setting-id' )
	);
	register_setting(
		$group_name,
		'istk_add_on_portfolio_data_description',
		'wp_filter_post_kses'
	);
	
}
add_action( 'admin_init', 'istk_add_on_add_settings_init' );



function istk_add_on_setting_section_cta_header( $arg ) {
	//作品カテゴリパネルの表示設定
	echo '<p>' . esc_html__( 'Portfolio category panel display setting', 'istk-add-on' ) . '</p>';
}

function istk_add_on_portfolio_category_display_footer_display() {
	$id = 'istk_add_on_portfolio_category_display_footer';
	echo '<input name="' . $id . '" id="' .$id . '" type="checkbox" value="1" class="code" ' . checked( 1, get_option( $id, 1 ), false ) . ' /> ' . esc_html__( 'If it is checked, portfolio category panel is displayed before action button area.', 'istk-add-on' );
	//チェックするとアクションボタンエリアの前にカテゴリを出します
}

function istk_add_on_portfolio_category_display_footer_in_front_display () {
	//カテゴリパネル フロントページ例外
	$id = 'istk_add_on_portfolio_category_display_footer_in_front';
	echo '<input name="' . $id . '" id="' .$id . '" type="checkbox" value="1" class="code" ' . checked( 1, get_option( $id, 1 ), false ) . ' /> ' . esc_html__( 'If it is checked, portfolio category panel is not displayed in front page.', 'istk-add-on' );
	//チェックするとフロントページでは自動表示をしません
}
function istk_add_on_portfolio_category_title_display () {
	//カテゴリパネル タイトル
	$id = 'istk_add_on_portfolio_category_title';
	echo '<input name="' . $id . '" id="' . $id . '" type="text" value="' . get_option( $id ) . '" class="regular-text code">';
}



function istk_add_on_setting_section_shortcodes_header() {
	echo '<p>' .  esc_html__( 'You can use these shortcodes wherever you like.', 'istk-add-on' ) . '</p>';
	//これらのショートコードを好きな場所で使用できます。
}
function istk_add_on_portfolio_category_shortcode_display() {
	echo '<p>[istk_portfolio_category]</p><p>' .  esc_html__( 'This is not good for narrow spaces.', 'istk-add-on' ) . '</p>';
	//これは狭い場所には適しません。
}

function istk_add_on_portfolio_tag_shortcode_display() {
	echo '<p>[istk_portfolio_tags]</p>';
}

function istk_add_on_portfolio_contact_shortcode_display() {
	echo '<p>[istk_cta_contact]</p>';
	/* translators: テーマISTK Portfolioを使用しているときのみ有効です。 */
	echo '<p>' . esc_html__( 'This shortcode applies only when using the theme ISTK Portfolio.', 'istk-add-on' ) . '</p>';
}
function istk_add_on_portfolio_download_shortcode_display() {
	echo '<p>[istk_cta_download]</p>';
	/* translators: テーマISTK Portfolioを使用しているときのみ有効です。 */
	echo '<p>' . esc_html__( 'This shortcode applies only when using the theme ISTK Portfolio.', 'istk-add-on' ) . '</p>';
}





function istk_add_on_setting_section_portfolio_header( $arg ) {
	echo '<p>' . esc_html__( 'Settings for portfolio pages', 'istk-add-on' ) . '</p>';
	//制作事例ページの設定
}
function istk_add_on_portfolio_data_description_display() {
	$id = 'istk_add_on_portfolio_data_description';
	$str = get_option( $id );
	echo '<textarea name="' . $id . '" id="' . $id . '" class="regular-text code" rows="5">' . $str . '</textarea>';
	echo '<p>' . esc_html__( 'It is displayed after the data table. You can enter basic HTML tags.', 'istk-add-on' ) . '</p>';
	//データ表示テーブルの後にこの説明文を表示します。基本のHTMLタグは入力できます。
}




