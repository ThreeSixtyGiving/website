<?php get_header(); ?>
<div class="layout layout--single-column">
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">

        <div class="cards-section">
            <section class="grid grid--three-columns">
                <div class="grid__all">
                    <h2 class="cards-section__tagline"><?php echo get_theme_mod( 'tsg_cards_tagline', TSG_DEFAULTS['cards_tagline'] ); ?></h2>
                </div>
                <?php get_sidebar('front-page'); ?>
            </section>
        </div>
        
        <?php get_template_part('components/front-page-numbers') ?>

        <?php if ( have_posts() ) : ?>
        <section class="cards-section">
            <h2 class="cards-section__heading">From the Blog</h2>
            <ul class="card-list">
                <?php while ( have_posts() ) : the_post(); ?>
                <li class="card-list__item">
                    <article class="blog-card">

                        <div class="blog-card__content">
                            <h3 class="blog-card__heading"><?php the_title(); ?></h3>
                            <p><?php the_excerpt(); ?></p>
                            <div class="blog-card__byline">Written by <?php the_author(); ?> on <?php the_time('F j, Y'); ?>.</div>
                        </div>
                        <?php if (has_post_thumbnail()) :?>
                        <div class="blog-card__image"
                            style="background-image: url(<?php the_post_thumbnail( 'medium' ); ?>)">
                        </div>
                        <?php endif; ?>
                    </article>
                </li>
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