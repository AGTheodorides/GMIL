<div class="part-box">
	<div class="part-box-head"> <?php echo $custom_page->name; ?> </div>
	<div class="part-box-body">
		<div class="editable">
			<div class="editable-viewer">
				<?php echo $custom_page->body; ?>
			</div>
			<?php if ($me->is_admin): ?>
				<div class="editable-editor">
					<form action="<?php echo site_url('ajax/custom/update_custom_page'); ?>">
						<div class="form-error"></div>
						<input type="hidden" name="custom_page_id" value="<?php echo $custom_page->id; ?>" />
						<textarea name="body" style="height: 400px"><?php echo htmlspecialchars($custom_page->body); ?></textarea>
						<div style="text-align: right;">
							<button type="button" class="submit-button">update</button>
							<button type="button" class="editable-editor-exit-button">cancel</button>
						</div>
					</form>
				</div>
			<?php endif; ?>
		</div>	
	</div>
</div>