<?php
uaf_save_settings();
add_action('admin_menu', 'uaf_create_menu');
add_action("admin_print_scripts", 'adminjslibs');
add_action("admin_print_styles", 'adminCsslibs');
add_action('wp_enqueue_scripts', 'uaf_client_css');
add_action('plugins_loaded', 'uaf_update_check');
add_action('init', 'uaf_editor_setup');

if (isset($_GET['uaf_api_notification_hide']) == 1){
	update_option('uaf_api_notification_hide','yes_2');
}

$uaf_disbale_editor_font_list_value = get_option('uaf_disbale_editor_font_list');
if ($uaf_disbale_editor_font_list_value != 1):
	add_filter('mce_buttons_2', 'wp_editor_fontsize_filter');
	add_filter('tiny_mce_before_init', 'uaf_mce_before_init' );
endif;

function uaf_client_css() {
	$uaf_upload 	= wp_upload_dir();
	$uaf_upload_url = set_url_scheme($uaf_upload['baseurl']);
	$uaf_upload_url = $uaf_upload_url . '/useanyfont/';
	wp_register_style( 'uaf_client_css', $uaf_upload_url.'uaf.css', array(),get_option('uaf_css_updated_timestamp'));
	wp_enqueue_style( 'uaf_client_css' );
}

function adminjslibs(){
	wp_register_script('uaf_validate_js',plugins_url("use-any-font/js/jquery.validate.min.js"));		
	wp_enqueue_script('uaf_validate_js');
}

function adminCsslibs(){
	$uaf_upload 	= wp_upload_dir();
	$uaf_upload_url = set_url_scheme($uaf_upload['baseurl']);
	$uaf_upload_url = $uaf_upload_url . '/useanyfont/';
	wp_register_style('uaf-admin-style', plugins_url('use-any-font/css/uaf_admin.css'));
    wp_enqueue_style('uaf-admin-style');
	wp_register_style('uaf-font-style', $uaf_upload_url.'admin-uaf.css', array(), get_option('uaf_css_updated_timestamp'));
    wp_enqueue_style('uaf-font-style');
	add_editor_style($uaf_upload_url.'admin-uaf.css');
}
		
function uaf_create_menu() {
	add_menu_page( 'Use Any Font', 'Use Any Font', 'manage_options', 'uaf_settings_page', 'uaf_settings_page', 'dashicons-editor-textcolor');
}

function uaf_activate(){
	uaf_create_folder(); // CREATE FOLDER
	uaf_write_css(); //rewrite css when plugin is activated after update or somethingelse......
}

function uaf_settings_page() {
	include('includes/uaf_header.php');
	if ($GLOBALS['uaf_use_curl_uploader'] == 1){
		include('includes/uaf_font_upload_php.php');
	} else {
		include('includes/uaf_font_upload_js.php');	
	}
	include('includes/uaf_font_implement.php');
	include('includes/uaf_footer.php');
}


function uaf_editor_setup(){
	include('includes/uaf_editor_setup.php');
}