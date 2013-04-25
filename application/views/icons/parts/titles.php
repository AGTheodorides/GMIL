<div class="part-box">
	<div class="part-box-head"> title </div>
	<div class="part-box-body">
		<div id="titles">
			<div id="title_list">
				<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #CCC">
					<?php foreach($icon_titles->result() as $record): ?>
						<tr>
							<td width="250px">
								<!-- Voter -->
								<div class="part" src="<?php echo site_url('icons/voter') ?>">
									<param name="icon_id" value="<?php echo $icon->id ?>" />
									<param name="field_type" value="1" />
									<param name="field_id" value="<?php echo $record->id ?>" />
									<div class="part-content"></div>
								</div>
							</td>
							<td>
								<div id="title_data_<?php echo $record->id; ?>" class="editable">
									<div class="editable-viewer">
										<p><?php echo htmlspecialchars($record->text); ?></p>
										<div style="text-align:right; font-size: 7pt">entry #<b><?php echo $record->id; ?></b> </div>
									</div>
									<?php if (!$me->is_guest && $icon->status == 0): ?>
										<?php if (($me->is_admin) || ($icon->creator_id == $me->id)): ?>
											<div class="editable-editor">
												<form>
													<div class="form-error"></div>
													<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
													<input type="hidden" name="field_type" value="1" />
													<input type="hidden" name="field_id" value="<?php echo $record->id; ?>" />
													<input type="text" name="field_data" value="<?php echo $record->text; ?>" />
													<div class="form-controls">
														<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/update_field'); ?>", "area":"title_data_<?php echo $record->id; ?>" }'>update</button>
														<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/delete_field'); ?>", "area":"title_list" }'>delete</button>
														<button type="button" class="editable-editor-exit-button">cancel</button>
													</div>
												</form>
											</div>
										<?php endif; ?>
									<?php endif; ?>											
								</div>							
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<div class="editable">
				<div class="editable-viewer">
					<div style="text-align: right;">
						+ new title
					</div>
				</div>
				<?php if (!$me->is_guest && $icon->status == 0): ?>
					<div class="editable-editor">
						<form action="<?php echo site_url('ajax/icons/add_field'); ?>">
							<div class="form-error"></div>
							<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
							<input type="hidden" name="field_type" value="1" />
							<input type="text" name="field_data" placeholder="new title" />
							<div style="text-align: right;">
								<button type="button" class="submit-button" options='{ "area":"titles" }'>add</button>
								<button type="button" class="editable-editor-exit-button">cancel</button>
							</div>
						</form>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<!-- Comments -->
		<div class="part" src="<?php echo site_url('icons/comments').'/'.$icon->id ?>">
			<param name="icon_id" value="<?php echo $icon->id?>" />
			<param name="field_type" value="1" />
			<div class="part-content"></div>
		</div>		
	</div>
</div>