<?php
    $posts_on_frontpage = 5;

    /** Grab the sticky post ID's */
    $sticky = get_option('sticky_posts');

    /** Query the sticky posts */
    $args = array(
        'post__in'          => $sticky,
        'posts_per_page'    => $posts_on_frontpage,
        'post_type'         => 'post'
    );
    $sq = new WP_Query($args);

    /** Count the number of post returned by this query */
    $sq_count = $sq->post_count;

    /** Check to see if any non-sticky posts need to be output */
    if($sq_count < $posts_on_frontpage) :

        $num_posts = $posts_on_frontpage - $sq_count;

        /** Query the non-sticky posts */
        $sticky = get_option('sticky_posts');
        $args = array(
            'post__not_in'      => $sticky,
            'posts_per_page'    => $num_posts,
            'post_type'         => 'post'
        );
        $nq = new WP_Query($args);
        $sq->posts = array_merge($nq->posts, $sq->posts);
        $sq->post_count += $nq->post_count;

    endif;
?><?php get_header(); ?>
<div class="layout layout--single-column">
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">

        <div class="cards-section">
            <section class="grid grid--three-columns">
                <div class="grid__all">
                    <h2 class="cards-section__tagline">
                        <?php echo get_theme_mod( 'tsg_cards_tagline', TSG_DEFAULTS['cards_tagline'] ); ?></h2>
                </div>
                <?php get_sidebar('front-page'); ?>
            </section>
        </div>

        <?php if ( get_option( 'show_on_front' ) == 'page' & have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="base-section">
            <div class="base-card base-card--none">
                <?php the_content(); ?>
            </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>

        <?php get_template_part('components/front-page-numbers') ?>

        <section class="cards-section">
            <h2 class="cards-section__heading">From the Blog</h2>
            <ul class="card-list">
                <?php if ( $sq->have_posts() ) : ?>
                <?php $count = 0; ?>
                <?php while ( $sq->have_posts() & $count < $posts_on_frontpage ) : $sq->the_post(); ?>
                <li class="card-list__item">
                    <?php get_template_part('components/post-card'); ?>
                </li>
                <?php $count++; ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </ul>
            <div class="align-center">
                <a href="/category/ideas-and-updates" class="button button--teal">Ideas &amp; Updates</a>
            </div>
        </section>


    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>