<?php

function get_breadcrumb( $post_id = false, $withhome = true, $multiple = false ){
    $breadcrumbs = tsg_get_breadcrumbs( $post_id, $withhome, $multiple );
    $divider = '<i class="breadcrumbs__arrow">keyboard_arrow_right</i>';
    $count = 0;
    foreach($breadcrumbs as $b){
        if($count > 0){
            echo $divider;
        }
        echo '<a href="'. esc_url($b["url"]) .'" class="breadcrumbs__item">' . $b["title"] . '</a>';
        $count++;
    }
}

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="button button--teal"';
}

function tsg_get_breadcrumbs( $post_id = false, $withhome = true, $multiple = false ) {
    $thelist = array();
    if($withhome){
        $thelist[] = array("title"=>"Home", "url"=>home_url());
    }
    if (is_single() || $post_id) {
        if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
            return $thelist;
        }
        $categories = get_the_category( $post_id );
    
        if ( empty( $categories ) ) {
            return $thelist;
        }
    
        if(!$multiple){
            $categories = array($categories[0]);
        }
        $seen_categories = array();
        foreach( $categories as $category ){
            foreach ( get_ancestors($category->term_id, 'category') as $category_ancestor){
                if(!in_array($category_ancestor, $seen_categories)){
                    $thelist[] = array("title"=>get_cat_name($category_ancestor), "url"=>get_category_link( $category_ancestor ));
                    $seen_categories[] = $category_ancestor;
                }
            }
            if(!in_array($category->term_id, $seen_categories)){
                $thelist[] = array("title"=>$category->name, "url"=>get_category_link( $category->term_id ));
                $seen_categories[] = $category->term_id;
            }
        }
    } elseif (is_category()) {
        global $wp_query;
        $category = $wp_query->get_queried_object();
        foreach ( get_ancestors($category->term_id, 'category') as $category_ancestor){
            $thelist[] = array("title"=>get_cat_name($category_ancestor), "url"=>get_category_link( $category_ancestor ));
        }
        $thelist[] = array("title"=>$category->name, "url"=>get_category_link( $category->term_id ));
    } elseif (is_page()) {
        foreach ( get_ancestors(get_the_ID(), 'page') as $ancestor){
            $thelist[] = array("title"=>get_the_title($ancestor), "url"=>get_the_permalink( $ancestor ));
        }
    } elseif (is_search()) {
        $thelist[] = array(
            "title"=>"Search Results for...<em>" . the_search_query() . "</em>",
            "url"=>get_the_permalink()
        );
    }
    // if(is_single() || is_page()){
    //     $thelist[] = array("title"=>get_the_title(), "url"=>get_the_permalink());
    // }
 
    return $thelist;
}
