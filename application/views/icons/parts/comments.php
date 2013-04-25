<h1> comments (newest at top): </h1>
<div id="field_<?php echo $field_type ?>_comments">
	<div id="field_<?php echo $field_type ?>_comment_list" class="comment-list">
	<?php foreach($comments->result() as $record): ?>
		<table border="0" cellspacing="0" cellpadding="5" width="100%" class="data-table" style="border-bottom: 2px dotted #CCC">
			<tr valign="top">
				<td>
					<div id="field_<?php echo $field_type ?>_data_<?php echo $record->id; ?>"  class="editable">
						<div class="editable-viewer">
							<p><?php echo htmlspecialchars($record->text); ?></p>
							<span style="font-size: 7pt"><b><?php echo htmlspecialchars($record->username); ?></b></span>
							<span style="font-size: 6pt"><i><?php echo htmlspecialchars($record->creation_date); ?></i></span>
						</div>
						<div class="editable-editor">
							<form>
								<div class="form-error"></div>
								<input type="hidden" name="comment_id" value="<?php echo $record->id; ?>" />
								<textarea name="comment_text" rows="2" ><?php echo $record->text; ?></textarea>
								<div style="text-align: right;">
									<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/update_comment'); ?>" }'>update</button>
									<button type="button" class="submit-button" options='{ "action": "<?php echo site_url('ajax/icons/delete_comment'); ?>" }'>delete</button>
									<button type="button" class="editable-editor-exit-button">cancel</button>
								</div>
							</form>
						</div>
					</div>
				</td>
			</tr>
		</table>
	<?php endforeach; ?>
	</div>
	<div class="editable">
		<div class="editable-viewer">
			<div style="text-align: right;">
				+ new comment
			</div>
		</div>
		<?php if (!$me->is_guest): ?>
			<div class="editable-editor">
				<form action="<?php echo site_url('ajax/icons/add_comment'); ?>">
					<div class="form-error"></div>
					<input type="hidden" name="icon_id" value="<?php echo $icon->id; ?>" />
					<input type="hidden" name="field_type" value="<?php echo $field_type ?>" />
					<textarea name="comment_text" rows="2" placeholder="new comment"></textarea>
					<div style="text-align: right;">
						<button type="button" class="submit-button" options='{ "area":"field_<?php echo $field_type ?>_comments" }'>ok</button>
						<button type="button" class="editable-editor-exit-button">cancel</button>
					</div>
				</form>
			</div>
		<?php endif; ?>
	</div>	
</div>