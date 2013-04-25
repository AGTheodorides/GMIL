<div id="sub_menu">
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td id="overview" src="<?php echo site_url('dashboard/overview'); ?>" class="sub-menu-item"> overview </td>
			<td id="alphabetical_order" src="<?php echo site_url('dashboard/view/alphabetical_order'); ?>" class="sub-menu-item"> alphabetically </td>
			<td id="recently_created" src="<?php echo site_url('dashboard/view/recently_created'); ?>" class="sub-menu-item"> recently created </td>
			<td id="recently_updated" src="<?php echo site_url('dashboard/view/recently_updated'); ?>" class="sub-menu-item"> recently updated </td>
			<td id="featured" src="<?php echo site_url('dashboard/view/featured'); ?>" class="sub-menu-item"> featured </td>
			<?php if (!$me->is_guest): ?>
				<td id="followed" src="<?php echo site_url('dashboard/view/followed'); ?>" class="sub-menu-item"> followed </td>
				<td id="my_icons" src="<?php echo site_url('dashboard/view/my_icons'); ?>" class="sub-menu-item"> my icons</td>
			<?php endif; ?>
		</tr>
	</table>
</div>