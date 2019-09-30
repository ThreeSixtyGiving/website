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
*   Sidebar Related Functions
*
*   TOC:
*	has_subpages
*	get_subpages
*	get_subpages_header
*	get_child_pages
*	get_subpage_menu_title
*	get_subpage_menu
*	build_side_menu
*
*/

/****************************************************/
/*                                                  */
/*                   has_subpages                   */
/*                                                  */
/****************************************************/

function has_subpages() {

	global $post;

	if ( $post->post_parent ) {
		$children = wp_list_pages("depth=1&title_li=&child_of=".$post->post_parent."&echo=0&post_type=".$post->post_type."");
	} else {
		$children = wp_list_pages("depth=1&title_li=&child_of=".$post->ID."&echo=0&post_type=".$post->post_type."");
	}

	if ( $children ) {
		return true;
	}

	return false;

}

/****************************************************/
/*                                                  */
/*                   get_subpages                   */
/*                                                  */
/****************************************************/

function get_subpages() {

	global $post;

	if ( $post->post_parent ) {

		$args = array(
				'depth' => 1,
				'title_li' => '',
				'child_of' => $post->post_parent,
				'echo' => false,
				'post_type' => $post->post_type,
			);

		$children = wp_list_pages($args);

	} else {

		$args = array(
				'depth' => 1,
				'title_li' => '',
				'child_of' => $post->ID,
				'echo' => false,
				'post_type' => $post->post_type,
			);
		$children = wp_list_pages($args);

	}

	if ( $children ) {
		return $children;
	}

	return false;

}

/****************************************************/
/*                                                  */
/*                get_subpages_header               */
/*                                                  */
/****************************************************/

function get_subpages_header() {

	global $post;

	if ( $post->post_parent ) {
		$titlenamer = '<h5>' . get_the_title($post->post_parent)  . '</h5>' . '<a href="' . get_permalink( $post->post_parent ) . '">' . '</a>';
	} else {
		$titlenamer = '<h5>' . get_the_title($post->ID)  . '</h5>' . '<a href="' . get_permalink( $post->ID ) . '">' . '</a>';
	}

	return $titlenamer;

}

/****************************************************/
/*                                                  */
/*                  get_child_pages                 */
/*                                                  */
/****************************************************/

function get_child_pages( $post_id = null ) {

	if ( is_null( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	} else {
		$post = get_post( $post_id );
	}

	$query_args = array( 'posts_per_page' => '-1', 'post_type' => $post->post_type, 'orderby' => 'menu_order', 'order' => 'ASC' );

	$children = new WP_Query( array_merge( $query_args, array( 'post_parent' => $post_id ) ) );

	if ( empty( $children->posts ) ) {
		if ( $post->post_parent == 0 ) {
			$children = new WP_Query( array( 'post__in' => array( 0 ) ) );
		} else {
			$children = new WP_Query( array_merge( $query_args, array( 'post_parent' => $post->post_parent ) ) );
		}
	}

	return $children;

}

/****************************************************/
/*                                                  */
/*               get_subpage_menu_title             */
/*                                                  */
/****************************************************/

function get_subpage_menu_title( $query = null, $anchor = false ) {
	if ( is_null( $query ) ) {
		$query = get_child_pages();
	}

	if ( $anchor ) {
		return '<a href="' . get_permalink($query->post->post_parent) . '">' . get_the_title( $query->post->post_parent ) . '</a>';
	} else {
		return get_the_title( $query->post->post_parent );
	}

}

/****************************************************/
/*                                                  */
/*                  get_subpage_menu                */
/*                                                  */
/****************************************************/

function get_subpage_menu( $query = null ) {
	if ( is_null( $query ) ) {
		$query = get_child_pages();
	}

	$menu = '';

	//$menu .= '<li' . (is_page($query->post->post_parent) ? ' class="current-page"' : '') . '><a href="' . get_permalink($query->post->post_parent) . '">' . get_the_title( $query->post->post_parent ) . '</a></a>';

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

		$menu .= '<li' . (is_page(get_the_id()) ? ' class="current-page"' : '') . '><a href="' . get_permalink( get_the_id() ) . '">' . get_the_title() . '</a></li>';

	endwhile; endif; wp_reset_query();

	return $menu;

}

/****************************************************/
/*                                                  */
/*                  build_side_menu                 */
/*                                                  */
/****************************************************/

function build_side_menu( $post_id = null ) {

	if ( is_null( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	} else {
		$post = get_post( $post_id );
	}

	if ( $post->post_parent != 0 ) {

		$post_parent = get_post( $post->post_parent );

		if ( $post_parent->post_parent != 0 ) {

			$post_parent_parent = get_post( $post_parent->post_parent );

		}

	}

}
