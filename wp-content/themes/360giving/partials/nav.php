<nav>
	<button class="toggle-menu hidden-lg" data-uk-toggle="target: #offcanvas-menu" data-uk-icon="icon:menu;ratio:2"></button>
	<?php
		wp_nav_menu( array(
			'menu' => 'main',
			'theme_location' => 'main',
			'depth' => 2,
			'container' => '',
			'menu_class' => 'list-inline list-unstyled hidden-md hidden-sm hidden-xs',
			'items_wrap' => '<ul class="%2$s">%3$s</ul>',
			)
		);
	?>
</nav>