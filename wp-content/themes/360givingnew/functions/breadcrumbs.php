<?php 

/**
 * Generate breadcrumbs
 * @author CodexWorld
 * @authorURL www.codexworld.com
 */
function get_breadcrumb() {
    $divider = '<i class="breadcrumbs__arrow">keyboard_arrow_right</i>';
    echo '<a href="'.home_url().'" rel="nofollow" class="breadcrumbs__item">Home</a>';
    if (is_category() || is_single()) {
        echo $divider;
        $list = get_the_category_list('|  ', 'single');
        if (is_single()) {
            $list = str_replace('<a ', '<a class="breadcrumbs__item" ', $list);
            echo $list;
            echo $divider;
            echo '<a class="breadcrumbs__item breadcrumbs--active" href="'. get_the_permalink() . '">';
            the_title();
            echo '</a>';
        } else {
            $list = str_replace('<a ', '<a class="breadcrumbs__item breadcrumbs--active" ', $list);
            echo $list;
        }
    } elseif (is_page()) {
        echo $divider;
        echo '<a class="breadcrumbs__item breadcrumbs--active" href="'. get_the_permalink() . '">';
        echo the_title();
        echo '</a>';
    } elseif (is_search()) {
        echo $divider;
        echo '<a class="breadcrumbs__item breadcrumbs--active" href="'. get_the_permalink() . '">';
        echo "Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
        echo '</a>';
    }
}

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="button button--teal"';
}