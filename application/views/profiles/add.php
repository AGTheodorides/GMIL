<div id="body_content">
	<div class="part-box">
		<div class="part-box-head"> new user registration </div>
		<div class="part-box-body">
			<form action="<?php echo site_url('ajax/users/add'); ?>">
				<div class="error"></div>
				<table cellpadding="5" cellspacing="0" border="0" width="100%">
					<tr valign="top">
						<td>
							<table cellpadding="5" cellspacing="0" border="0" width="100%">
								<tr>
									<td>Username:</td>
								</tr>
								<tr>
									<td><input type="text" name="username" placeholder="username"/></td>
								</tr>
								<tr>
									<td>Email:</td>
								</tr>
								<tr>
									<td><input type="text" name="email"  placeholder="email"/></td>
								</tr>
								<tr>
									<td>Password:</td>
								</tr>
								<tr>
									<td><input type="password" name="password" placeholder="password" /></td>
								</tr>
								<tr>
									<td>Password (verify):</td>
								</tr>
								<tr>
									<td><input type="password" name="password_verify"  placeholder="verify password"/></td>
								</tr>
								<tr>
									<td>
										<input id="mapmaker_chk" type="checkbox" name="mapmaker" onclick="toggle_project()" />map maker
										<div id="project" style="display:none; padding: 5px;">
											<input type="text" name="project_name" placeholder="project name"/>
											<input type="text" name="project_url" placeholder="project url"/>
										</div>
									</td>
								</tr>
								<?php if ($me->is_admin): ?>
									<tr>
										<td>
											<input type="checkbox" name="administrator" />Administrator
										</td>
									</tr>
								<?php endif; ?>
								<tr>
									<td><input type="checkbox" name="allow_email" checked />allow emails from Icon Lab administrators</td>
								</tr>
								<tr>
									<td>Country:</td>
								</tr>
								<tr>
									<td>
										<div class="part" src="<?php echo site_url('widgets/country'); ?>">
											<param name="element_id" value="country_select" />
											<param name="input_name" value="country_id" />
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
											<div class="part-content"></div>
										</div>
									</td>
								</tr>
							</table>
							<div id="splashTarget" style="text-align:center; padding: 5px"></div>
						</td>
					</tr>
				</table>
				<div class="form-controls">
					<button type="button" class="submit-button" options='{"redirect":"<?php echo site_url('dashboard/overview'); ?>"}'>submit</button>
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
	
	$(document).ready(function() 
	{
	
		Recaptcha.create("6Le1KtsSAAAAAMpT4zwn6pBC-DIvlNxvSeHE2rKN", "splashTarget", {
			theme: "clean"
			//callback: Recaptcha.focus_response_field
		});
	
	});
	
</script>
