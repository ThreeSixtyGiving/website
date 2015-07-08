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

?>
