<div class="editable">
	<div class="editable-viewer">
		<?php echo $custom_page->body; ?>
	</div>
	<?php if ($me->level == 3): ?>
		<div class="editable-editor">
			<form action="<?php echo site_url('ajax/admin/update_custom_page'); ?>">
				<div class="error"></div>
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