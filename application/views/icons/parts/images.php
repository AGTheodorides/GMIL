<div class="part-box">
	<div class="part-box-head"> image </div>
	<div class="part-box-body">
		<div id="images">
			<div id="image_list" class="field-list">
				<table border="0" cellspacing="0" cellpadding="5" width="100%">
					<?php foreach($icon_images->result() as $record): ?>
						<tr>
							<td width="250px">
								<!-- Voter -->
								<div class="part" src="<?php echo site_url('icons/voter') ?>">
									<param name="icon_id" value="<?php echo $icon->id ?>" />
									<param name="field_type" value="3" />
									<param name="field_id" value="<?php echo $record->id ?>" />
									<div class="part-content"></div>
								</div>
							</td>
							<td>
								<div id="image_data_<?php echo $record->id; ?>" class="editable">
									<div class="editable-viewer">
										<div style="text-align:center;">
											<img src="<?php echo base_url(); ?>images/<?php echo $record->url; ?>" width="50px" height="50px"  style="background-color: #FFF; box-shadow: 0px 0px 10px #547D50;"/>
										</div>
										<div style="text-align:right; font-size: 7pt">entry #<b><?php echo $record->id; ?></b> </div>
									</div>
									<?php if (!$me->is_guest && $icon->status == 0): ?>
										<?php if (($me->is_admin) || ($icon->creator_id == $me->id)): ?>
											<div class="editable-editor">
												<form>
													<div class="form-error"></div>
													<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
													<input type="hidden" name="field_type" value="3" />
													<input type="hidden" name="field_id" value="<?php echo $record->id; ?>" />
													<div style="text-align:center;">
														<img src="<?php echo base_url(); ?>images/<?php echo $record->url; ?>" width="50px" height="50px"  style="background-color: #FFF; box-shadow: 0px 0px 10px #547D50;"/>
													</div>
													<div class="form-controls">
														<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/delete_field'); ?>", "area":"image_list" }'>delete</button>
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
						+ new image
					</div>
				</div>
				<?php if (!$me->is_guest): ?>
					<div class="editable-editor">
						<form action="<?php echo site_url('ajax/icons/add_field'); ?>">
							<div class="form-error"></div>
							<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
							<input type="hidden" name="field_type" value="3" />
							<div class="part" src="<?php echo site_url('widgets/image'); ?>">
								<param name="element_id" value="new_image" />
								<param name="input_name" value="field_data" />
								<div class="part-content"></div>
							</div>
							<div class="form-controls">
								<button type="button" class="submit-button" options='{ "area":"images" }'>add</button>
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
			<param name="field_type" value="3" />
			<div class="part-content"></div>
		</div>
	</div>
</div>