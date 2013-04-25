<div id="body_content" class="data-table">

	<div style="float: left; width:49.5%;">
		<div class="part" src="<?php echo site_url('dashboard/recently_updated') ?>">
			<param name="limit" value="<?php echo $my_icons_limit ?>" />
			<div class="part-content"></div>
		</div>
		<div class="part" src="<?php echo site_url('dashboard/recently_created')?>">
			<param name="limit" value="<?php echo $my_icons_limit ?>" />
			<div class="part-content"></div>
		</div>
		<?php if (!$me->is_guest): ?>
			<div class="part" src="<?php echo site_url('dashboard/followed') ?>">
				<param name="limit" value="<?php echo $my_icons_limit ?>" />
				<div class="part-content"></div>
			</div>
		<?php endif; ?>
	</div>
	
	<div style="float:right; width:49.5%;">
		<div class="part" src="<?php echo site_url('dashboard/featured') ?>">
			<param name="limit" value="<?php echo $my_icons_limit ?>" />
			<div class="part-content"></div>
		</div>
		<?php if (!$me->is_guest): ?>
			<div class="part" src="<?php echo site_url('dashboard/my_icons') ?>">
				<param name="limit" value="<?php echo $my_icons_limit ?>" />
				<div class="part-content"></div>
			</div>
		<?php endif; ?>
	</div>
	
	<div style="clear:both;"></div>
		
</div>
		
<script language="javascript">

	function edit_icon(id)
	{
		navigate_to("<?php echo site_url('icons/edit') ?>/" + id);
	}

</script>