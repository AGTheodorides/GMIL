<div class="part-box">
	<div class="part-box-head"> settings </div>
	<div class="part-box-body">
		<form action="<?php echo site_url('ajax/admin/save_image_settings'); ?>">
			<div class="form-error"></div>
			<div class="form-success"></div>
			<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<tr>
					<td>
						maximum image width (pixels)
					</td>
					<td>
						<input type="text" name="max_image_width" value="<?php echo $max_image_width; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						maximum image height (pixels)
					</td>
					<td>
						<input type="text" name="max_image_height" value="<?php echo $max_image_height; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						maximum image size (bytes)
					</td>
					<td>
						<input type="text" name="max_image_size" value="<?php echo $max_image_size; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						allowed file types (separated by a '|')
					</td>
					<td>
						<input type="text" name="image_types" value="<?php echo $image_types; ?>" />
					</td>
				</tr>
			</table>
			<div style="text-align: right">
				<button type="button" class="submit-button" options='{ "refresh": false }'>save</button>
			</div>
		</form>
	</div>
</div>