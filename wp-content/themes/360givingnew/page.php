<?php get_header(); ?>
<div class="layout layout--single-column">
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <div class="layout__content-inner">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="prose">
                <section class="prose__section prose__intro">
                    <h1 class="h1"><?php the_title(); ?></h1>
                    <!-- <p class="intro"></p> -->
                </section>
                <section class="prose__section">
                    <?php the_content(); ?>
                </section>
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>