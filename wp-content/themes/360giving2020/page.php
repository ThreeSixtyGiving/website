<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="layout <?php if(!$children): ?>layout--single-column<?php else: ?>layout--two-columns<?php endif; ?>">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <?php if(empty(get_post_meta(get_the_ID(), 'tsg_page_kicker', true))): ?>
        <section class="cards-section">
            <h2 class="cards-section__heading"><?php the_title(); ?></h2>
            <h2 class="cards-section__tagline"></h2>
        </section>
        <?php endif; ?>
        <div class="layout__content-inner">
            <div class="prose prose--wp">
                <section class="prose__section">
                    <?php the_content(); ?>
                </section>
            </div>
        </div>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>