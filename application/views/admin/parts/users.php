<div id="admin_users" class="part-box">
	<div class="part-box-head"> users </div>
	<div class="part-box-body">
		<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<tr>
					<td>
						filter
					</td>
				</tr>
				<tr>
					<td>
						<select id='level_select'>
							<option value="0" <?php echo !isset($filter) ? 'selected' : ''; ?> > all </option>
							<option value="1" <?php echo $filter == 1 ? 'selected' : ''; ?>> unverified users </option>
							<option value="2" <?php echo $filter == 2 ? 'selected' : ''; ?>> warned users </option>
							<option value="3" <?php echo $filter == 3 ? 'selected' : ''; ?>> banned users </option>
							<option value="5" <?php echo $filter == 4 ? 'selected' : ''; ?>> map makers </option>
							<option value="6" <?php echo $filter == 5 ? 'selected' : ''; ?>> administrators </option>
						</select>
					</td>
				</tr>
		</table>
		<div style="max-height: 500px; overflow: auto;">
			<table border="0" cellspacing="0" cellpadding="5" width="100%">
				<?php foreach ($users->result() as $record): ?>
					<?php if(!$record->is_special): ?>
						<tr class="table-row">
							<td>
								<a href="<?php echo site_url('profiles/edit').'/'.$record->id; ?>"><?php echo $record->username; ?></a>
							</td>
							<td>
								<form action='<?php echo site_url('ajax/users/delete'); ?>'>
									<div class="form-error"></div>
									<input type="hidden" name="user_id" value="<?php echo $record->id; ?>"/>
									<input type="text" name="warning_text" placeholder="warning text" value="<?php echo $record->warning_text; ?>" />
									<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/warn'); ?>"}'>warn</button></div>
									<?php if($record->is_banned): ?>
										<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/unban'); ?>"}'>unban</button></div>
									<?php else: ?>
										<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/ban'); ?>"}'>ban</button></div>
									<?php endif; ?>
									<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/delete'); ?>"}'>delete</button></div>
								</form>
							</td>
						</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>

<script language="javascript">

	$('#level_select').bind('change', function()
	{	
		
		var part = $('#admin_users').closest('.part');
		
		if (this.value > 0)
		{
			part.attr('src', '<?php echo site_url('admin/users_part'); ?>/' + this.value);
		}
		else
		{
			part.attr('src', '<?php echo site_url('admin/users_part'); ?>');
		}
	
		load_part(part);
		
	});

</script>