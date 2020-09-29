<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" class="screen-reader-only">Search</label>
    <input type="search" class="search-field <!-- js-search-filter -->" name="s" id="s" placeholder="Search" value="<?php the_search_query(); ?>" />
    <!-- <input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" /> -->
</form>