<div class="part-box">
	<div class="part-box-head"> properties </div>
	<div class="part-box-body">
		<table cellpadding="5" cellspacing="0" border="0" width="100%">
			<tr>
				<td>creator</td>
				<td><i><?php echo @$creator->username; ?></i></td>
			</tr>
			<tr>
				<td>created</td>
				<td><i><?php echo @$icon->creation_date; ?></i></td>
			</tr>
			<tr>
				<td>modifed</td>
				<td><i><?php echo @$icon->update_date; ?></i></td>
			</tr>
			<tr>
				<td>flagged by</td>
				<td><i><?php echo @$icon->flag_count; ?> user(s)</i></td>
			</tr>
		</table>
	</div>
</div>