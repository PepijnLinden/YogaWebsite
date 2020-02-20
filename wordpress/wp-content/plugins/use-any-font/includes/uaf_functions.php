<?php
// MOVING OLD FONTFILE PATH TO NEW PATH 
function uaf_move_file_to_newPath(){
	$uaf_upload 	= wp_upload_dir();
	$uaf_upload_dir = $uaf_upload['basedir'];
	$uaf_upload_dir = $uaf_upload_dir . '/useanyfont/';
	$fontsRawData 	= get_option('uaf_font_data');
	$fontsData		= json_decode($fontsRawData, true);
	if (!empty($fontsData)):
		foreach ($fontsData as $key=>$fontData):
			
			$oldFilePathInfo		= pathinfo($fontData['font_path']);			
			$parsedPath				= parse_url($fontData['font_path']);
			$relativeFilePath		= $_SERVER['DOCUMENT_ROOT'].$parsedPath['path'];			
			$oldfilename			= $oldFilePathInfo['filename'];
			
			if (file_exists($relativeFilePath.'.woff')){
				
				$woffFileContent 		= file_get_contents($relativeFilePath.'.woff');
				$eotFileContent 		= file_get_contents($relativeFilePath.'.eot');
				
				$fhWoff = fopen($uaf_upload_dir.'/'.$oldfilename.'.woff' , 'w') or die("can't open file. Make sure you have write permission to your upload folder");
				fwrite($fhWoff, $woffFileContent);
				fclose($fhWoff);
				
				$fhEot = fopen($uaf_upload_dir.'/'.$oldfilename.'.eot' , 'w') or die("can't open file. Make sure you have write permission to your upload folder");
				fwrite($fhEot, $eotFileContent);
				fclose($fhEot);
				
				$fontsData[$key]['font_path']	= $oldfilename;
			}
		endforeach;
	endif;
	
	$updateFontData	= json_encode($fontsData);
	update_option('uaf_font_data',$updateFontData);	
}

function uaf_write_css(){
	$uaf_use_absolute_font_path = $GLOBALS['uaf_use_absolute_font_path']; // Check if user want to use absolute font path.
	
	if (empty($uaf_use_absolute_font_path)){
		$uaf_use_absolute_font_path = 0;
	}
	
	$uaf_upload_path	= uaf_path_details();
	$uaf_upload_dir 	= $uaf_upload_path['dir'];
	$uaf_upload_url 	= preg_replace('#^https?:#', '', $uaf_upload_path['url']);
	
	if ($uaf_use_absolute_font_path == 0){ // If user use relative path
		$url_parts = parse_url($uaf_upload_url);
		@$uaf_upload_url = "$url_parts[path]$url_parts[query]$url_parts[fragment]";
	}

	ob_start();
		$fontsData		= get_uploaded_font_list();
		if (!empty($fontsData)):
			foreach ($fontsData as $key=>$fontData): ?>
				@font-face {
					font-family: '<?php echo $fontData['font_name'] ?>';
					src: <?php if (file_exists($uaf_upload_dir.$fontData['font_path'].'.woff2')){ ?>url('<?php echo $uaf_upload_url.$fontData['font_path'] ?>.woff2') format('woff2'),
						<?php } ?>url('<?php echo $uaf_upload_url.$fontData['font_path'] ?>.woff') format('woff');
				}

				.<?php echo $fontData['font_name'] ?>{font-family: '<?php echo $fontData['font_name'] ?>' !important;}

		<?php
		endforeach;
		endif;	
			
		$fontsImplementRawData 	= get_option('uaf_font_implement');
		$fontsImplementData		= json_decode($fontsImplementRawData, true);
		if (!empty($fontsImplementData)):
			foreach ($fontsImplementData as $key=>$fontImplementData): ?>
				<?php echo $fontImplementData['font_elements']; ?>{
					font-family: '<?php echo $fontsData[$fontImplementData['font_key']]['font_name']; ?>' !important;
				}
		<?php
			endforeach;
		endif;	
		$uaf_style = ob_get_contents();
		$uafStyleSheetPath	= $uaf_upload_path['dir'].'/uaf.css';
		$fh = fopen($uafStyleSheetPath, 'w') or die("Can't open file");
		fwrite($fh, $uaf_style);
		fclose($fh);
	ob_end_clean();
	
	ob_start();
		$fontsData		= get_uploaded_font_list();
		if (!empty($fontsData)):
			foreach ($fontsData as $key=>$fontData): ?>
				@font-face {
					font-family: '<?php echo $fontData['font_name'] ?>';
					src: <?php if (file_exists($uaf_upload_dir.$fontData['font_path'].'.woff2')){ ?>url('<?php echo $uaf_upload_url.$fontData['font_path'] ?>.woff2') format('woff2'),
						<?php } ?>url('<?php echo $uaf_upload_url.$fontData['font_path'] ?>.woff') format('woff');
				}

				.et_gf_<?php echo $fontData['font_name'] ?>{background:none !important;font-family:<?php echo $fontData['font_name'] ?>;text-indent:0 !important;font-size:25px;}

		<?php
		endforeach;
		endif;
		$uaf_style = ob_get_contents();
		$uafStyleSheetPath	= $uaf_upload_path['dir'].'/admin-uaf.css';
		$fh = fopen($uafStyleSheetPath, 'w') or die("Can't open file");
		fwrite($fh, $uaf_style);
		fclose($fh);
		
		$uafStyleSheetPath	= $uaf_upload_path['dir'].'/admin-uaf-rtl.css';
		$fh = fopen($uafStyleSheetPath, 'w') or die("Can't open file");
		fwrite($fh, $uaf_style);
		fclose($fh);
	ob_end_clean();
	update_option('uaf_css_updated_timestamp', time()); // Time entry for stylesheet version
}

function uaf_update_check() { // MUST CHANGE WITH EVERY VERSION
    $uaf_version_check = get_option('uaf_current_version');
	if ($uaf_version_check != '5.5'):
		update_option('uaf_current_version', '5.5');
		if ($uaf_version_check < 4.0):
			uaf_create_folder();
			uaf_move_file_to_newPath();
		endif;
		uaf_write_css();
	endif;	
}

function uaf_get_server_url(){
	$uaf_use_alternative_server = $GLOBALS['uaf_use_alternative_server'];
	if ($uaf_use_alternative_server == 1){
		return $GLOBALS['serverUrl']['alternative'];
	} else {
		return $GLOBALS['serverUrl']['default'];
	}
}

function uaf_create_folder() {
	$uaf_upload_path	= uaf_path_details();
	if (! is_dir($uaf_upload_path['dir'])) {
       mkdir( $uaf_upload_path['dir'], 0755 );
    }
}

function uaf_max_upload_size_for_php($sendinbytes = false){
	$maxUploadSizeForPHP 	= $GLOBALS['allowedFontSize'];
	$wpAllowedMaxSize 		= wp_max_upload_size(); 
	$wpAllowedMaxSizeToMB	= $wpAllowedMaxSize / 1048576 ;
	if ($wpAllowedMaxSizeToMB < $GLOBALS['allowedFontSize']){
		$maxUploadSizeForPHP = $wpAllowedMaxSizeToMB;
	}
	if ($sendinbytes) {
		return $maxUploadSizeForPHP * 1048576;	
	} else {
		return $maxUploadSizeForPHP;	
	}	
}

function uaf_path_details(){
	$uaf_upload 		= wp_upload_dir();
	$uaf_upload_dir		= $uaf_upload['basedir'];
	$uaf_upload_dir 	= $uaf_upload_dir . '/useanyfont/';
	$uaf_upload_url		= $uaf_upload['baseurl'];
	$uaf_upload_url 	= $uaf_upload_url . '/useanyfont/';

	$pathReturn['dir'] 	= $uaf_upload_dir;
	$pathReturn['url'] 	= $uaf_upload_url;
	return $pathReturn;
}

function uaf_upload_font_to_server(){
	$font_file_details 	= pathinfo($_FILES['font_file']['name']);
	$file_extension		= strtolower($font_file_details['extension']);	
	$font_size			= $_FILES['font_file']['size'];

	if ((in_array($file_extension, $GLOBALS['allowedFontFormats'])) && ($font_size <= uaf_max_upload_size_for_php(true))){
		@set_time_limit(0);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, uaf_get_server_url().'/uaf_convertor/convert.php');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
		$post = array(
			'fontfile' 		=>  new CURLFile($_FILES['font_file']['tmp_name']),
			'fontfileext' 	=> pathinfo($_FILES['font_file']['name'], PATHINFO_EXTENSION),
			'api_key' 		=> $GLOBALS['uaf_api_key'],
			'url'			=> $_POST['url'],
			'font_count'	=> $_POST['font_count']
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$convertResponse = curl_exec($ch);
		if(curl_errno($ch)) {
			$fontUploadResponse['status'] 		= 'error';
			$fontUploadResponse['body']		    = 'Error: ' . curl_error($ch);
		} else {
			$CrulStatinfo = curl_getinfo($ch);
			if ($CrulStatinfo['http_code'] == '200'):
				$convertResponseArray = json_decode($convertResponse, true);
				if ($convertResponseArray['global']['status'] == 'error'):
					$fontUploadResponse['status']    = 'error';
					$fontUploadResponse['body']   	 = $convertResponseArray['global']['msg'];
				else:					
					$fontUploadResponse['status']    = 'success';
					$fontUploadResponse['body']   	 = $convertResponse;
				endif;
			else:
				$fontUploadResponse['status']    = 'error';
				$fontUploadResponse['body'] 	 = $convertResponse;
			endif;
		}		
	} else {
		$fontUploadResponse['status']    = 'error';
		$fontUploadResponse['body'] 	 = 'Only '.join(", ",$GLOBALS['allowedFontFormats']).' format and font less than '.uaf_max_upload_size_for_php().' MB accepted';
	}
	return $fontUploadResponse;
}

function uaf_save_font_files($font_name, $convertResponse){
	$uafPath 				= uaf_path_details();
	$fontNameToStore 		= sanitize_file_name(date('ymdhis').$font_name);
	
	$convertResponseArray = json_decode(stripslashes($convertResponse), true);
	if ($convertResponseArray['global']['status'] == 'ok'):
		$neededFontFormats = array('woff2','woff');
		foreach ($neededFontFormats as $neededFontFormat):
			if ($convertResponseArray[$neededFontFormat]['status'] == 'ok'):
				$fontFileContent = wp_safe_remote_get($convertResponseArray[$neededFontFormat]['filename'], array('timeout'=>'300'));

				if ( is_wp_error( $fontFileContent ) ) {
			        $fontUploadFinalResponse['status']   = 'error';
					$fontUploadFinalResponse['body']	 = $fontFileContent->get_error_message();
					return $fontUploadFinalResponse;
			    }	

			    if ( $fontFileContent['response']['code'] == '200') :			     	
			    	$fontFileContent = wp_remote_retrieve_body( $fontFileContent );
			    	if (!empty($fontFileContent)):
						$newFileName		= $fontNameToStore.'.'.$neededFontFormat;
						$newFilePath		= $uafPath['dir'].$newFileName;
						$fh = fopen($newFilePath, 'w') or die("can't open file. Make sure you have write permission to your upload folder");
						fwrite($fh, $fontFileContent);
						fclose($fh);
					else:
						$fontSaveMsg[$neededFontFormat]['status'] 	= 'error';
						$fontSaveMsg[$neededFontFormat]['body']		= "Couldn't receive $neededFontFormat file";
					endif;
			    else:
			    	$fontSaveMsg[$neededFontFormat]['status'] 	= 'error';
					$fontSaveMsg[$neededFontFormat]['body']		= $neededFontFormat.' : '.$fontFileContent['response']['code'].' '.$fontFileContent['response']['message'];		   
			    endif;
			else:
					$fontSaveMsg[$neededFontFormat]['status'] 	= 'error';
					$fontSaveMsg[$neededFontFormat]['body']		= "Problem converting to $neededFontFormat format";
			endif;
		endforeach;

		if (!empty($fontSaveMsg)):
			$fontUploadFinalResponse['body'] = '';
			foreach ($fontSaveMsg as $formatKey => $formatData):
				if ($fontSaveMsg[$formatKey]['status'] == 'error'):
					$fontUploadFinalResponse['status'] = 'error';
					$fontUploadFinalResponse['body']   .= $formatData['body'].'<br/>';
				endif;
			endforeach;
		else:
			save_font_entry_to_db($font_name, $fontNameToStore);
			$fontUploadFinalResponse['status']   = 'success';
			$fontUploadFinalResponse['body']	 = 'Font Uploaded';
		endif;
	else:
		$fontUploadFinalResponse['status']   = 'error';
		$fontUploadFinalResponse['body']	 = $convertResponseArray['global']['msg'];
	endif;

	return $fontUploadFinalResponse;
}

function save_font_entry_to_db($font_name, $font_path){
	$fontsRawData 	= get_option('uaf_font_data');
	$fontsData		= json_decode($fontsRawData, true);
	if (empty($fontsData)):
		$fontsData = array();
	endif;
	
	$fontsData[date('ymdhis')]	= array('font_name' => sanitize_title($font_name), 'font_path' => $font_path);
	$updateFontData	= json_encode($fontsData);
	update_option('uaf_font_data',$updateFontData);
	uaf_write_css();
}

function get_uploaded_font_list(){
	$fontsRawData   = get_option('uaf_font_data');
	return json_decode($fontsRawData, true);
}

function count_uploaded_fonts(){
	$fontsRawData   = get_option('uaf_font_data');
	$fontsData 		= json_decode($fontsRawData, true);
	return count($fontsData);
}

function uaf_key_activate(){
	$uaf_api_key 	= trim($_POST['uaf_api_key']);
	$api_key_return = wp_remote_get( uaf_get_server_url().'/uaf_convertor/validate_key.php?license_key='.$uaf_api_key.'&url='.home_url(), array('timeout'=>300,'sslverify'=>false,'user-agent'=>get_bloginfo( 'url' )));
	if ( is_wp_error( $api_key_return ) ) {
	   $error_message 		= $api_key_return->get_error_message();
	   $return['body'] 		= "Something went wrong: $error_message";
	   $return['status'] 	= 'error';
	} else {
	    $api_key_return = json_decode($api_key_return['body']);
		if ($api_key_return->status == 'success'){
			update_option('uaf_api_key', $uaf_api_key);
			$GLOBALS['uaf_api_key']	= $uaf_api_key;
		}
		$return['body'] 	= $api_key_return->msg;
	   	$return['status'] 	= $api_key_return->status;
	}
	return $return;
}


function uaf_key_deactivate(){
	$uaf_api_key		= $GLOBALS['uaf_api_key'];
	$api_key_return 	= wp_remote_get( uaf_get_server_url().'/uaf_convertor/deactivate_key.php?license_key='.$uaf_api_key.'&url='.home_url(), array('timeout'=>300,'sslverify'=>false,'user-agent'=>get_bloginfo( 'url' )));
	if ( is_wp_error( $api_key_return ) ) {
	   $error_message 	= $api_key_return->get_error_message();
	   $return['body']  	= "Something went wrong: $error_message";
	   $return['status']     = 'error';
	} else {
	    $api_key_return = json_decode($api_key_return['body']);
		if ($api_key_return->status == 'success'){
			delete_option('uaf_api_key');
			$GLOBALS['uaf_api_key']	= '';		
		}
		$return['status']   = $api_key_return->status;
		$return['body'] 	= $api_key_return->msg;
	}	
	return $return;
}

function uaf_delete_font(){
	$uaf_paths 		= uaf_path_details();

	$fontsData		= get_uploaded_font_list();
	$key_to_delete	= $_GET['delete_font_key'];
	@unlink(realpath($uaf_paths['dir'].$fontsData[$key_to_delete]['font_path'].'.woff2'));
	@unlink(realpath($uaf_paths['dir'].$fontsData[$key_to_delete]['font_path'].'.woff'));
	@unlink(realpath($uaf_paths['dir'].$fontsData[$key_to_delete]['font_path'].'.eot'));
	unset($fontsData[$key_to_delete]);
	$updateFontData	= json_encode($fontsData);
	update_option('uaf_font_data',$updateFontData);
	$return['status']   = 'success';
	$return['body'] 	= 'Font Deleted';
	uaf_write_css();
	return $return;
}

function uaf_get_language_selector(){
	$enableMultiLang 	= '';
	$returnSelectHTML 	= '';
	if ($GLOBALS['uaf_enable_multi_lang_support'] == 1){
		$enableMultiLang = TRUE;
		$supported_multi_lang_plugins = $GLOBALS['supported_multi_lang_plugins'];
		foreach ($supported_multi_lang_plugins as $key => $plugin_name) {
			if (is_plugin_active($plugin_name)){
				$active_multi_lang_plugin = $plugin_name;
			}
			//echo $active_multi_lang_plugin;
		}

		if (isset($active_multi_lang_plugin)){			
			switch ($active_multi_lang_plugin) {
				case 'polylang/polylang.php': // WHEN POLYLANG PLUGIN IS ACTIVATED.
						$active_languages = pll_languages_list(array('fields'=>''));
						foreach ($active_languages as $key => $active_language) {
							$lang_select_data[$active_language->w3c] = $active_language->name;
						}
					break;
				case 'sitepress-multilingual-cms/sitepress.php': // WHEN WPML PLUGIN IS ACTIVATED.
						$active_languages = icl_get_languages();
						foreach ($active_languages as $key => $active_language) {
							$lang_select_data[str_replace('_', '-',$active_language['default_locale'])] = $active_language['translated_name'].' ('.$active_language["native_name"].')';
						}
					break;
			}

			$returnSelectHTML = '<select style="width:200px;" class="required" name="language"><option selected="selected" value="">- Select - </option><option value="all_lang">All Languages</option>';
			foreach ($lang_select_data as $locale => $lang_name) {
				//$returnSelectHTML .= '<option value="body.language-'.$locale.'">'.$lang_name.'</option>';
				$returnSelectHTML .= '<option value="html:lang('.$locale.')">'.$lang_name.'</option>';		
			}
			$returnSelectHTML .= '</select>';
		} else {
			$returnSelectHTML = "You don't have multi lingual plugin active which is supported by Use Any Font.";
		}
	}
	
	
	$return['enableMultiLang'] 	= $enableMultiLang;
	$return['selectHTML'] 		= $returnSelectHTML;
	return $return;
}

function uaf_langutizse_elements($finalElements){
	if (isset($_POST['language']) && ($_POST['language'] != 'all_lang')){
          $finalElementArray = explode(',', $finalElements);
          $finalElementArray = array_map('trim', $finalElementArray);
          $prefixed_array    = preg_filter('/^/', $_POST['language'].' ', $finalElementArray);
          $finalElements  = join(', ', $prefixed_array);
    }
    return $finalElements;
}

function uaf_save_settings(){
	if (isset($_POST['submit-uaf-settings'])){
	    if (isset($_POST['uaf_disbale_editor_font_list'])){
	        $uaf_disbale_editor_font_list = 1;
	    } else {
	        $uaf_disbale_editor_font_list = '';
	    }
	    
	    if (isset($_POST['uaf_use_curl_uploader'])){
	        $uaf_use_curl_uploader = 1;
	    } else {
	        $uaf_use_curl_uploader = '';
	    }
	    
	    if (isset($_POST['uaf_use_absolute_font_path'])){
	        $uaf_use_absolute_font_path = 1;
	    } else {
	        $uaf_use_absolute_font_path = '';
	    }
	    
	    if (isset($_POST['uaf_use_alternative_server'])){
	        $uaf_use_alternative_server = 1;
	    } else {
	        $uaf_use_alternative_server = '';
	    }

	    if (isset($_POST['uaf_enable_multi_lang_support'])){
	        $uaf_enable_multi_lang_support = 1;
	    } else {
	        $uaf_enable_multi_lang_support = '';
	    }
	    
	    update_option('uaf_disbale_editor_font_list', $uaf_disbale_editor_font_list);
	    update_option('uaf_use_curl_uploader', $uaf_use_curl_uploader);
	    update_option('uaf_use_absolute_font_path', $uaf_use_absolute_font_path);   
	    update_option('uaf_use_alternative_server', $uaf_use_alternative_server);   
	    update_option('uaf_enable_multi_lang_support', $uaf_enable_multi_lang_support); 

	    $GLOBALS['uaf_disbale_editor_font_list']	= $uaf_disbale_editor_font_list;
		$GLOBALS['uaf_use_curl_uploader']			= $uaf_use_curl_uploader;
		$GLOBALS['uaf_use_absolute_font_path']		= $uaf_use_absolute_font_path;
		$GLOBALS['uaf_use_alternative_server']		= $uaf_use_alternative_server;
		$GLOBALS['uaf_enable_multi_lang_support']	= $uaf_enable_multi_lang_support;

	    $settings_message = 'Settings Saved';
	    
	    uaf_write_css(); // Need to rewrite css for uaf_use_relative_font_path setting change 
	}
}