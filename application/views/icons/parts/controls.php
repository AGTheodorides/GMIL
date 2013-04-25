<div class="part-box">
	<div class="part-box-head"> controls </div>
	<div class="part-box-body">
		<form>
			<div class="form-controls">
				<div class="form-error"></div>
				<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
				
				<?php if (!$me->is_guest): ?>
					
					<?php if ($icon_is_followed == 0): ?>
						<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/follow'); ?>"}'>follow</button>
					<?php else: ?>
						<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/unfollow'); ?>"}'>unfollow</button>
					<?php endif; ?>
					
				<?php endif; ?>
				
				<?php if (($me->is_admin) || ($icon->creator_id == $me->id)): ?>
					<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/delete'); ?>", "redirect":"back"}'>delete</button>
				<?php endif; ?>

				<?php if ($me->is_admin): ?>
					
					<?php if ($icon->status == 0): ?>
						<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/finalize'); ?>", "redirect":"self"}'>finalize</button>
					<?php else: ?>
						<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/unfinalize'); ?>", "redirect":"self"}'>unfinalize</button>
					<?php endif; ?>
					
					<?php if ($icon->featured == 0): ?>
						<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/feature'); ?>"}'>feature</button>
					<?php else: ?>
						<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/unfeature'); ?>"}'>unfeature</button>
					<?php endif; ?>

				<?php endif; ?>

				<?php if (!$me->is_guest): ?>
					<?php if (@$flag): ?>
						<input type="hidden" name="flag_id" value="<?php echo $flag->id; ?>" />
						<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/unflag'); ?>"}'>unflag</button>
					<?php else: ?>
						<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/flag'); ?>"}'>flag</button>
					<?php endif; ?>
				<?php endif; ?>
				
			</div>		

		</form>
		<?php if (@$flag): ?>
			<form action="<?php echo site_url('ajax/icons/set_flag_reason'); ?>">
				<div class="form-success"></div>
				<div class="form-error"></div>
				<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
				<input type="hidden" name="flag_id" value="<?php echo $flag->id; ?>" />
				<div>
					Flag reason:
				</div>
				<div>
					<textarea name="reason" placeholder="reason"><?php echo htmlspecialchars($flag->reason) ?></textarea>
				</div>
				<div class="form-controls">
					<button type="button" class="submit-button" options='{"refresh":false}'>update</button>
				</div>				
			</form>
		<?php endif; ?>
	</div>
</div>