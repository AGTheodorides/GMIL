<div id="body_content">
	<div class="part-box">
		<div class="part-box-head"> reset password </div>
		<div class="part-box-body">
			<form>
				<div class="form-error"></div>
				<div class="form-success"></div>
				<input type="hidden" name="reset_id" value="<?php echo $reset_id ?>" />
				<table cellpadding="5" cellspacing="0" border="0" width="100%">
					<tr valign="top">
						<td>
							<table cellpadding="5" cellspacing="0" border="0" width="100%">
								<tr>
									<td>password</td>
								</tr>
								<tr>
									<td><input type="password" name="password" /></td>
								</tr>
								<tr>
									<td>password (verify)</td>
								</tr>
								<tr>
									<td><input type="password" name="password_verify" /></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class="form-controls">
					<button type="button" class="submit-button" options='{"action":"<?php echo site_url('ajax/users/reset_password'); ?>","refresh":false}'> reset password </button>
				</div>
			</form>
		</div>
	</div>
</div>