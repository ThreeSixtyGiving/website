<?php get_header(); ?>
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

        <?php get_template_part('components/front-page-numbers') ?>

        <?php if ( have_posts() ) : ?>
        <?php $count = 0; ?>
        <section class="cards-section">
            <h2 class="cards-section__heading">From the Blog</h2>
            <ul class="card-list">
                <?php while ( have_posts() & $count < 5 ) : the_post(); ?>
                <li class="card-list__item">
                    <?php get_template_part('components/post-card'); ?>
                </li>
                <?php $count++; ?>
                <?php endwhile; ?>
            </ul>
            <div class="align-center">
                <a href="#" class="button button--teal">More from the blog</a>
            </div>
        </section>
        <?php endif; ?>

        <div class="base-section">
            <div class="base-card base-card--none" style="height: 500px; padding: 80px;">
                <h1 style="opacity: .3;">INSERT HTML HERE</h1>
            </div>
        </div>



    </main>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>