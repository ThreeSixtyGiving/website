<?php global $wp_query; ?>
<?php get_header(); ?>
<div class="layout">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <div class="layout__content-inner">
            <div class="wrapper">
                <section class="cards-section">
                    <!-- <h2 class="cards-section__heading">Search results</h2> -->
                    <?php if ( have_posts() ) : ?>
                    <p class="cards-section__tagline">
                        Found 
                        <?php if($wp_query->found_posts == 1): ?>
                        1 result
                        <?php else: ?>
                        <?php echo number_format($wp_query->found_posts); ?>
                        results
                        <?php endif; ?>
                        for "<?php the_search_query(); ?>"
                    </p>
                    <ul class="card-list">
                        <?php while ( have_posts() ) : the_post(); ?>
                        <li class="card-list__item">
                            <?php get_template_part('components/post-card'); ?>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <div class="navigation">
                        <p><?php posts_nav_link(' '); ?></p>
                    </div>
                    <?php else: ?>
                    <p class="cards-section__tagline">
                        No results found
                        for "<?php the_search_query(); ?>"
                    </p>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>