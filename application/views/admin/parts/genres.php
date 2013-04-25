<div class="part-box">
	<div class="part-box-head"> genres </div>
	<div class="part-box-body">
		<div style="max-height: 225px; overflow: auto;">
			<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<?php foreach ($genres->result() as $record): ?>
					<tr class="data-table-body-row">
						<td>
							<p><?php echo $record->text; ?></p>
						</td>
						<td width="60px">
							<form action="<?php echo site_url('ajax/admin/delete_genre'); ?>">
								<input type="hidden" name="genre_id" value="<?php echo $record->id; ?>"/>
								<button type="button" class="submit-button">delete</div>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<form action="<?php echo site_url('ajax/admin/add_genre'); ?>">
			<table border="0" cellspacing="0" cellpadding="5" width="100%">
				<tr class="data-table-body-row">
					<td>
						<input type="text" name="genre_text" />
					</td>
					<td width="60px">
						<button type="button" class="submit-button">add</div>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>