<?php
/*
Plugin Name: Gutenberg examples 01
*/
function tsg_person_register_block() {
    
	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}

	wp_register_script(
		'tsg-person-block',
		get_template_directory_uri() . '/assets/js/person-block.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		filemtime( plugin_dir_path( __FILE__ ) . '../assets/js/person-block.js' )
	);

	register_block_type( 'tsg/person-block', array(
		'editor_script' => 'tsg-person-block',
	) );
 
}
add_action( 'init', 'tsg_person_register_block' );
