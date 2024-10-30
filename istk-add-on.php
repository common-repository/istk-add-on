<?php
/*
Plugin Name: ISTK Add-On
Plugin URI: https://istkweb.com/wp-products/istk-add-on
Description: This plugin adds features for theme "ISTK Portfolio".
Author:	ISTK
Version: 1.2
Author URI:	https://istkweb.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: istk-add-on
*/

define( 'ISTK_ADDON__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ISTK_ADDON__PLUGIN_DIR_URL', plugins_url( '', __FILE__ ) );

$plugin_data = get_file_data( plugin_dir_path( __FILE__ ) . 'istk-add-on.php', array( 'Version' ), 'plugin' );
define( 'ISTK_ADDON__PLUGIN_VERSION', $plugin_data[0] );




if ( !function_exists( 'add_action' ) ) {
	//echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


function istk_add_on_plugin_activate() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'istk_add_on_plugin_activate' );


//スタイル
function istk_add_on_style() {
	wp_enqueue_style( 'istk-add-on', ISTK_ADDON__PLUGIN_DIR_URL . '/assets/style.css', array(), ISTK_ADDON__PLUGIN_VERSION );
}
add_action( 'wp_enqueue_scripts', 'istk_add_on_style' );

function istk_add_on_admin_style(){
	wp_enqueue_style( 'istk-add-on-admin', ISTK_ADDON__PLUGIN_DIR_URL . '/assets/admin.css', array(), ISTK_ADDON__PLUGIN_VERSION );
}
add_action( 'admin_init', 'istk_add_on_admin_style' );


require_once dirname( __FILE__ ) . '/includes/post-type.php';
require_once dirname( __FILE__ ) . '/includes/add-category-image.php';
require_once dirname( __FILE__ ) . '/includes/templates.php';
require_once dirname( __FILE__ ) . '/includes/portfolio-metas.php';
require_once dirname( __FILE__ ) . '/includes/settings.php';
require_once dirname( __FILE__ ) . '/includes/data-table.php';
require_once dirname( __FILE__ ) . '/includes/template-functions.php';
require_once dirname( __FILE__ ) . '/includes/shortcodes.php';

