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
*   Image Related Functions
*
*   TOC: 
*   add_image_size_to_admin
*
*/


/****************************************************/
/*                                                  */
/*              add_image_size_to_admin             */
/*                                                  */
/****************************************************/

add_filter( 'image_size_names_choose', 'add_image_size_to_admin' );
function add_image_size_to_admin( $sizes ) {

	global $_wp_additional_image_sizes;

	$custom_sizes = array();
	foreach ( $_wp_additional_image_sizes as $key => $value ) {
		$custom_sizes[ $key ] = ucwords( str_replace('_', ' ', $key) );
	}

	return array_merge( $sizes, $custom_sizes );

}