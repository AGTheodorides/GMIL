<div class="part-box">
	<div class="part-box-head"> definition </div>
	<div class="part-box-body">
		<div id="definitions">
			<div id="definition_list">
				<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #CCC">
					<?php foreach($icon_definitions->result() as $record): ?>
						<tr>
							<td width="250px">
								<!-- Voter -->
								<div class="part" src="<?php echo site_url('icons/voter') ?>">
									<param name="icon_id" value="<?php echo $icon->id ?>" />
									<param name="field_type" value="2" />
									<param name="field_id" value="<?php echo $record->id ?>" />
									<div class="part-content"></div>
								</div>
							</td>
							<td>
								<div id="definition_data_<?php echo $record->id; ?>"  class="editable">
									<div class="editable-viewer">
										<p><?php echo htmlspecialchars($record->text); ?></p>
										<div style="text-align:right; font-size: 7pt">entry #<b><?php echo $record->id; ?></b> </div>
									</div>
									<?php if (!$me->is_guest && $icon->status == 0 && (($me->is_admin) || ($icon->creator_id == $me->id))): ?>
										<div class="editable-editor">
											<form>
												<div class="form-error"></div>
												<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
												<input type="hidden" name="field_type" value="2" />
												<input type="hidden" name="field_id" value="<?php echo $record->id; ?>" />
												<textarea name="field_data"><?php echo htmlspecialchars($record->text); ?></textarea>
												<div class="form-controls">
													<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/update_field'); ?>", "area":"definition_data_<?php echo $record->id; ?>" }'>update</button>
													<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/delete_field'); ?>", "area":"definition_list" }'>delete</button>
													<button type="button" class="editable-editor-exit-button">cancel</button>
												</div>
											</form>
										</div>
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
						+ new definition
					</div>
				</div>
				<?php if (!$me->is_guest && $icon->status == 0): ?>
					<div class="editable-editor">
						<form action="<?php echo site_url('ajax/icons/add_field'); ?>">
							<div class="form-error"></div>
							<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
							<input type="hidden" name="field_type" value="2" />
							<textarea name="field_data" rows="2" placeholder="new definition"></textarea>
							<div style="text-align: right;">
								<button type="button" class="submit-button" options='{ "area":"definitions" }'>add</button>
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
			<param name="field_type" value="2" />
			<div class="part-content"></div>
		</div>		
	</div>
</div>