<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
        <script async type="module" src="/js/main.esm.min.js"></script>
        <script async nomodule src="/js/main.iife.min.js"></script>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<header>
				<div class="logo">
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
					</a>
				</div>

				<nav class="nav">
					<?php steroids_primary_nav(); ?>
				</nav>
		</header>
