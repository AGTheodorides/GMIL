<table>
	<tr style="font-size:9pt; text-align:center">
		<td rowspan="3" width="50px"> 
			<?php if (!$me->is_guest && $icon->status == 0): ?>
				<div class="voter">
					<div>
						<form action="<?php echo site_url('ajax/icons/vote_up'); ?>">
							<input type="hidden" name="icon_id" value="<?php echo $votes->icon_id; ?>" />
							<input type="hidden" name="field_type" value="<?php echo $votes->field_type; ?>" />
							<input type="hidden" name="field_id" value="<?php echo $votes->field_id; ?>" />
							<img src="<?php echo base_url(); ?>images/arrow_up<?php echo $has_voted ? '_disabled' : ''; ?>.png" onclick='submit_form_data(this, {"parts":"parent"});' title="vote 'yes'" alt="vote 'yes'"/>
						</form>
					</div>
					<div <?php echo $has_voted ? 'style="color:#AAA"' : ''; ?>> 
						<?php echo $votes->vote_count; ?></div>
					<div>
						<form action="<?php echo site_url('ajax/icons/vote_down'); ?>">
							<input type="hidden" name="icon_id" value="<?php echo $votes->icon_id; ?>" />
							<input type="hidden" name="field_type" value="<?php echo $votes->field_type; ?>" />
							<input type="hidden" name="field_id" value="<?php echo $votes->field_id; ?>" />
							<img src="<?php echo base_url(); ?>images/arrow_down<?php echo $has_voted ? '_disabled' : ''; ?>.png" onclick='submit_form_data(this, {"parts":"parent"});' title="vote 'no'" alt="vote 'no'"/>
						</form>
					</div>
				</div>
			<?php endif; ?>
		</td>
		<td colspan="2" width="120px"> community </td>
		<td colspan="2" width="120px"> mapmakers </td>
	</tr>
	<tr style="font-size:8pt; text-align:center">
		<td style="color:#080;"> yes </td>
		<td style="color:#900;"> no </td>
		<td style="color:#080;"> yes </td>
		<td style="color:#900;"> no </td>
	</tr>
	<tr style="font-size:8pt; font-weight:bold; text-align:center">
		<td style="color:#080;"> <?php echo $votes->community_yes_votes; ?> </td>
		<td style="color:#900;"> <?php echo $votes->community_no_votes; ?>  </td>
		<td style="color:#080;"> <?php echo $votes->mapmaker_yes_votes; ?>  </td>
		<td style="color:#900;"> <?php echo $votes->mapmaker_no_votes; ?>  </td>
	</tr>
</table>