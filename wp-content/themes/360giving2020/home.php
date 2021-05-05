<?php get_header(); ?>
<div class="layout layout--two-columns">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <?php if ( have_posts() ) : ?>
        <div class="layout__content-inner wrapper">
            <div class="wrapper">
                <section class="cards-section">
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