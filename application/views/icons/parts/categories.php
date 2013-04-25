<div class="part-box">
	<div class="part-box-head"> category </div>
	<div class="part-box-body">
		<div id="category_entries">
			<div id="category_entry_list">
				<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #CCC">
					<?php foreach($icon_category_entries->result() as $record): ?>
						<tr>
							<td width="250px">
								<!-- Voter -->
								<div class="part" src="<?php echo site_url('icons/voter') ?>">
									<param name="icon_id" value="<?php echo $icon->id ?>" />
									<param name="field_type" value="4" />
									<param name="field_id" value="<?php echo $record->id ?>" />
									<div class="part-content"></div>
								</div>
							</td>
							<td>
								<div id="category_entry_data_<?php echo $record->id; ?>" class="editable">
									<div class="editable-viewer">
										<?php echo htmlspecialchars($record->genre_text); ?> - 
										<?php echo htmlspecialchars($record->category_text); ?>
										<div style="text-align:right; font-size: 7pt">entry #<b><?php echo $record->id; ?></b> </div>
									</div>
									<?php if (!$me->is_guest && $icon->status == 0): ?>
										<?php if (($me->is_admin) || ($icon->creator_id == $me->id)): ?>
											<div class="editable-editor">
												<form>
													<div class="form-error"></div>
													<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
													<input type="hidden" name="field_type" value="4" />
													<input type="hidden" name="field_id" value="<?php echo $record->id; ?>" />
													<!-- Genre -->
													<div class="part" src="<?php echo site_url('widgets/genre') ?>">
														<param name="element_id" value="<?php echo 'genre_select_'.$record->id ?>" />
														<param name="input_name" value="genre_id" />
														<param name="genre_id" value="<?php echo $record->genre_id ?>" />
														<div class="part-content"></div>
													</div>
													<!-- Category -->
													<div class="part" src="<?php echo site_url('widgets/category') ?>">
														<param name="element_id" value="<?php echo 'category_select_'.$record->id ?>" />
														<param name="input_name" value="field_data" />
														<param name="genre_element_id" value="<?php echo 'genre_select_'.$record->id ?>" />
														<param name="genre_id" value="<?php echo $record->genre_id ?>" />
														<param name="category_id" value="<?php echo $record->category_id ?>" />
														<div class="part-content"></div>
													</div>
													<div class="form-controls">
														<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/update_field'); ?>", "area":"category_entry_data_<?php echo $record->id; ?>" }'>update</button>
														<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/delete_field'); ?>", "area":"category_entry_list" }'>delete</button>
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
			<!-- New category -->
			<div class="editable">
				<div class="editable-viewer">
					<div style="text-align: right;">
						+ new category
					</div>
				</div>
				<div class="editable-editor">
					<?php if (!$me->is_guest && $icon->status == 0): ?>
						<form action="<?php echo site_url('ajax/icons/add_field'); ?>">
							<div class="form-error"></div>
							<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
							<input type="hidden" name="field_type" value="4" />
							<table border="0" cellspacing="0" cellpadding="5" style="width: 100%">
								<tr class="data-table-body-row">
									<td>
										<div src="<?php echo site_url('widgets/genre'); ?>" class="part">
											<param name="element_id" value="genre_select" />
											<param name="input_name" value="genre_id" />
											<div class="part-content"></div>
										</div>
									</td>
									<td>
										<div id="category_widget" src="<?php echo site_url('widgets/category'); ?>" class="part">
											<param name="element_id" value="category_select" />
											<param name="input_name" value="field_data" />
											<param name="genre_element_id" value="genre_select" />
											<div class="part-content"></div>
										</div>
									</td>
								</tr>
							</table>
							<div class="form-controls">
								<button type="button" class="submit-button" options='{ "area":"category_entries" }'>add</button>
								<button type="button" class="editable-editor-exit-button">cancel</button>
							</div>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- Comments -->
		<div class="part" src="<?php echo site_url('icons/comments').'/'.$icon->id ?>">
			<param name="icon_id" value="<?php echo $icon->id?>" />
			<param name="field_type" value="4" />
			<div class="part-content"></div>
		</div>
	</div>
</div>
