<?php
// Add Your Menu Locations
function register_my_menus() {
  register_nav_menus(
    array(  
    	'second_footer' => __( 'Second Footer' )
    )
  );
} 
add_action( 'init', 'register_my_menus' );


/**
 * WordPress Widgets start right here.
 * Add a new widget area for us to use
 */
function my_responsive_widgets_init() {

	register_sidebar( array(
						  'name'          => __( '360 Footer Widget', 'responsive' ),
						  'description'   => __( 'Area 12 - sidebar-footer.php - Maximum of 3 widgets per row', 'responsive' ),
						  'id'            => 'footer-widget-360',
						  'before_title'  => '<div class="widget-title"><h3>',
						  'after_title'   => '</h3></div>',
						  'before_widget' => '<div id="%1$s" class="grid col-300 %2$s"><div class="widget-wrapper">',
						  'after_widget'  => '</div></div>'
					  ) );
}
add_action( 'widgets_init', 'my_responsive_widgets_init' );

//Thanks: https://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/
//Is this page a child of a parent page OR the parent page
//Useful for our Table of Contents jquery plugin on /standard pages
function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
	global $post;         // load details about this page
	if(is_page()&&($post->post_parent==$pid||is_page($pid))) 
               return true;   // we're at the page or at a sub page
	else 
               return false;  // we're elsewhere
};


?>
