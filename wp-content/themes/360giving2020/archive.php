<?php get_header(); ?>
<div class="layout layout--two-columns">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <?php if ( have_posts() ) : ?>
        <div class="layout__content-inner wrapper">
            <div class="wrapper">
                <section class="cards-section">
                    <?php if ( is_category() ): ?>
                    <!-- <h1 class="cards-section__heading"><?php echo single_cat_title( '', false ); ?></h1>
                    <div class="cards-section__tagline"><?php echo category_description(); ?></div> -->
                    <?php elseif ( is_author() ): ?>
                    <h1 class="cards-section__heading"><?php echo get_the_author(); ?></h1>
                    <p class="cards-section__tagline"><?php the_author_description(); ?></p>
                    <?php else: ?>
                    <h1 class="cards-section__heading"><?php the_archive_title(); ?></h1>
                    <?php endif; ?>
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
                </section>
            </div>
        </div>
        <?php endif; ?>
    </main>
    <?php get_template_part('components/blog-sidebar'); ?>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>