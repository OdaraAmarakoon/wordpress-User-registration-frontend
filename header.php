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