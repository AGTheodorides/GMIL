<div class="part-box">
	<div class="part-box-head"> notifications </div>
	<div class="part-box-body">
		<form action="<?php echo site_url('ajax/admin/save_notifications'); ?>">
			<div class="form-error"></div>
			<div class="form-success"></div>
			<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<tr>
					<td>
						User registration
					</td>
					<td>
						<input type="text" name="user_registration" value="<?php echo $user_registration; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						User login
					</td>
					<td>
						<input type="text" name="user_login" value="<?php echo $user_login; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						User email verification
					</td>
					<td>
						<input type="text" name="user_email_verification" value="<?php echo $user_email_verification; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						User ban
					</td>
					<td>
						<input type="text" name="user_ban" value="<?php echo $user_ban; ?>" />
					</td>
				</tr>
			</table>
			<div style="text-align: right">
				<button class="submit-button" type="button"  options='{ "refresh": false }'>save</button>
			</div>
		</form>
	</div>
</div>