<?php get_header(); ?>
<div class="layout">
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <?php if ( have_posts() ) : ?>
        <div class="layout__content-inner">
            <div class="wrapper">
                <section class="cards-section">
                    <ul class="card-list">
                        <?php while ( have_posts() ) : the_post(); ?>
                        <li class="card-list__item">
                            <?php get_template_part('components/post-card'); ?>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </section>
            </div>
        </div>
        <?php endif; ?>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>