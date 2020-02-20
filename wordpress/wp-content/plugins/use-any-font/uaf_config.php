<?php
$GLOBALS['allowedFontFormats'] 				= array ('ttf','otf','woff');
$GLOBALS['allowedFontSize']					= 25;
$GLOBALS['serverUrl']['default']			= 'https://server2.dnesscarkey.org';
$GLOBALS['serverUrl']['alternative']		= 'https://server3.dnesscarkey.org';
$GLOBALS['supported_multi_lang_plugins']	= array(
												'polylang/polylang.php', // POLYLANG
												'sitepress-multilingual-cms/sitepress.php' //WPML
											   		);

// FROM DATABASE RECORDS
$GLOBALS['uaf_api_key']						= get_option('uaf_api_key');
$GLOBALS['uaf_disbale_editor_font_list']	= get_option('uaf_disbale_editor_font_list');
$GLOBALS['uaf_use_curl_uploader']			= get_option('uaf_use_curl_uploader');
$GLOBALS['uaf_use_absolute_font_path']		= get_option('uaf_use_absolute_font_path');
$GLOBALS['uaf_use_alternative_server']		= get_option('uaf_use_alternative_server');
$GLOBALS['uaf_enable_multi_lang_support']	= get_option('uaf_enable_multi_lang_support');
$GLOBALS['uaf_server_status']				= get_option('uaf_server_status');
$GLOBALS['uaf_server_msg']					= get_option('uaf_server_msg');
?>