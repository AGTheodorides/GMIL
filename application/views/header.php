<!DOCTYPE html>
<html>

	<head>
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<meta charset="utf-8"/>
		
		<meta name="google-translate-customization" content="a0ee472aebe5293-0cb64c68f1de51b5-g4bc991b4b0cbd4d8-26" />

		<title>Green Map Icon Tool</title>

		<!-- Style sheets -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery/jquery-ui.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery/jquery.Jcrop.min.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/base.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/common.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/menu.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/parts.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/editor.css" type="text/css" media="screen" />

		<!-- Script libraries -->
		<script src="<?php echo base_url(); ?>scripts/jquery/jquery-1.8.3.js"></script>
		<script src="<?php echo base_url(); ?>scripts/jquery/jquery-ui.js"></script>
		<script src="<?php echo base_url(); ?>scripts/jquery/jquery.form.js"></script>
		<script src="<?php echo base_url(); ?>scripts/jquery/jquery.Jcrop.min.js"></script>
		<script src="<?php echo base_url(); ?>scripts/navigation.js"></script>
		<script src="<?php echo base_url(); ?>scripts/form.js"></script>
		<script src="<?php echo base_url(); ?>scripts/parts.js"></script>
		<script src="<?php echo base_url(); ?>scripts/menu.js"></script>
		<script src="<?php echo base_url(); ?>scripts/table.js"></script>
		
		<!-- reCaptcha -->		
		<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
              
	</head>
	
	<body>
		
		<div id="header">
			<span style="color: #8CC63F;">GREEN MAP</span> <span style="color: #C6006F;">ICON LAB</span>
		</div>
		<div id="main_menu">
			<table cellpadding="0" cellspacing="0" border="0" width="1000px">
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="main-menu">
							<tr>
								<td style="text-align:left;">
									<table cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td id="dashboard" src="<?= site_url('dashboard/overview') ?>" class="main-menu-item" > dashboard </td>
											<td id="submit_icon" src="<?= site_url('icons/add') ?>" class="main-menu-item" > submit icon </td>
											<td id="news" src="<?= site_url('news') ?>" class="main-menu-item"> news </td>
											<td id="faq" src="<?= site_url('faq') ?>" class="main-menu-item"> faq </td>
											<?php if ($me->id != 1): ?>
											<td id="my_account" src="<?= site_url('profiles/edit') ?>" class="main-menu-item"> my account </td>
											<?php else: ?>
											<td id="my_account" src="<?= site_url('profiles/add') ?>" class="main-menu-item"> my account </td>
											<?php endif; ?>
											<?php if ($me->is_admin): ?>
											<td id="admin" src="<?= site_url('admin/users') ?>" class="main-menu-item"> admin </td>
											<?php endif; ?>
										</tr>
									</table>
								</td>
								<td>
									<div id="google_translate_element"></div>
									<script type="text/javascript">
										function googleTranslateElementInit()
										{
											new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
										}
									</script>
									<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
								</td>
								<td width="50px" style="text-align:right;">
									<div id='login' class="part" src="<?php echo site_url('profiles/login'); ?>">
										<div class="part-content"></div>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		
		<script language="javascript">
	
			$(document).ready(function()
			{
				
				$.ajaxSetup({ cache: false });
				
				// Configure main menu
				<?php if(isset($main_menu_id)): ?>
				set_main_menu_id('<?php echo $main_menu_id; ?>');
				<?php endif; ?>
				
				// Configure sub menu
				<?php if(isset($sub_menu_id)): ?>
				show_sub_menu();
				set_sub_menu_id('<?php echo $sub_menu_id; ?>');
				<?php endif; ?>

				// Add global listeners
				add_main_menu_listeners();
				add_sub_menu_listeners();
				add_table_listeners($(document));
				add_editable_listeners($(document));
				add_submit_listeners($(document));
				
				// Load zero-level parts
				load_parts($(document));
				
			});

		</script>