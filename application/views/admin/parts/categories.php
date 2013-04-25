<div id="admin_categories" class="part-box">
	<div class="part-box-head"> categories </div>
	<div class="part-box-body">
		<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<tr>
					<td>
						genre
					</td>
				</tr>
				<tr>
					<td>
						<div src="<?php echo site_url('widgets/genre') ?>" class="part">
							<param name="element_id" value="genre_filter" />
							<param name="input_name" value="genre_id" />
							<param name="genre_id" value="<?php echo $genre->id ?>" />
							<div class="part-content"></div>
						</div>
					</td>
				</tr>
		</table>
		<div style="max-height: 225px; overflow: auto;">
			<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<?php foreach ($categories->result() as $record): ?>
					<tr class="data-table-body-row">
						<td>
							<p><?php echo $record->text; ?></p>
						</td>
						<td width="60px">
							<form action="<?php echo site_url('ajax/admin/delete_category'); ?>">
								<input type="hidden" name="category_id" value="<?php echo $record->id; ?>"/>
								<button type="button" class="submit-button">delete</div>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<form action="<?php echo site_url('ajax/admin/add_category'); ?>">
			<input type="hidden" name="genre_id" value="<?php echo $genre->id; ?>" />
			<table border="0" cellspacing="0" cellpadding="5" width="100%">
				<tr class="data-table-body-row">
					<td>
						<input type="text" name="category_text" />
					</td>
					<td width="60px">
						<button type="button" class="submit-button">add</div>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script language="javascript">

	$('#admin_categories').on('change', '#genre_filter', function()
	{	
	
		var part = $('#admin_categories').closest('.part');
				param = part.find('[name="genre_id"]');
				
		param.attr("value",72);
		
		load_part(part);		
		
	});

</script>