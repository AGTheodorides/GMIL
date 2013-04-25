<div id="body_content" class="main-form">
	
	<?php if ($icon->status == 0): ?>
		
		<div style="float: left; width:62%;">
			<div class="part" src="<?php echo site_url('icons/original') ?>">
				<param name="icon_id" value="<?php echo $icon->id?>" />
				<div class="part-content"></div>
			</div>
		</div>
		
		<div style="float:right; width:37%;">
			<div class="part" src="<?php echo site_url('icons/controls').'/'.$icon->id ?>">
				<param name="icon_id" value="<?php echo $icon->id?>" />
				<div class="part-content"></div>
			</div>
			<div class="part" src="<?php echo site_url('icons/properties').'/'.$icon->id ?>">
				<param name="icon_id" value="<?php echo $icon->id?>" />
				<div class="part-content"></div>
			</div>
		</div>
		
		<div style="clear:both;"></div>
		
		<div class="part" src="<?php echo site_url('icons/images').'/'.$icon->id ?>">
			<param name="icon_id" value="<?php echo $icon->id?>" />
			<div class="part-content"></div>
		</div>
		<div class="part" src="<?php echo site_url('icons/titles').'/'.$icon->id ?>">
			<param name="icon_id" value="<?php echo $icon->id?>" />
			<div class="part-content"></div>
		</div>
		<div class="part" src="<?php echo site_url('icons/definitions').'/'.$icon->id ?>">
			<param name="icon_id" value="<?php echo $icon->id?>" />
			<div class="part-content"></div>
		</div>
		<div class="part" src="<?php echo site_url('icons/category_entries').'/'.$icon->id ?>">
			<param name="icon_id" value="<?php echo $icon->id?>" />
			<div class="part-content"></div>
		</div>
		<div class="part" src="<?php echo site_url('icons/theme_entries').'/'.$icon->id ?>">
			<param name="icon_id" value="<?php echo $icon->id?>" />
			<div class="part-content"></div>
		</div>

	<?php else: ?>
	
		<div style="float: left; width:62%;">
			<div class="part" src="<?php echo site_url('icons/finalized').'/'.$icon->id ?>">
				<param name="icon_id" value="<?php echo $icon->id?>" />
				<div class="part-content"></div>
			</div>
		</div>
		
		<div style="float:right; width:37%;">
			<div class="part" src="<?php echo site_url('icons/controls').'/'.$icon->id ?>">
				<param name="icon_id" value="<?php echo $icon->id?>" />
				<div class="part-content"></div>
			</div>
			<div class="part" src="<?php echo site_url('icons/properties').'/'.$icon->id ?>">
				<param name="icon_id" value="<?php echo $icon->id?>" />
				<div class="part-content"></div>
			</div>
		</div>
		
		<div style="clear:both;"></div>

	<?php endif; ?>

</div>