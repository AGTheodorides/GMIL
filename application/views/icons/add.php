<div id="body_content">
	<div class="part-box">
		<div class="part-box-head"> submit new icon </div>
		<div class="part-box-body">
			<?php if (!$me->is_guest): ?>
				<form action="<?php echo site_url('ajax/icons/add'); ?>">
					<div class="form-success"></div>
					<div class="form-error"></div>
					<table cellpadding="5" cellspacing="0" border="0" width="100%">
						<tr valign="top">
							<td style="width:150px;">
								<table cellpadding="5" cellspacing="0" border="0">
									<tr>
										<td>image</td>
									</tr>
									<tr>
										<td>
											<div class="part" src="<?php echo site_url('widgets/image'); ?>">
												<param name="element_id" value="avatar" />
												<param name="input_name" value="temp_image_url" />
												<?php if (isset($user->image_url) && $user->image_url != ''): ?>
													<param name="image_url" value="<?php echo $user->image_url ?>" />
												<?php endif; ?>
												<div class="part-content"></div>
											</div>
										</td>
									</tr>
								</table>
							</td>			
							<td>
								<table cellpadding="5" cellspacing="0" border="0" width="100%">
									<tr valign="top">
										<td>title</td>
									</tr>
									<tr valign="top">
										<td><input type="text" name="title_text" placeholder="new icon title" /></td>
									</tr>
									<tr valign="top">
										<td>definition</td>
									</tr>
									<tr valign="top">
										<td><textarea name="definition_text" rows="3" placeholder="new definition"></textarea></td>
									</tr>
									<tr valign="top">
										<td>genre</td>
									</tr>
									<tr valign="top">
										<td>
											<div class="part" src="<?php echo site_url('widgets/genre'); ?>">
												<param name="element_id" value="genre_select" />
												<param name="input_name" value="genre_id" />
												<div class="part-content"></div>
											</div>
										</td>
									</tr>
									<tr valign="top">
										<td>category</td>
									</tr>
									<tr valign="top">
										<td>
											<div class="part" src="<?php echo site_url('widgets/category'); ?>">
												<param name="element_id" value="category_select" />
												<param name="input_name" value="category_id" />
												<param name="genre_element_id" value="genre_select" />
												<div class="part-content"></div>
											</div>
										</td>
									</tr>
									<tr valign="top">
										<td>theme</td>
									</tr>
									<tr valign="top">
										<td>
											<div class="part" src="<?php echo site_url('widgets/theme'); ?>">
												<param name="element_id" value="theme_id" />
												<param name="input_name" value="theme_id" />
												<div class="part-content"></div>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<div class="form-controls">
						<button type="button" class="submit-button" options='{ "redirect": "<?php echo site_url('dashboard/overview'); ?>" }'>submit</button>
					</div>
				</form>
			<?php endif; ?>
		</div>
	</div>
</div>