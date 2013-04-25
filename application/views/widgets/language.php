<select id="<?php echo $element_id ?>" name="<?php echo $input_name ?>" class="input-select">
<?php
	foreach($languages->result() as $record)
	{
		if ($language->id == $record->id)
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