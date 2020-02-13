<?php
$users = get_users(array(
    'meta_key'     => 'jobtitle',
    'fields'       => 'all_with_meta',
));
?>
<?php get_header(); ?>
<div class="layout layout--single-column">
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <section class="cards-section">
            <h2 class="cards-section__heading"><?php the_title(); ?></h2>
            <h2 class="cards-section__tagline"></h2>
        </section>
        <div class="layout__content-inner">
            <div class="prose">
                <section class="prose__section">
                    <?php the_content(); ?>
                </section>
            </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>