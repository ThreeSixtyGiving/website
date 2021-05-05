<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="layout <?php if(!$children): ?>layout--single-column<?php else: ?>layout--two-columns<?php endif; ?>">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <section class="cards-section">
            <h1 class="cards-section__heading"><?php the_title(); ?></h1>
        </section>
        <div class="layout__content-inner wrapper">
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