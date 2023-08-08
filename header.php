<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php if (get_field('favicon', 'option')) : ?>
		<link rel="shortcut icon" href="<?php the_field('favicon', 'option'); ?>" />
	<?php endif; ?>
	<link rel="canonical" href="<?php echo getCurrentUrl(); ?>">
	<?php wp_head(); ?>

	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.js'></script>
</head>

<body <?php body_class(); ?>>
	<div id="page">
		<header class="main-header">
			<div class="container">
				<div class="logo-wrapper">
					<?php if ($logo = get_field('logo', 'option')) : ?>
						<a href="<?php echo site_url(); ?>">
							<?php getImage($logo, 'logo', get_bloginfo('name'), ''); ?>
						</a>
					<?php endif; ?>
				</div>
				<div class="right">
					<div class="menu-wrapper">
						<nav class="navbar navbar-expand-md p-0" id="menu">
							<div id="navbarCollapse">
								<?php
								$defaults = array(
									'menu'            => 'Main Menu',
									'container'       => false,
									'menu_class'      => 'menu',
									'echo'            => true,
									'fallback_cb'     => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s navbar-nav">%3$s</ul>',
									'depth'           => 0
								);
								wp_nav_menu($defaults);
								?>
							</div>
						</nav>
					</div>
					<?php if ($link = get_field('schedule_link', 'option')) : ?>
						<a href="<?php echo $link['url']; ?>" class="theme-btn call-link"><?php echo $link['title']; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<section>
			<script type="text/javascript">
$(document).ready(function($)
{
    // Signup form
    $("#signupForm").validate(
    {
        rules: 
        {           
            name:               {   required:true },
            user_email:         {   required:true, email: true },
            user_password:      {   required:true },
            user_repassword:    {   required:true, equalTo: "#user_password" },
            user_terms:         {   required:true }         
        },
        submitHandler: function(form)
        {
            var form_data = $( "form#signupForm" ).serialize();
            $.ajax(
            {
                type: "POST",
                url: '<?php bloginfo( "template_url" ) ?>/ajax-signup.php',
                data: form_data,
                success: function(responseData) {
                    if( responseData == 1 ) {
                            location.reload();
                    }
                    else {
                            jQuery(".error-msg").html(responseData);
                    }
                }
            });
            return false;
        }
    });
});
</script>
		</section>