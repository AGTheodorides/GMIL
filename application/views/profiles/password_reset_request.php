<div id="body_content">
	<div class="part-box">
		<div class="part-box-head"> forgot password </div>
		<div class="part-box-body">
			<form>
				<div class="form-error"></div>
				<div class="form-success"></div>
				<table cellpadding="5" cellspacing="0" border="0" width="100%">
					<tr valign="top">
						<td>
							<table cellpadding="5" cellspacing="0" border="0" width="100%">
								<tr>
									<td>email</td>
								</tr>
								<tr>
									<td><input type="text" name="email" /></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class="form-controls">
					<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/send_password_reset_email'); ?>","refresh":false}'> reset password </button>
				</div>
			</form>
		</div>
	</div>
</div>