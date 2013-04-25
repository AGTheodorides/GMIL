<div class="part-box">
	<div class="part-box-head"> email settings </div>
	<div class="part-box-body">
		<form>
			<div class="form-error"></div>
			<div class="form-success"></div>
			<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<tr>
					<td>
						host
					</td>
					<td>
						<input type="text" name="email_host" value="<?php echo $email_host; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						port
					</td>
					<td>
						<input type="text" name="email_port" value="<?php echo $email_port; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						username
					</td>
					<td>
						<input type="text" name="email_username" value="<?php echo $email_username; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						password
					</td>
					<td>
						<input type="password" name="email_password" value="<?php echo $email_password; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						from
					</td>
					<td>
						<input type="text" name="email_from" value="<?php echo $email_from; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						from (display name)
					</td>
					<td>
						<input type="text" name="email_from_name" value="<?php echo $email_from_name; ?>" />
					</td>
				</tr>				
			</table>
			<div style="text-align: right">
				<button class="submit-button" type="button" options='{ "action": "<?php echo site_url('ajax/admin/send_test_email'); ?>", "refresh": false }'>test</button>
				<button class="submit-button" type="button" options='{ "action": "<?php echo site_url('ajax/admin/save_email_settings'); ?>", "refresh": false }'>save</button>
			</div>
		</form>
	</div>
</div>