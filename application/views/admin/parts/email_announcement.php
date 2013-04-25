<div class="part-box">
	<div class="part-box-head"> email announcement </div>
	<div class="part-box-body">
		<form action='<?php echo site_url('ajax/admin/send_email'); ?>'>
			<div class="error"></div>
			<div class="success"></div>
			<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-bottom: 2px dotted #999;">
				<tr>
					<td>
						subject
					</td>
					<td>
						<input type="text" name="subject" />
					</td>
				</tr>
				<tr>
					<td>
						body
					</td>
					<td>
						<textarea name="body"></textarea>
					</td>
				</tr>
			</table>
			<div style="text-align: right">
				<button onclick="return submit_form(this, { refresh: false });">send</button>
			</div>
		</form>
	</div>
</div>