<div class="part-box">
	<div class="part-box-head"> email notifications </div>
	<div class="part-box-body">
		<form action="<?php echo site_url('ajax/admin/save_email_notifications'); ?>">
			<div class="form-error"></div>
			<div class="form-success"></div>
			<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<tr>
					<td>
						email verification subject
					</td>
					<td>
						<input type="text" name="email_verification_subject" value="<?php echo $email_verification_subject; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						email verification body
					</td>
					<td>
						<textarea name="email_verification_body"> <?php echo htmlspecialchars($email_verification_body); ?> </textarea>
					</td>
				</tr>
				<tr>
					<td>
						password reset subject
					</td>
					<td>
						<input type="text" name="password_reset_subject" value="<?php echo $password_reset_subject; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						password reset body
					</td>
					<td>
						<textarea name="password_reset_body"> <?php echo htmlspecialchars($password_reset_body); ?> </textarea>
					</td>
				</tr>
			</table>
			<div style="text-align: right">
				<button class="submit-button" type="button"  options='{ "refresh": false }'>save</button>
			</div>
		</form>
	</div>
</div>