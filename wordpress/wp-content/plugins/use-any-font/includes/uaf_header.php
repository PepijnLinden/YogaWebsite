<?php
if (isset($_POST['ucf_api_key_submit'])){
	$activationRetun  		= uaf_key_activate();
	$operationMsg	  		= $activationRetun['body'];
	$operationStatus	  	= $activationRetun['status'];
}

if (isset($_POST['ucf_api_key_remove'])){
	$deactivationRetun  = uaf_key_deactivate();
	$operationMsg	  	= $deactivationRetun['body'];
	$operationStatus  	= $deactivationRetun['status'];	
}

if (isset($_GET['delete_font_key'])):
	$fontDeleteRetun  	= uaf_delete_font();
	$operationMsg	  	= $fontDeleteRetun['body'];
	$operationStatus  	= $fontDeleteRetun['status'];	
endif;
?>


<div class="wrap">
<h2>Use Any Font</h2>
<table width="100%">
	<tr>
    	<td valign="top">
            <table class="wp-list-table widefat fixed bookmarks">
                <thead>
                    <tr>
                        <th><strong>API KEY</strong></th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                    	<form action="admin.php?page=uaf_settings_page" method="post" id="uaf_api_key_form" >
                        API KEY :
                    	<?php if (empty($GLOBALS['uaf_api_key'])): ?>
                        <input name="uaf_api_key" id="uaf_api_key" type="text" style="width:350px; margin-left:50px;" />
                        <input type="submit" name="ucf_api_key_submit" class="button-primary" value="Verify" style="padding:2px;" />
                        <input type="button" name="uaf_api_key_generate" id="uaf_api_key_generate" class="button-primary" value="Generate Test API Key" style="padding:2px;" onclick="uaf_lite_api_key_generate();" />
                        <br/> <br/>
                        Use Any Font need API key to upload the font. You can get the premium key from <a href="https://dineshkarki.com.np/use-any-font/api-key" target="_blank">here</a>. You can also generate Lite / Test API key from button above. <strong>Note : </strong> Lite / Test API only allow single font conversion. 
                        <br/>
                        <?php else: ?>
                        	<span class="active_key"><?php echo $GLOBALS['uaf_api_key'];  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Active</span>							<input type="submit" name="ucf_api_key_remove" class="button-primary" value="Remove Key" style="padding:2px; margin-left:20px;" onclick="if(!confirm('Are you sure ?')){return false;}" />
                        <?php endif;?>
                        </form>
                        <br/>                        
                        <strong>Note</strong> : API key is need to connect to our server for font conversion. Our server converts your fonts to required types and sends it back.
                        <br/><br/>
                   	</td>
                    
                </tr>
                </tbody>
            </table>
            <br/>
<script>
function uaf_lite_api_key_generate(){	
	jQuery.ajax({url: "<?php echo uaf_get_server_url().'/uaf_convertor/generate_lite_key.php'; ?>",
	beforeSend : function(){
		jQuery('#uaf_api_key_generate').val('Generating...');
	},
	error: function(){
		jQuery('#uaf_api_key_generate').val(' Error ! ');		
	},
	success: function(result){
        var dataReturn 	= JSON.parse(result);
		key 			= dataReturn.key;
		jQuery('#uaf_api_key').val(key);
		jQuery('#uaf_api_key_generate').val('Click Verify to Complete');
    }});
}
</script>