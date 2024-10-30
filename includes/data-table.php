<?php
//データテーブル


function istk_add_on_echo_data_table() {


global $post;
$data = array();
$data_in = false;

if ( function_exists( 'istk_add_on_portfolio_meta_list' ) ) {
	$field_list = istk_add_on_portfolio_meta_list();
	foreach ( $field_list as $name => $text ) {
		$value = get_post_meta( $post->ID, $name, true);
		$data[] = array(
			//'name'	=>	$name,
			'text'	=>	$text,
			'value'	=>	$value,
		);
		if ( ! empty( $value ) ) {
			$data_in = true;
		}
	}
}


if ( $data_in ) :
?>

<div class="work-data-area">
<h2><?php
	esc_html_e( 'Production Data', 'istk-add-on' ); //制作データ
?></h2>
<div class="table-responsive">
<table class="work-data-table">
<?php foreach ( $data as $array ):
	$v = ( !empty( $array[ 'value' ] ) ) ? $array[ 'value' ] : '-';
?>
	<tr>
		<td class="tag"><?php echo esc_html( $array[ 'text' ] ); ?></td>
		<td class="data"><?php echo esc_html( $v ); ?></td>
	</tr>
<?php endforeach; ?>

</table>
</div>
<?php
$desc = get_option( 'istk_add_on_portfolio_data_description' );
if ( !empty( $desc ) ) {
	echo '<div class="work_data_notice">' . $desc . '</div>';
}
?>
</div>

<?php
endif;

}


