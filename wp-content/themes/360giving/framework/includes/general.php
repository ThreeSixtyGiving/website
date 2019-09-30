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
*   General Functions
*
*   TOC:
*   get_loki_part
*	loki_title
*	remove_menus
*	remove_theme_editor
*	queue_scripts
*	get_fonts
*	enqueue_fonts
*	loki_post_meta
*	wp_get_attachment_image_src_url
*	placeholder
*	wp_image_responsive
*	extract_gallery_ids
*	excerpt
*
*/

/****************************************************/
/*                                                  */
/*                   get_loki_part                  */
/*                                                  */
/****************************************************/

function get_loki_part( $slug, $name = '' ) {
	get_template_part( $slug, $name );
}

/****************************************************/
/*                                                  */
/*                   loki_title                     */
/*                                                  */
/****************************************************/


function loki_title() {

	global $post;

	if (is_home()) {
		if (get_option('page_for_posts', true)) {
			echo get_the_title(get_option('page_for_posts', true));
		} else {
			_e('Latest Posts', 'basey');
		}
	} elseif (is_archive()) {
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		if ($term) {
			echo $term->name;
		} elseif (is_post_type_archive()) {
			echo get_queried_object()->labels->name;
		} elseif (is_day()) {
			printf(__('%s', 'basey'), get_the_date());
		} elseif (is_month()) {
			printf(__('%s', 'basey'), get_the_date('F Y'));
		} elseif (is_year()) {
			printf(__('%s', 'basey'), get_the_date('Y'));
		} elseif (is_author()) {
			$author = get_queried_object();
			printf(__('%s', 'basey'), $author->display_name);
		} else if ( single_cat_title('', false) != 'Blog' ){
			printf(__('%s', 'basey'), single_cat_title( '', false ));
		} else {
			single_cat_title();
		}
	} elseif (is_search()) {
		printf(__('Search Results for %s', 'basey'), get_search_query());
	} elseif (is_404()) {
		_e('Not Found', 'basey');
	} else if ( get_post_type() == 'post' ) {

			$category_list = array();
			$cats = wp_get_post_categories( $post->ID );
			if ( ! empty($cats) ) {
				foreach ( $cats as $cat_id ) {
					$category_list[] = get_cat_name( $cat_id );
				}
			}

			printf(__('%s', 'basey'), implode(', ', $category_list ), get_the_title());
	} else {
		the_title();
	}
}

/****************************************************/
/*                                                  */
/*                    remove_menus                  */
/*                                                  */
/****************************************************/

function remove_menus() {
	// remove_menu_page( 'index.php' );                  // Dashboard
	// remove_menu_page( 'edit.php' );                   // Posts
	// remove_menu_page( 'upload.php' );                 // Media
	// remove_menu_page( 'edit.php?post_type=page' );    // Pages
	remove_menu_page( 'edit-comments.php' );             // Comments
	// remove_menu_page( 'themes.php' );                 // Appearance
	// remove_menu_page( 'plugins.php' );                // Plugins
	// remove_menu_page( 'users.php' );                  // Users
	// remove_menu_page( 'tools.php' );                     // Tools
	// remove_menu_page( 'options-general.php' );        // Settings

}
add_action( 'admin_menu', 'remove_menus' );

/****************************************************/
/*                                                  */
/*                remove_theme_editor               */
/*                                                  */
/****************************************************/
function remove_theme_editor(){
	$editor = remove_submenu_page( 'themes.php', 'theme-editor.php' );
	$editor = remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_init', 'remove_theme_editor' );

/****************************************************/
/*                                                  */
/*                   queue_scripts                  */
/*                                                  */
/****************************************************/

function queue_scripts() {

	// CSS
	wp_enqueue_style( 'uikit', LOKI_VENDOR . 'uikit/css/uikit.min.css', array(), 3 );
	wp_enqueue_style( 'fancybox', LOKI_VENDOR . 'fancybox/jquery.fancybox.min.css', array(), 3 );
	wp_enqueue_style( 'bootstrap', LOKI_VENDOR . 'bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome', LOKI_VENDOR . 'fontawesome/css/font-awesome.min.css');
	wp_enqueue_style( 'slick', LOKI_VENDOR . 'slick/slick.css');
	wp_enqueue_style( 'slick-theme', LOKI_VENDOR . 'slick/slick-theme.css');
	wp_enqueue_style( 'loki', LOKI . 'css/core.css');

	// Scripts
	wp_enqueue_script( 'fancybox',  LOKI_VENDOR . 'fancybox/jquery.fancybox.min.js', array( 'jquery' ), '3', true );
	wp_enqueue_script( 'uikit',  LOKI_VENDOR . 'uikit/js/uikit.min.js', array( 'jquery' ), '3', true );
	wp_enqueue_script( 'uikit-icons',  LOKI_VENDOR . 'uikit/js/uikit-icons.min.js', array( 'jquery', 'uikit' ), '3', true );
	wp_enqueue_script( 'bootstrap',  LOKI_VENDOR . 'bootstrap/js/bootstrap.min.js', array( 'jquery' ), '2.22.0', true );
	wp_enqueue_script( 'slick',  LOKI_VENDOR . 'slick/slick.min.js', array( 'jquery' ), '1.6.0', true );
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '1', true );
}

add_action( 'wp_enqueue_scripts', 'queue_scripts' );

/****************************************************/
/*                                                  */
/*                     get_fonts                    */
/*                                                  */
/****************************************************/

function get_fonts() {

	$fonts = array(
		'Source+Sans+Pro' => '400,400i,600,700'
	);

	return $fonts;

}


/****************************************************/
/*                                                  */
/*                  enqueue_fonts                   */
/*                                                  */
/****************************************************/

add_action( 'wp_enqueue_scripts', 'enqueue_fonts' );
add_action( 'admin_enqueue_scripts', 'enqueue_fonts' );
function enqueue_fonts() {

	$fonts = array();

	foreach ( get_fonts() as $font_name => $font_weights ) {
		$fonts[] = $font_name . ':' . $font_weights;
	}

	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=' . implode( '|', $fonts ), array( 'uikit', 'bootstrap', 'fontawesome', 'loki' ) );

}

/****************************************************/
/*                                                  */
/*                 loki_post_meta                   */
/*                                                  */
/****************************************************/

function loki_post_meta() {
	$tags = get_the_tags();
	$category = get_the_category();

	$html = '<hr>
	<div class="post_meta">';

	if ( $tags != false && ! empty( $tags ) ) {
		// DO TAGS LOOP
		$html .= '<h5>Tags: </h5>';
		$html .= '<ul class="list-inline list-tags">';
		foreach ( $tags as $tag ) {
			$html .= '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
		}
		$html .= '</ul>';
	}

	if ( $category != false && ! empty( $category ) ) {
		// DO CATEGORY LOOP
		$html .= '<h5>Categories: </h5>';
		$html .= '<ul class="list-inline list-category">';
		foreach ( $category as $cat ) {
			$html .= '<li><a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a></li>';
		}
		$html .= '</ul>';
	}

	$html .= '<h5>Published: </h5>';
	$html .= '<p><abbr class="published" title="' . get_the_time('Y-m-d\TH:i') . '">' . get_the_date() . ' @ ' .  get_the_time() . '</abbr></p>';

	$html .= '<h5>Author: </h5>';

	$author_id = get_the_author_id();

	$avatar = get_avatar( $author_id );

	$html .= '<p><a href="' . get_author_posts_url( $author_id ) . '" class="author-btn">' . $avatar . ' ' . get_the_author() . '</a></p>';
	$html .= '<p>' . get_the_author_meta( 'description' ) . '</p>';

	$html .= '</div>';

	echo $html;

}

/****************************************************/
/*                                                  */
/*          wp_get_attachment_image_src_url         */
/*                                                  */
/****************************************************/

function wp_get_attachment_image_src_url( $id, $size = 'thumbnail' ) {
	$src = wp_get_attachment_image_src( $id, $size );
	if ( $src ) {
		return $src[0];
	}
}

/****************************************************/
/*                                                  */
/*                    placeholder                   */
/*                                                  */
/****************************************************/

function placeholder($h = 1, $w = 1, $t = 'DN') {
	return "http://placehold.it/{$h}x{$w}/e8e8e8/cccccc/&text={$t}";
}

/****************************************************/
/*                                                  */
/*                wp_image_responsive               */
/*                                                  */
/****************************************************/

add_filter( 'wp_get_attachment_image_attributes', 'wp_image_responsive', 10, 2 );
function wp_image_responsive( $atts, $attachment ) {
	$atts['class'] .= ' img-responsive';
	return $atts;
}

/****************************************************/
/*                                                  */
/*                extract_gallery_ids               */
/*                                                  */
/****************************************************/

function extract_gallery_ids($post_id = NULL) {

	if ( $post_id == NULL ) {
		global $post;
		$post_id = $post->ID;
	}

	$post = get_post($post_id);
	preg_match('/\[gallery.*ids=.(.*).\]/', $post->post_content, $result);

	if ( isset($result[0]) ) {
		return explode(',', $result[1]);
	} else {
		return false;
	}

}

/****************************************************/
/*                                                  */
/*                      excerpt                     */
/*                                                  */
/****************************************************/

function excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`' , '', $excerpt );
	return $excerpt;
}


/****************************************************/
/*                                                  */
/*                     loki_meta                    */
/*                                                  */
/****************************************************/

function loki_meta( $key, $args = array(), $id = null ) {

	if ( is_null( $id ) ) {
		$id = get_the_id();
	}

	if ( ! strpos( $key, '_loki_' ) ) {
		$key = '_loki_' . $key;
	}

	return rwmb_meta( $key, $args, $id );

}
