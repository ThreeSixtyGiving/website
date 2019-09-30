<?php
/**
*
*   WordPress Theme Framework by Logic Design
*
*   Codename: Project Loki
*
*   Copyright 2016 Logic Design under Propriatary License
*   Unauthorised use, reverse-engineering, copying, sharing is strictly prohibited.
*
**/

/**
*
*   OBSELETE FUNCTIONS
*
*   TOC: 
*   menu
*
*/

/****************************************************/
/*                                                  */
/*                       menu                       */
/*                                                  */
/****************************************************/

function menu($theme_location = 'main', $menu_class = 'list-unstyled list-inline') {

	$args = array(
		'theme_location' => $theme_location,
		'menu' => '',
		'container' => 'ul',
		'container_class' => '',
		'container_id' => 'main_menu',
		'menu_class' => $menu_class,
		'menu_id' => '',
		'echo' => false,
		'fallback_cb' => 'wp_page_menu',
		'before' => '',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth' => 0,
	);

	$html = '<div id="' . $theme_location .'_menu">';

	if ( $theme_location == 'main' ) {
		$html .= '<div class="menu_toggle">' . str_repeat('<span></span>', 3) . '</div>';
	}

	$html .= wp_nav_menu( $args );
	$html .= '</div>';

	return $html;

}
