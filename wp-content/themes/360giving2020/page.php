<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="layout layout--single-column">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <div class="layout__content-inner wrapper">
            <div class="prose prose--wp">
                <h1 class="prose__h1-long"><?php the_title(); ?></h1>
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