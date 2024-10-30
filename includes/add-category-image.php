<?php
//istk_portfolio_category カテゴリイメージの登録フォーム


function istk_add_on_img_uplaoad_js() {
	//アップロードjs読み込み
	wp_enqueue_script( 'jquery' );
	wp_enqueue_media();

	//ファイルアップローダjs 個別設定(form)で使用
	wp_register_script( 'istk_add_on_img_upload', ISTK_ADDON__PLUGIN_DIR_URL . '/assets/upload_category_image.js', array( 'jquery' ) );
		//jsの翻訳対応
	$translation_array = array(
		'chooseFile'	=>	esc_html__( 'Choose File', 'istk-add-on' ),
		'chooseThumbnail'	=>	esc_html__( 'Choose Thumbnail', 'istk-add-on' ),
	);
	wp_localize_script( 'istk_add_on_img_upload', 'istk_add_on_transrate', $translation_array );
	wp_enqueue_script( 'istk_add_on_img_upload' );
}
add_action( 'admin_init', 'istk_add_on_img_uplaoad_js' );


function istk_add_on_add_category_image() {
	//フォーム表示（カテゴリ新規）
	?>
	<div class="form-field istk_add_on_category_image">
		<label><?php esc_html_e( 'Category image', 'istk-add-on' ); ?></label>
		<span id="istk_add_on_category_image_thumb"></span>
		<input type="hidden" name="istk_add_on_category_image_id" id="istk_add_on_category_image_id" value="">
		<input class="button" id="istk_add_on_category_image_upload" type="button" value="<?php esc_html_e( 'Upload image', 'istk-add-on' ); ?>">
		<input class="button" id="istk_add_on_category_image_delete" type="button" value="<?php esc_html_e( 'Delete', 'istk-add-on' ); ?>">
	</div>
	<?php
}
add_action( 'istk_portfolio_category_add_form_fields', 'istk_add_on_add_category_image' );


// add_term_meta


function istk_add_on_edit_term_fields( $tag ) {
	//フォーム表示（カテゴリ編集）
	$value = get_term_meta( $tag->term_id, 'istk_add_on_category_image_id', 1 );
	$img = '';
	if ( !empty( $value ) ) {
		$img = wp_get_attachment_image( $value, 'medium' );
	}
	
	?>
	<tr class="form-field istk_add_on_category_image">
		<th><label><?php esc_html_e( 'Category image', 'istk-add-on' ); ?></label></th>
		<td>
			<span id="istk_add_on_category_image_thumb"><?php echo $img; ?></span>
			<input type="hidden" name="istk_add_on_category_image_id" id="istk_add_on_category_image_id" value="<?php echo $value; ?>">
			<input class="button" id="istk_add_on_category_image_upload" type="button" value="<?php esc_html_e( 'Upload image', 'istk-add-on' ); ?>">
			<input class="button" id="istk_add_on_category_image_delete" type="button" value="<?php esc_html_e( 'Delete', 'istk-add-on' ); ?>">
		</td>
	</div>
	<?php
}
add_action( 'istk_portfolio_category_edit_form_fields', 'istk_add_on_edit_term_fields');


//nonceはつけたほうがいい？


//保存
function istk_add_on_save_category_image( $term_id ) {
	if ( array_key_exists( 'istk_add_on_category_image_id', $_POST ) ) {
		update_term_meta( $term_id, 'istk_add_on_category_image_id', sanitize_text_field( $_POST['istk_add_on_category_image_id'] ) );
	}
}
add_action( 'create_term', 'istk_add_on_save_category_image' );
add_action( 'edit_terms', 'istk_add_on_save_category_image' );



