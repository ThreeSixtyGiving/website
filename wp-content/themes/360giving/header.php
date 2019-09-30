<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="theme-color" content="#53aadd">

	<link rel="icon" type="image/x-icon" href="<?php echo ASSET; ?>img/icons/favicon.ico">

	<link href="<?php echo ASSET; ?>img/icons/apple-touch-icon.png" rel="apple-touch-icon" />
	<link href="<?php echo ASSET; ?>img/icons/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
	<link href="<?php echo ASSET; ?>img/icons/apple-touch-icon-167x167.png" rel="apple-touch-icon" sizes="167x167" />
	<link href="<?php echo ASSET; ?>img/icons/apple-touch-icon-180x180.png" rel="apple-touch-icon" sizes="180x180" />
	<link href="<?php echo ASSET; ?>img/icons/icon-hires.png" rel="icon" sizes="192x192" />
	<link href="<?php echo ASSET; ?>img/icons/icon-normal.png" rel="icon" sizes="128x128" />

	<title><?php echo the_title() . ' | ' . get_bloginfo( 'name' ); ?></title>

	<?php wp_head(); ?>

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body <?php body_class(); ?>>

	<div class="uk-offcanvas-content">

		<div id="offcanvas-menu" data-uk-offcanvas='{"overlay": "true", "flip": "true"}'>
			<div class="uk-offcanvas-bar uk-text-center uk-offcanvas-bar-animation uk-offcanvas-slide">
				<button class="uk-offcanvas-close" type="button" data-uk-close=""></button>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
					<img src="<?php echo ASSET . 'img/logo.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="175" height="125">
				</a>
				<nav>
					<?php
						wp_nav_menu( array(
							'menu' => 'main',
							'theme_location' => 'main',
							'depth' => 2,
							'container' => '',
							'menu_class' => 'uk-nav uk-nav-primary uk-nav-center ',
							'items_wrap' => '<ul class="%2$s">%3$s</ul>',
							'walker' => new loki_offcanvas_menu()
							)
						);
					?>
				</nav>
			</div>
		</div>
		<div class="internal-wrapper">
			<header class="site-header">
				<div class="search-wrapper">
					<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="search"  class="search-input" placeholder="" value="<?php echo get_search_query(); ?>" name="s" />
						<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
					<img src="<?php echo ASSET . 'img/logo.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="175" height="125">
				</a>
				<nav class="nav-top">
					<ul>
						<li class="newsletter-signup">
							<a href="https://us10.campaign-archive.com/home/?u=216b8b926250184f90c7198e8&id=91870dde44"><i class="fa fa-envelope-o"></i>Sign up to our newsletter</a>
						</li>
						<li class="social-twitter">
							<a href="<?php echo loki_meta('global_twitter', array(), get_option('page_on_front')); ?>" target="_blank"><i class="fa fa-twitter-square"></i></a>
						</li>
						<li class="social-github">
							<a href="<?php echo loki_meta('global_github', array(), get_option('page_on_front')); ?>" target="_blank"><i class="fa fa-github-alt"></i></a>
						</li>
						<li class="search-toggle">
							<i class="fa fa-search"></i>
						</li>
					</ul>
				</nav>
				<nav class="nav-main">
					<button class="toggle-menu hidden-md hidden-lg" data-uk-toggle="target: #offcanvas-menu" data-uk-icon="icon:menu;ratio:2"></button>
					<?php
						wp_nav_menu( array(
							'menu' => 'main',
							'theme_location' => 'main',
							'depth' => 2,
							'container' => '',
							'menu_class' => 'list-inline list-unstyled hidden-xs hidden-sm',
							'items_wrap' => '<ul class="%2$s">%3$s</ul>',
							'walker' => new loki_offcanvas_menu()
							)
						);
					?>
				</nav>
				<div class="clearfix"></div>
			</header>

			<div class="page-wrapper">
