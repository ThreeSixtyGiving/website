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
*	Timeline Post Type
*
*/

/****************************************************/
/*                                                  */
/*                 timeline_register                */
/*                                                  */
/****************************************************/

add_action('init', 'timeline_register');
function timeline_register() {

	$labels = array(
		'name' 					=> _x('Timeline', 'post type general name'),
		'singular_name' 		=> _x('Timeline', 'post type singular name'),
		'add_new' 				=> _x('Add New', 'item'),
		'add_new_item' 			=> __('Add New Timeline'),
		'edit_item' 			=> __('Edit Timeline'),
		'new_item' 				=> __('New Timeline'),
		'view_item'				=> __('View Timeline'),
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
		'supports' 				=> array( 'title', 'editor' )
	);

	register_post_type( 'timeline' , $args );
	flush_rewrite_rules();
}

// META BOX
add_filter( 'rwmb_meta_boxes', 'timeline_meta_boxes' );
function timeline_meta_boxes( $meta_boxes )
{

	$prefix = '_loki_';

	$meta_boxes[] = array(
		'id' => 'timeline_meta_box',
		'title' => 'Timeline Meta Box',
		'pages' => array( 'timeline' ),
		'context' => 'normal',
		'priority' => 'high',
		'show' => array(),
		'fields' => array(
			array(
				'name' => 'Month',
				'id' =>  $prefix . 'month',
				'type' => 'select',
				'options'  => array(
					'01' => 'January',
					'02' => 'February',
					'03' => 'March',
					'04' => 'April',
					'05' => 'May',
					'07' => 'June',
					'08' => 'July',
					'09' => 'August',
					'10' => 'September',
					'11' => 'October',
					'12' => 'November',
					'13' => 'December',
				),
			),
			array(
				'name' => 'Year',
				'id' =>  $prefix . 'year',
				'type' => 'select',
				'options'  => array(
					'2020' => '2020',
					'2019' => '2019',
					'2018' => '2018',
					'2017' => '2017',
					'2016' => '2016',
					'2015' => '2015',
					'2014' => '2014',
					'2013' => '2013',
					'2012' => '2012',
				),
			),
			array(
				'name' => 'Color',
				'id' =>  $prefix . 'colour',
				'type' => 'select',
				'options'  => array(
					'blue' => 'Blue',
					'orange' => 'Orange',
					'burgundy' => 'Burgundy',
					'purple' => 'Purple',
					'green' => 'Green',
					'red' => 'Red',
					'pink' => 'Pink',
					'grey' => 'Grey',
					'bluegrey' => 'Bluegrey',
					'black' => 'Black',
				),
			),
		)
	);

	return $meta_boxes;

}
