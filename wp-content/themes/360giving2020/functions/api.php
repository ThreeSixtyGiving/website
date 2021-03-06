<?php

/**
 * Get nav menu items by location
 *
 * @param $location The menu location id
 */
function get_nav_menu_items_by_location( $location, $args = [] ) {
 
    // Get all locations
    $locations = get_nav_menu_locations();
 
    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );
 
    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name, $args );

    $return_items = array(
        "title"=>wp_get_nav_menu_name($location),
        "items"=>array()
    );
    foreach($menu_items as $menu_item){
        $return_items["items"][] = array(
            "url"=>$menu_item->url,
            "title"=>$menu_item->title,
            "description"=>$menu_item->description,
        );
    }
 
    // Return menu post objects
    return $return_items;
}

// create custom function to return nav menu
function tsg_get_footer_items() {
    global $wp_registered_widgets, $wp_registered_sidebars;

    // Replace your menu name, slug or ID carefully
    $sidebars = wp_get_sidebars_widgets();
    $widgets = array();
    $sidebar = 'tsg-footer';
    $delim = '@***SPLITTEXT***@';
    foreach($sidebars[$sidebar] as $id){
        // $widgets[] = $wp_registered_widgets[$w];
        $params = array_merge(
            array(
                array_merge(
                    // $wp_registered_sidebars[ $sidebar ],
                    array(
                        'before_widget'=> '',
                        'after_widget' => '',
                        'before_title' => '',
                        'after_title'  => $delim,
                        'widget_id'    => $id,
                        'widget_name'  => $wp_registered_widgets[ $id ]['name'],
                    )
                ),
            ),
            (array) $wp_registered_widgets[ $id ]['params']
        );
        ob_start();
        call_user_func_array( $wp_registered_widgets[$id]["callback"], $params );
        $widget = explode($delim, trim(ob_get_contents()), 2);
        $widgets[] = array(
            "title"=>trim($widget[0]),
            "contents"=>trim(strip_tags($widget[1], '<p><a><em><strong><br>'))
        );
        ob_end_clean();
    }

    return array(
        "menus"=>array(
            "menu_1" => get_nav_menu_items_by_location('footer-menu-1'),
            "menu_2" => get_nav_menu_items_by_location('footer-menu-2'),
            "menu_terms" => get_nav_menu_items_by_location('footer-menu-terms'),
            "menu_off_canvas" => get_nav_menu_items_by_location('off-canvas-menu'),
        ),
        "widgets"=>$widgets,
        "newsletter"=>array(
            "form_url"=>get_theme_mod( 'tsg_mailchimp_url', TSG_DEFAULTS['mailchimp_url'] ),
            "u"=>get_theme_mod( 'tsg_mailchimp_u', TSG_DEFAULTS['mailchimp_u'] ),
            "id"=>get_theme_mod( 'tsg_mailchimp_id', TSG_DEFAULTS['mailchimp_id'] ),
            "email_field"=>get_theme_mod( 'tsg_mailchimp_email_field', TSG_DEFAULTS['mailchimp_email_field'] ),
        ),
        "footer_tagline"=>get_theme_mod( 'tsg_footer_tagline', TSG_DEFAULTS['footer_tagline'] ),
    );
}

// create new endpoint route
add_action( 'rest_api_init', function () {
    register_rest_route( 'wp/v2', '360giving', array(
        'methods' => 'GET',
        'callback' => 'tsg_get_footer_items',
    ) );
} );
