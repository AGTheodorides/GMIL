<div id="welcome">

	<div class="welcome-header"><img src="<?php echo base_url(); ?>images/header.png" width="100%" /></div>

	<div class="welcome-text" style="width: 50%; float: left;">
	  <h1>Welcome!</h1>
	  <p style="font-size: 14pt">
		Everyone is welcome to sign up and contribute to this global process. 
		Or, <a href="<?php echo site_url('dashboard/overview'); ?>">explore as a guest</a>.
	  </p>
	  <p>
		Take part in the latest evolution of the Green Map Icons.
		This globally designed symbol <a href="http://www.greenmap.org/greenhouse/files/gms/GreenMap_IconsV3_Poster.pdf" target="_blank">set</a> has been used on hundreds
		of locally created and interactive Green Maps to chart nature,
		culture, activism and green living resources, as seen at 
		<a href="http://www.greenmap.org" target="_blank">GreenMap.org</a>.
	  </p>
	  <p>
		Get involved as the Green Mapmaker in your community &#45; <a href="http://GreenMap.org/join" target="_blank">GreenMap.org/join</a>
	  </p>
	</div>
	<div class="welcome-form" style="width: 45%; float: right;">
		<h1>Sign up</h1>
		<form action='<?php echo site_url('ajax/users/add'); ?>'>
			<div class="form-error"></div>
			<p>username</p>
			<input type="text" name="username" />
			<p>password</p>
			<input type="password" name="password" />
			<p>password (verify)</p>
			<input type="password" name="password_verify" />
			<p>email</p>
			<input type="text" name="email" />
			<p>country</p>
			<div class="part" src="<?php echo site_url('widgets/country'); ?>">
				<param name="element_id" value="country_select" />
				<param name="input_name" value="country_id" />
				<div class="part-content"></div>
			</div>
			<p>language</p>
			<div class="part" src="<?php echo site_url('widgets/language'); ?>">
				<param name="element_id" value="language_select" />
				<param name="input_name" value="language_id" />
				<div class="part-content"></div>
			</div>
			<p>
				<input type="checkbox" name="is_mapmaker" /> I am a map maker!
			</p>
			<div id="splashTarget" style="text-align:center; padding: 5px"></div>
			<div class="form-controls">
				<button type="button" class="submit-button" options='{ "redirect": "<?php echo site_url('dashboard/overview'); ?>" }'>sign up!</button>
			</div>
		</form>
	</div>
	<div style="clear:both;"></div>
</div>
			
<script language="javascript">

	// Add non-part submit listeners
	add_submit_listeners($("#welcome"));

	Recaptcha.create("6Le1KtsSAAAAAMpT4zwn6pBC-DIvlNxvSeHE2rKN", "splashTarget", {
		theme: "clean"
		//callback: Recaptcha.focus_response_field
	});
		
</script>