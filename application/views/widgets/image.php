<div id="<?php echo $element_id ?>" class="image-editor">
	<table cellpadding="5" cellspacing="0" border="0" width="350px">
		<tr valign="top">
			<td style="width: 200px;">
				<div id="<?php echo $element_id ?>_editor">
					<div class="image-editor-box">
						<?php if(isset($image_url)): ?>
							<input id="<?php echo $element_id ?>_image_url" name="<?php echo $input_name ?>" type="hidden" value="<?php echo $image_url; ?>"/>
							<img id="<?php echo $element_id ?>_image_tag" src="<?php echo base_url().'images/'.$image_url; ?>?cb=<?php echo date("Y-m-d H:i:s") ?>" />
						<?php else: ?>
							<img src="<?php echo base_url()."images/no_icon.png"; ?>" />
						<?php endif; ?>
					</div>
					<button type="button" onclick="$(this).next().click();" style="width: 200px;"> choose </button>
					<input type="file" name="file" onchange="<?php echo $element_id ?>_choose();" style="position: absolute; left: -9999em;" />
				</div>
			</td>
			<td>
				<div class="image-editor-help">
					<ul>
						<li> Icon sketches should be black and white. </li>
						<li> Upload formats: JPG, GIF or PNG </li>
						<li> Maximum size is 100kb </li>
					</ul>
					<p> See FAQ for design info. </p>
				</p>
			</td> 
		</tr>
	</table>
</div>

<script language="javascript">
			
	function <?php echo $element_id ?>_choose()
	{
		
		var form = $("#<?php echo $element_id ?>").closest('form');
		
		form.attr("enctype", "multipart/form-data");
		
		form.ajaxSubmit({
			url: "<?php echo site_url('ajax/files/upload'); ?>",
			type: "POST",
			success: function(responseText, statusText)
			{
				try
				{
				
					var response = JSON.parse(responseText);
					
					if (response.success)
					{
						
						load({
							url: "<?php echo site_url('widgets/image'); ?>",
							target: $('#<?php echo $element_id ?>').find('#<?php echo $element_id ?>_editor'),
							source: '#<?php echo $element_id ?>_editor',
							data:
							{
								element_id: "<?php echo $element_id; ?>",
								input_name: "<?php echo $input_name; ?>",
								image_url: response.temp_image_url
							},
							completed: function()
							{
								<?php echo $element_id ?>_fit();
							}
						});
												
						form.find('.success').fadeIn();
						form.find('.error').fadeOut();
						form.find('.success').html(response.message).fadeIn();
						
					}
					else
					{
						// Display error message
						form.find('.success').fadeOut();
						form.find('.error').fadeIn();
						form.find('.error').html(response.message).fadeIn();
					}
				}
				catch(e)
				{
					// Display error message
					form.find('.success').fadeOut();
					form.find('.error').fadeIn();
					form.find('.error').html('<p onclick="$(this).next().fadeToggle();"> there was an error completing the request. (controller) </p><div class="error-content"> <p>error=' + e + '</p><p>responseText='  + responseText + '</p></div>').fadeIn();
				}
			},
			error: function(xhr)
			{
				// Display error message
				form.find('.success').fadeOut();
				form.find('.error').fadeIn();
				form.find('.error').html('<p onclick="$(this).next().fadeIn();"> there was an error completing the request. (ajax) </p><div class="error-content"> <p>statusText=' + xhr.statusText + '</p><p>responseText='  + xhr.responseText + '</p></div>').fadeIn();
			}
		});
		
	}
	
</script>