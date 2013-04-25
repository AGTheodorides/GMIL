<div id="login" class="login" onclick="show_login_dialog();">
	<div class="login-head">
		<img src="<?php echo base_url(); ?>images/no_user.jpg"/>
		<?php if ($me->is_guest): ?>
			<div> sign in </div>
		<?php else: ?>
			<div><?php echo $me->username; ?></div>
		<?php endif;?>
		<?php if (!$me->is_special && (!$me->is_email_verified || $me->warning_text != '')): ?>
			<div class='login-badge badge'> ! </div>
		<?php endif;?>
	</div>
	<div class="login-body">
		<div id="login_error" class="form-error"></div>
		<?php if ($me->is_guest): ?>
			<form id="login_dialog_form" action="<?php echo site_url('ajax/users/sign_in'); ?>">
				<table cellpadding="5" cellspacing="0" border="0" width="100%">
					<tr>
						<td><input class="input-text" id="username" name="username" type="text" placeholder="username" /></td>
					</tr>
					<tr>
						<td><input class="input-text" name="password" type="password" placeholder="password" /></td>
					</tr>
					<tr>
						<td><input class="input-check" type="checkbox" name="remember_me" style="width: 20px;" /> remember me </td>
					</tr>
				</table>
				<p>
					<a href="<?php echo site_url('profiles/password_reset') ?>"> forgot password </a>
				</p>
				<div class="form-controls">
					<button onclick="return login_dialog_submit();"> sign in </button>
					<button onclick="return login_dialog_register();"> register </button>
				</div>
			</form>
		<?php else: ?>
			<form id="login_dialog_form" action="<?php echo site_url('ajax/users/sign_off'); ?>">
				<p>
					Logged on as <b><?php echo $me->username; ?></b>.
				</p>
				<?php if (!$me->is_special && !$me->is_email_verified): ?>
					<p class="error">
						<a href="<?php echo site_url('profiles/edit') ?>">Your email is not verified.</a>
					</p>
				<?php endif; ?>
				<?php if ($me->warning_text): ?>
					<p class="error">
						<?php echo $me->warning_text ?>
					</p>
				<?php endif; ?>
				<div class="form-controls">
					<button onclick="return login_dialog_submit();"> sign off </button>
				</div>
			</form>
		<?php endif; ?>
	</div>
</div>
	
<script language="javascript">


	$('.login-head').mouseover(function(){
		if (!$(this).hasClass('login-selected'))
		{
			$(this).addClass('login-highlight');
		}
	});

	$('.login-head').mouseout(function(){
		if (!$(this).hasClass('login-selected'))
		{
			$(this).removeClass('login-highlight');
		}
	});

	$('.login-head').click(function(){
	
		if (!$(this).hasClass('login-selected'))
		{
			$(this).addClass('login-selected', 100);
			$('.login-body').fadeIn(100);
		}
		else
		{
			$(this).removeClass('login-selected', 100);
			$('.login-body').fadeOut(100);
		}
	
	});

	function login_dialog_account(user_id)
	{
		navigate_to("<?php echo site_url('profile/edit_profile'); ?>/" + user_id);
	}

	function login_dialog_register()
	{
		navigate_to("<?php echo site_url('profiles/add'); ?>");
	}
	
	function login_dialog_submit()
	{
	
		$("#login_dialog_form").ajaxSubmit({
			url: $("#login_dialog_form").attr('action'),
			type: "POST",
			resetForm: true,
			success: function(responseText, statusText)
			{
				try
				{
				
					var response = JSON.parse(responseText);
					
					if (response.success)
					{
						
						load(
						{
							url: '<?php echo site_url('widgets/login_widget'); ?>',
							target: 'login'
						});
						
						navigate_to("<?php echo site_url('dashboard/overview'); ?>");
						
						$("#login_dialog").dialog("close");
						
					}
					else
					{
						$("#login_error").fadeIn();
						$("#login_error").html(response.message).fadeIn();
					}
					
				}
				catch(e)
				{
					$("#login_error").fadeIn();
					$("#login_error").html('<p onclick="$(this).next().fadeToggle();"> there was an error completing the request. (controller) </p><div class="error-content"> <p>error=' + e + '</p><p>responseText='  + responseText + '</p></div>').fadeIn();
				}
				
			},
			error: function(xhr)
			{
				$("#login_error").fadeIn();
				$("#login_error").html('<p onclick="$(this).next().fadeIn();"> there was an error completing the request. (ajax) </p><div class="error-content"> <p>statusText=' + xhr.statusText + '</p><p>responseText='  + xhr.responseText + '</p></div>').fadeIn();
			}
		});
		
		return false;

	}

</script>