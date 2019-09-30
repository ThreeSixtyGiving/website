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
*	Init
*
*	TOC:
*	require_loki_part
*	get_loki_dir
*
*/

define( 'RWMB_DIR', get_loki_dir( 'includes/metabox/' ) );
define( 'RWMB_URL', get_loki_uri( 'includes/metabox/' ) );
define( 'RWMB_SH_URL', get_loki_uri( 'includes/metabox_showhide/' ) );
define( 'LOKI', get_loki_uri( '' ) );
define( 'LOKI_VENDOR', get_loki_uri( 'vendor/' ) );

collect_files();

add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'gallery' ) );

/****************************************************/
/*                                                  */
/*                 require_loki_part                */
/*                                                  */
/****************************************************/

function require_loki_part( $filename = null ) {

	if ( ! is_null( $filename ) ) {

		require_once( 'includes/' . $filename . '.php' );

	}

}

/****************************************************/
/*                                                  */
/*                    get_loki_dir                  */
/*                                                  */
/****************************************************/

function get_loki_dir( $filename = null ) {

	if ( ! is_null( $filename ) ) {

		return get_template_directory() . "/framework/" . $filename;

	} else {

		return get_template_directory() . '/framework/';

	}

}

/****************************************************/
/*                                                  */
/*                    get_loki_uri                  */
/*                                                  */
/****************************************************/

function get_loki_uri( $filename = null ) {

	if ( ! is_null( $filename ) ) {

		return get_template_directory_uri() . "/framework/" . $filename;

	} else {

		return get_template_directory_uri() . '/framework/';

	}

}

/****************************************************/
/*                                                  */
/*                   collect_files                  */
/*                                                  */
/****************************************************/

function collect_files() {

	$files = array(
		'general',
		'shortcodes',
		'images',
		'pagination',
		'sidebar',
		'tinymce',

		'metabox/meta-box',
		'metabox_showhide/meta-box-show-hide',
		'metabox_term/mb-term-meta',
		'meta-box-group/meta-box-group',

		'post_type/post',
		'post_type/page',
		'post_type/banner',
		'post_type/timeline',

		'uikit/gallery',
		'uikit/offcanvas_menu_walker',
	);

	foreach ( $files as $file ) {
		require_loki_part( $file );
	}

}