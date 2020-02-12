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
                            <article class="media-card media-card--teal">
                                <div class="media-card__content">
                                    <header class="media-card__header">
                                        <h3 class="media-card__heading">
                                            <a href="<?php the_permalink() ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </header>
                                    <p><?php the_excerpt(); ?></p>
                                    <div class="media-card__byline">Written by <?php the_author(); ?> on <?php the_time('F j, Y'); ?>.</div>
                                </div>
                                
                                <?php if (has_post_thumbnail()) :?>
                                <div class="media-card__image-wrapper">
                                    <div class="media-card__image" 
                                         style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>)"></div>
                                </div>
                                <?php endif; ?>      
                            
                            </article>
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