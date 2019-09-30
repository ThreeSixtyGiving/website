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
*   TinyMCE Related Functions
*
*   TOC: 
*	wpb_mce_buttons_2
*	my_mce_before_init_insert_formats
*	my_theme_add_editor_styles
*
*/

/****************************************************/
/*                                                  */
/*                wpb_mce_buttons_2                 */
/*                                                  */
/****************************************************/

add_filter('mce_buttons_2', 'wpb_mce_buttons_2');
function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}

/****************************************************/
/*                                                  */
/*        my_mce_before_init_insert_formats         */
/*                                                  */
/****************************************************/

add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 
function my_mce_before_init_insert_formats( $init_array ) {  

	$style_formats = array(

		array(
			'title' => 'Lead Paragraph',  
			'block' => 'p',  
			'classes' => 'lead',
			'wrapper' => false,
		),
		// array(
		// 	'title' => 'Text Muted',  
		// 	'block' => 'p',  
		// 	'classes' => 'text-muted text-small',
		// 	'wrapper' => false,
		// ),
	);

	$init_array['style_formats'] = json_encode( $style_formats );  

	return $init_array;  

}

/****************************************************/
/*                                                  */
/*            my_theme_add_editor_styles            */
/*                                                  */
/****************************************************/

add_action( 'init', 'my_theme_add_editor_styles' );
function my_theme_add_editor_styles() {
	add_editor_style(  get_loki_uri( 'css/custom-editor-styles.css' ) );
}



// add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;

  // Hide the editor on the page titled 'Homepage'
  $homepgname = get_the_title($post_id);
  if($post_id == get_option('page_on_front')){ 
    remove_post_type_support('page', 'editor');
  }

  // Hide the editor on a page with a specific page template
  // Get the name of the Page Template file.
  $template_file = get_post_meta($post_id, '_wp_page_template', true);

  if($template_file == 'my-page-template.php'){ // the filename of the page template
    remove_post_type_support('page', 'editor');
  }
}