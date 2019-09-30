<?php
/**
*
*	WordPress Theme Framework by Logic Design
*
*	Codename: Project Loki
*
*	Copyright 2016 Logic Design under Propriatary License
*	Unauthorised use, reverse-engineering, copying, sharing is strictly prohibited.
*
**/

/**
*
*	Banner Post Type
*
*/

/****************************************************/
/*                                                  */
/*                  banner_register                 */
/*                                                  */
/****************************************************/

add_action('init', 'banner_register');
function banner_register() {

	$labels = array(
		'name' 					=> _x('Banners', 'post type general name'),
		'singular_name' 		=> _x('Banner', 'post type singular name'),
		'add_new' 				=> _x('Add New', 'item'),
		'add_new_item' 			=> __('Add New Banner'),
		'edit_item' 			=> __('Edit Banner'),
		'new_item' 				=> __('New Banner'),
		'view_item'				=> __('View Banner'),
		'search_items' 			=> __('Search'),
		'not_found' 			=>  __('Nothing found'),
		'not_found_in_trash' 	=> __('Nothing found in Trash'),
		'parent_item_colon' 	=> ''
	);

	$args = array(
		'labels' 				=> $labels,
		'public' 				=> false,
		'publicly_queryable' 	=> false,
		'show_ui' 				=> true,
		'query_var'				=> false,
		'rewrite' 				=> false,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'menu_icon'				=> 'dashicons-slides',
		'supports' 				=> array( 'title', 'page-attributes' )
	);

	register_post_type( 'banner' , $args );
	flush_rewrite_rules();
}

// META BOX
add_filter( 'rwmb_meta_boxes', 'banner_meta_boxes' );
function banner_meta_boxes( $meta_boxes )
{

	$prefix = '_loki_';

	$meta_boxes[] = array(
		'id' => 'banner_meta_box',
		'title' => 'Banner Meta Box',
		'pages' => array( 'banner' ),
		'context' => 'normal',
		'priority' => 'high',
		'show' => array(),
		'fields' => array(
			array(
				'name' => 'Short Description',
				'id' =>  $prefix . 'excerpt',
				'type' => 'textarea',
			),
			array(
				'name' => 'Button URL',
				'id' =>  $prefix . 'button_url',
				'type' => 'text',
			),
			array(
				'name' => 'Button Text',
				'id' =>  $prefix . 'button_text',
				'type' => 'text',
			),
		)
	);

	return $meta_boxes;

}
