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
        $list = get_the_category_list(' &bull; ', 'single');
        if (is_single()) {
            $list = str_replace('<a ', '<a class="breadcrumbs__item" ', $list);
            echo $list;
            echo $divider;
            echo '<span class="breadcrumbs__item breadcrumbs--active">';
            the_title();
            echo '</span>';
        } else {
            $list = str_replace('<a ', '<a class="breadcrumbs__item breadcrumbs--active" ', $list);
            echo $list;
        }
    } elseif (is_page()) {
        echo $divider;
        echo '<span class="breadcrumbs__item breadcrumbs--active">';
        echo the_title();
        echo '</span>';
    } elseif (is_search()) {
        echo $divider;
        echo '<span class="breadcrumbs__item breadcrumbs--active">';
        echo "Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
        echo '</span>';
    }
}