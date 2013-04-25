<select id="<?php echo $element_id ?>" name="<?php echo $input_name ?>" class="input-select">
<?php
	foreach($categories->result() as $record)
	{
		if ($category->id == $record->id)
		{
			echo '<option value="'.$record->id.'" selected>'.$record->text.'</option>';
		}
		else
		{
			echo '<option value="'.$record->id.'">'.$record->text.'</option>';
		}
	}
?>
</select>

<script language="javascript">

	// Add listeners
	$(document).on('change', "#<?php echo $genre_element_id ?>", function(event)
	{
		
		// Get selected genre
		var params =
			{
				element_id: "<?php echo $element_id ?>",
				input_name: "<?php echo $input_name ?>",
				genre_element_id: "<?php echo $genre_element_id ?>",
				genre_id: $("#<?php echo $genre_element_id ?>").val()
			};
			
		// Refresh this select control
		load({
			url: "<?php echo site_url('widgets'); ?>/category",
			data: params,
			target: $("#<?php echo $element_id ?>"),
			source: "#<?php echo $element_id ?>",
			help: "on_genre_change"
		});
		
	});
	
</script>