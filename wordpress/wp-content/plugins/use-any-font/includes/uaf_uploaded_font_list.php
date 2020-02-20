<?php $fontsData      = get_uploaded_font_list(); ?>
<table cellspacing="0" class="wp-list-table widefat fixed bookmarks">
	<thead>
    	<tr>
        	<th width="20">Sn</th>
            <th>Font</th>
            <th width="100">Delete</th>
        </tr>
    </thead>
    
    <tbody>
    	<?php if (!empty($fontsData)): ?>
        <?php 
		$sn = 0;
		foreach ($fontsData as $key=>$fontData):
		$sn++
		?>
        <tr>
        	<td><?php echo $sn; ?></td>
            <td><?php echo $fontData['font_name'] ?></td>
            <td><a onclick="if (!confirm('Are you sure ?')){return false;}" href="admin.php?page=uaf_settings_page&delete_font_key=<?php echo $key; ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
        	<td colspan="3">No font found. Please click on Add Fonts to add font</td>
        </tr>
        <?php endif; ?>        
    </tbody>    
</table>