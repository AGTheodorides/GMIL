<div class="part-box">
	<div class="part-box-head"> <?php echo $title; ?> </div>
	<div class="part-box-body">
		<table border="0" cellspacing="0" cellpadding="5" style="width: 100%" class="data-table">
			<?php $count = 0 ?>
			<?php foreach ($icons->result() as $record): ?>
				<tr class="table-row" onclick="edit_icon('<?php echo $record->id; ?>');">
					<td width="60px">
						<?php if (isset($record->image_url) && $record->image_url != '' ): ?>
							<img src="<?php echo base_url(); ?>images/<?php echo $record->image_url; ?>" width="50px" height="50px" style="background-color: #FFF; box-shadow: 0px 0px 10px #547D50;" />
						<?php else: ?>
							<img src="<?php echo base_url(); ?>images/no_icon.png" width="50px" height="50px" style="background-color: #FFF; box-shadow: 0px 0px 10px #547D50;" />
						<?php endif; ?>
					</td>
					<td>
						<div style="font-size: 12pt; margin-bottom: 5px;">
							<?php if (isset($record->title_text) && $record->title_text != '' ): ?>
								<i><?php echo $record->title_text; ?></i>
							<?php else: ?>
								<i> untitled </i>
							<?php endif; ?>
						</div>
						<div style="font-size: 6pt"><i><?php echo $record->update_date; ?></i></div>
					</td>
					<td width="50px">
						<?php if ($record->status == 1): ?>
							<img src="<?php echo base_url(); ?>images/check_mark.png" width="25px" height="25px" />
						<?php endif; ?>
					</td>
				</tr>
			<?php
				
				$count = $count + 1;
				
				if ($count == $limit)
				{
					break;
				}
				
			?>
			<?php endforeach; ?>
		</table>
	</div>
</div>