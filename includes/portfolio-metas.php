<?php
//posttypeポートフォリオのメタボックス

function istk_add_on_portfolio_meta_list() {
	$field_list = array(
		//なまえ=>テキスト
		'media'	=>	esc_html__( 'Media Type', 'istk-add-on' ), //使用媒体
		'customer'	=>	esc_html__( 'Customer', 'istk-add-on' ), //発注元業種
		'amount'	=>	esc_html__( 'A Number of Order', 'istk-add-on' ), //受注点数
		'days'	=>	esc_html__( 'Days for Production', 'istk-add-on' ), //制作日数
		'tool'	=>	esc_html__( 'Tool', 'istk-add-on' ), //画材/使用機材
		'size'	=>	esc_html__( 'Size', 'istk-add-on' ), //サイズ
		'package'	=>	esc_html__( 'Delivery Form', 'istk-add-on' ), //納品形態
	);
	return $field_list;
}


function istk_add_on_add_meta_box( $post_type ) {
	if ( $post_type !== 'istk_portfolio' ) {
		return;
	}
	add_meta_box(
		'istk_add_on_portfolio_metas',
		esc_html__( 'Metas', 'istk-add-on' ),
		'istk_add_on_render_meta_box',
		$post_type,
		'advanced',
		'high'
	);
}
add_action( 'add_meta_boxes', 'istk_add_on_add_meta_box' );


function istk_add_on_save_portfolio_metas( $post_id ) {
	//保存

	if ( ! isset( $_POST['istk_add_on_portfolio_meta_nonce'] ) ) {
		return $post_id;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['istk_add_on_portfolio_meta_nonce'], 'istk_portfolio_save' ) ) {
		return $post_id;
	}

	// If this is an autosave, our form has not been submitted,
	//     so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// Check the user's permissions.
	if ( 'istk_portfolio' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	} else {
		return $post_id;
	}

	/* OK, its safe for us to save the data now. */

	// Sanitize the user input.
	//$mydata = sanitize_text_field( $_POST['myplugin_new_field'] );

	// Update the meta field.
	//update_post_meta( $post_id, '_my_meta_value_key', $mydata );
	
	
	$field_list = istk_add_on_portfolio_meta_list();
	//保存
	foreach ( $field_list as $name => $text ) {
		if ( isset( $_POST[$name] ) ) {
			$data = sanitize_text_field( $_POST[$name] );
			update_post_meta( $post_id, $name, $data );
		}
	}
}
add_action( 'save_post', 'istk_add_on_save_portfolio_metas' );



//metaboxのなかみ
function istk_add_on_render_meta_box( $post ) {
	wp_nonce_field( 'istk_portfolio_save', 'istk_add_on_portfolio_meta_nonce' );
	$field_list = istk_add_on_portfolio_meta_list();
	foreach ( $field_list as $name => $text ) {
		//$value = '';
		$value = get_post_meta( $post->ID, $name, true);
		?>
		<div class="istk-add-on-meta">
			<label><?php echo $text; ?></label>
			<input type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
		</div>
		<?php
		
	}
}




//