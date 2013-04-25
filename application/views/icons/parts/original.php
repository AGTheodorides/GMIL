<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
<div class="part-box">
	<div class="part-box-head"> original submission </div>
	<div class="part-box-body">
		<div id="original" class="big-area">
			<table cellpadding="5" cellspacing="0" border="0" width="100%">
				<tr valign="top">
					<td style="width:150px;">
						<div id="original_image_data" class="editable"  style="width:100%">
							<div class="editable-viewer big-image">
								<img src="<?php echo base_url(); ?>images/<?php echo $original_data->url; ?>?cb=<?php echo date("Y-m-d H:i:s") ?>" />
							</div>
							<?php if (!$me->is_guest && $icon->status == 0 && (($me->is_admin) || ($icon->creator_id == $me->id))): ?>
								<div class="editable-editor">
									<form action="<?php echo site_url('ajax/icons/update_original_field'); ?>">
										<div class="form-error"></div>
										<input type="hidden" name="icon_id" value="<?php echo $original_data->icon_id; ?>" />
										<input type="hidden" name="field_type" value="3" />
										<div class="part" src="<?php echo site_url('widgets/image'); ?>">
											<param name="element_id" value="original_image_update" />
											<param name="input_name" value="field_data" />
											<param name="image_url" value="<?php echo $original_data->url ?>" />
											<div class="part-content"></div>
										</div>
										<div class="form-controls">
											<button type="button" class="submit-button" options='{ "area":"original_image_data" }'>update</button>
											<button type="button" class="editable-editor-exit-button">cancel</button>
										</div>
									</form>
								</div>
							<?php endif; ?>
						</div>	
					</td>
					<td style="width: 420px;">
						<div class="big-fields">
							<div class="error"></div>
							<table cellpadding="5" cellspacing="0" border="0" width="100%">
								<tr>
									<td>
										<div id="original_title_data" class="editable"  style="width:100%">
											<div class="editable-viewer big-title">
												<p><?php echo htmlspecialchars($original_data->title_text); ?></p>
											</div>
											<?php if (!$me->is_guest && $icon->status == 0 && (($me->is_admin) || ($icon->creator_id == $me->id))): ?>
												<div class="editable-editor">
													<form action="<?php echo site_url('ajax/icons/update_original_field'); ?>">
														<div class="form-success"></div>
														<div class="form-error"></div>
														<input type="hidden" name="icon_id" value="<?php echo $original_data->icon_id; ?>" />
														<input type="hidden" name="field_type" value="1" />
														<input type="text" name="field_data" value="<?php echo htmlspecialchars($original_data->title_text); ?>" />
														<div class="form-controls">
															<button type="button" class="submit-button" options='{ "area":"original_title_data" }'>update</button>
															<button type="button" class="editable-editor-exit-button">cancel</button>
														</div>
													</form>
												</div>
											<?php endif; ?>
										</div>	
									</td>
								</tr>
								<tr>
									<td> <div class="big-field-label"> title </div> </td>
								</tr>
								<tr>
									<td>
										<div id="original_definition_data" class="editable" style="width:100%">
											<div class="editable-viewer big-definition">
												<p><?php echo htmlspecialchars($original_data->definition_text); ?></p>
											</div>
											<?php if (!$me->is_guest && $icon->status == 0 && (($me->is_admin) || ($icon->creator_id == $me->id))): ?>
												<div class="editable-editor">
													<form action="<?php echo site_url('ajax/icons/update_original_field'); ?>">
														<div class="form-success"></div>
														<div class="form-error"></div>
														<input type="hidden" name="icon_id" value="<?php echo $original_data->icon_id; ?>" />
														<input type="hidden" name="field_type" value="2" />
														<textarea name="field_data"><?php echo htmlspecialchars($original_data->definition_text); ?></textarea>
														<div class="form-controls">
															<button type="button" class="submit-button" options='{ "area":"original_definition_data" }'>update</button>
															<button type="button" class="editable-editor-exit-button">cancel</button>
														</div>
													</form>
												</div>
											<?php endif; ?>
										</div>	
									</td>
								</tr>
								<tr>
									<td> <div class="big-field-label"> definition </div> </td>
								</tr>
								<tr>
									<td>
										<div id="original_category_data"  class="editable">
											<div class="editable-viewer big-category">
												<p><?php echo htmlspecialchars($original_data->genre_text); ?> - <?php echo htmlspecialchars($original_data->category_text); ?> </p>
											</div>
											<?php if (!$me->is_guest && $icon->status == 0 && (($me->is_admin) || ($icon->creator_id == $me->id))): ?>
												<div class="editable-editor">
													<form action="<?php echo site_url('ajax/icons/update_original_field'); ?>">
														<div class="form-success"></div>
														<div class="form-error"></div>
														<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
														<input type="hidden" name="field_type" value="4" />
														<div class="part" src="<?php echo site_url('widgets/genre'); ?>">
															<param name="element_id" value="genre_select_org" />
															<param name="input_name" value="genre_id" />
															<param name="genre_id" value="<?php echo $original_data->genre_id; ?>" />
															<div class="part-content"></div>
														</div>
														<div class="part" src="<?php echo site_url('widgets/category'); ?>">
															<param name="element_id" value="category_select_org" />
															<param name="input_name" value="field_data" />
															<param name="genre_element_id" value="genre_select_org" />
															<param name="genre_id" value="<?php echo $original_data->genre_id ?>" />
															<param name="category_id" value="<?php echo $original_data->category_id; ?>" />
															<div class="part-content"></div>
														</div>
														<div class="form-controls">
															<button type="button" class="submit-button" options='{ "area":"original_category_data" }'>update</button>
															<button type="button" class="editable-editor-exit-button">cancel</button>
														</div>
													</form>
												</div>										
											<?php endif; ?>	
										</div>
									</td>
								</tr>
								<tr>
									<td> <div class="big-field-label"> category </div> </td>
								</tr>
								<tr>
									<td>
										<div id="original_theme_data"  class="editable">
											<div class="editable-viewer big-theme">
												<p><?php echo htmlspecialchars($original_data->theme_text); ?></p>
											</div>
											<?php if (!$me->is_guest && $icon->status == 0 && (($me->is_admin) || ($icon->creator_id == $me->id))): ?>
												<div class="editable-editor">
													<form action="<?php echo site_url('ajax/icons/update_original_field'); ?>">
														<div class="form-success"></div>
														<div class="form-error"></div>
														<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
														<input type="hidden" name="field_type" value="5" />
														<div class="part" src="<?php echo site_url('widgets/theme'); ?>">
															<param name="element_id" value="original_theme_entry_update" />
															<param name="input_name" value="field_data" />
															<param name="theme_id" value="<?php echo $original_data->theme_id; ?>" />
															<div class="part-content"></div>
														</div>
														<div class="form-controls">
															<button type="button" class="submit-button" options='{ "area":"original_theme_data" }'>update</button>
															<button type="button" class="editable-editor-exit-button">cancel</button>
														</div>
													</form>
												</div>
											<?php endif; ?>
										</div>
									</td>
								</tr>				
								<tr>
									<td> <div class="big-field-label"> theme </div> </td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>