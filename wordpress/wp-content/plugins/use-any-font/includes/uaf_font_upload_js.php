<?php
if (isset($_POST['submit-uaf-font'])){	
	$fontSaveResponse 		= uaf_save_font_files($_POST['font_name'], $_POST['convert_response']);
	$operationStatus		= $fontSaveResponse['status'];
	$operationMsg			= $fontSaveResponse['body'];
}
?>

<?php if (!empty($operationMsg)):?>
	<div class="updated <?php echo $operationStatus; ?>" id="message"><p><?php echo $operationMsg ?></p></div>
<?php endif; ?>

<table class="wp-list-table widefat fixed bookmarks">
    <thead>
        <tr>
            <th><strong>Upload Fonts</strong></th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>

<p align="right"><input type="button" name="open_add_font" onClick="open_add_font();" class="button-primary" value="Add Fonts" /><br/></p>

<div id="font-upload" style="display:none;">
	<form action="admin.php?page=uaf_settings_page" id="open_add_font_form" method="post" enctype="multipart/form-data">
    	<table class="uaf_form">
        	<tr>
            	<td width="175">Font Name</td>
                <td><input type="text" name="font_name" value="" maxlength="20" class="required" style="width:200px;" /></td>
            </tr>	
            <tr>    
                <td>Font File</td>
                <td><input type="file" id="fontfile" name="fontfile" value="" class="required" accept=".woff,.ttf,.otf" /><br/>
                <?php 
				
				?>
                <em>Accepted Font Format : <?php echo join(", ",$GLOBALS['allowedFontFormats']); ?> | Font Size: Upto <?php echo $GLOBALS['allowedFontSize'] ?> MB</em><br/>
                
                </td>
            </tr>
            <tr>        
                <td>&nbsp;
                	
                </td>
                <td>
                <input type="hidden" name="url" value="<?php echo home_url(); ?>" />
                <input type="hidden" name="api_key" value="<?php echo $GLOBALS['uaf_api_key']; ?>" />
                <input type="hidden" name="font_count" value="<?php echo count_uploaded_fonts(); ?>" />
                <input type="hidden" name="convert_response" id="convert_response" value="" />
                <input type="hidden" name="submit-uaf-font" id="submit-uaf-font" value="Upload" />
                <input type="submit" name="submit-uaf-font" id="submit-uaf-font" class="button-primary" value="Upload" />

                <div id="font_upload_message" class=""></div>
                <p>By clicking on Upload, you confirm that you have rights to use this font.</p>
                </td>
            </tr>
        </table>	
    </form>
    <br/><br/>
</div>

<?php include('uaf_uploaded_font_list.php'); ?>

<script>
	function open_add_font(){
		jQuery('#font-upload').toggle('fast');
		jQuery("#open_add_font_form").validate();		
	}	
</script>
<br/>
</td>
</tr>
</tbody>
</table>
<br/>
<script>
jQuery('#open_add_font_form').submit(function(e){    

	var $formValid = jQuery(this);
	if(! $formValid.valid()) return false;
	
	e.preventDefault();

	jQuery.ajax( {
      url: '<?php echo uaf_get_server_url(); ?>/uaf_convertor/convert.php',
      type: 'POST',
      data: new FormData( this ),
      processData: false,
      contentType: false,
	  beforeSend : function(){
			 jQuery('#submit-uaf-font').attr('disabled',true);
			 jQuery('#font_upload_message').attr('class','ok');
			 jQuery('#font_upload_message').html('Uploading Font. It might take few mins based on your font file size.');
		  },
	  success: function(data, textStatus, jqXHR) 
        {
            var dataReturn = JSON.parse(data);
			status = dataReturn.global.status;
			msg	   = dataReturn.global.msg;
			
			if (status == 'error'){
				jQuery('#font_upload_message').attr('class',status);
				jQuery('#font_upload_message').html(msg);
			} else {
				woffStatus = dataReturn.woff.status;
				woff2Status = dataReturn.woff2.status;
				if (woffStatus == 'ok' && woff2Status == 'ok'){
					jQuery('#convert_response').val(data);
					jQuery('#font_upload_message').attr('class','ok');
					jQuery('#font_upload_message').html('Font Conversion Complete. Finalizing...');
					jQuery('#submit-uaf-font').attr('disabled',false);
					jQuery('#fontfile').remove();
					e.currentTarget.submit();
				} else {
					jQuery('#font_upload_message').attr('class','error');
					jQuery('#font_upload_message').html('Problem converting font to woff/eot.');
				}
			}			
        },
	   error: function(jqXHR, textStatus, errorThrown) 
        {
            jQuery('#font_upload_message').attr('class','error');
			jQuery('#font_upload_message').html('Unexpected Error Occured.');
			jQuery('#submit-uaf-font').attr('disabled',false);
        }	
    });
  });
</script>