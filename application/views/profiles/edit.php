<div id="body_content">
	<div class="part-box">
		<div class="part-box-head"> update user </div>
		<div class="part-box-body">
			<form>
				<input type="hidden" name="user_id" value="<?php echo $user->id; ?>" />
				<div class="form-error"></div>
				<div class="form-success"></div>
				<table cellpadding="5" cellspacing="0" border="0" width="100%">
					<tr valign="top">
						<td>
							<table cellpadding="5" cellspacing="0" border="0" width="100%">
								<tr>
									<td>Username:</td>
								</tr>
								<tr>
									<td><input type="text" name="username"  value="<?php echo $user->username; ?>"  placeholder="username"/></td>
								</tr>
								<tr>
									<td>Email:</td>
								</tr>
								<tr>
									<td><input type="text" name="email" value="<?php echo $user->email; ?>" placeholder="email" /></td>
								</tr>
								<tr>
									<td>Password:</td>
								</tr>
								<tr>
									<td><input type="password" name="password" value="no_change" placeholder="password"/></td>
								</tr>
								<tr>
									<td>Password (verify):</td>
								</tr>
								<tr>
									<td><input type="password" name="password_verify" value="no_change" placeholder="verify password"/></td>
								</tr>
								<tr>
									<td>
										<input id="mapmaker_chk" type="checkbox" name="is_mapmaker" <?php echo $user->is_mapmaker ? 'checked' : '' ?> onclick="toggle_project()" /> map maker
										<div id="project" style="display: <?php echo $user->is_mapmaker ? '' : 'none' ?> ; padding: 5px;" >
											<input type="text" name="project_name" value="<?php echo $user->project_name; ?>" placeholder="project name"/>
											<input type="text" name="project_url" value="<?php echo $user->project_url; ?>" placeholder="project url"/>
										</div>
									</td>
								</tr>
								<?php if ($me->is_admin): ?>
									<tr>
										<td>
											<input type="checkbox" name="is_admin" <?php echo $user->is_admin ? 'checked' : '' ?> /> administrator
										</td>
									</tr>
								<?php endif; ?>
								<tr>
									<td><input type="checkbox" name="allow_email" value='1' <?php echo $user->allow_email == 1 ? 'checked' : ''; ?> /> allow emails from Icon Lab administrators</td>
								</tr>
								<tr>
									<td>Country:</td>
								</tr>
								<tr>
									<td>
										<div class="part" src="<?php echo site_url('widgets/country'); ?>">
											<param name="element_id" value="country_select" />
											<param name="input_name" value="country_id" />
											<param name="country_id" value="<?php echo $user->country_id; ?>" />
											<div class="part-content"></div>
										</div>
									</td>
								</tr>				
								<tr>
									<td>Language:</td>
								</tr>
								<tr>
									<td>
										<div class="part" src="<?php echo site_url('widgets/language'); ?>">
											<param name="element_id" value="language_select" />
											<param name="input_name" value="language_id" />
											<param name="language_id" value="<?php echo $user->language_id; ?>" />
											<div class="part-content"></div>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<?php if ($me->is_admin && !$user->is_special): ?>
					<div id="warning" style="padding:10px">
						<input type="text" name="warning_text" placeholder="warning text" value="<?php echo $user->warning_text; ?>" />
						<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/warn'); ?>","refresh":false}'>warn</button>
					</div>
				<?php endif; ?>
				<div id="controls" class="form-controls">
					<?php if ($me->is_admin): ?>
						<?php if (!$user->is_special): ?>
							<?php if($user->is_banned): ?>
								<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/unban'); ?>","area":"controls"}'>unban</button>
							<?php else: ?>
								<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/ban'); ?>","area":"controls"}'>ban</button>
							<?php endif; ?>
							<?php if ($me->id != $user->id): ?>
								<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/delete'); ?>","redirect":"back"}'>delete</button>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
					<?php if (!$me->is_email_verified && $me->id == $user->id): ?>
						<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/send_verification_email'); ?>","refresh":false}'>verify email</button>
					<?php endif; ?>
					<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/update'); ?>","refresh":false,"parts":"#login"}'> update</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script language="javascript">
	
	function toggle_project()
	{
		if($('#mapmaker_chk').attr('checked'))
		{
			$('#project').slideDown();
		}
		else
		{
			$('#project').slideUp();
		}
	}
	
</script>