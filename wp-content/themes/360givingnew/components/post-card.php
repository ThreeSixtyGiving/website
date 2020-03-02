<article class="media-card media-card--teal">

    <div class="media-card__content">
        <header class="media-card__header">
            <h3 class="media-card__heading">
                <a href="<?php the_permalink() ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
        </header>
        <p><?php the_excerpt('…'); ?></p>
        <div class="media-card__byline">
            Written by
            <?php the_author_posts_link(); ?> on
            <?php the_time('F j, Y'); ?>.
        </div>
        <div class="media-card__byline">
            <?php 
                $breadcrumbs = tsg_get_breadcrumbs(get_the_ID(), false, true);
                $count = 0;
            ?>
            <?php foreach($breadcrumbs as $b): ?>
            <?php if($count>0): ?> &gt; <?php endif; ?>
            <a class="" href="<?php echo $b["url"]; ?>"><?php echo $b["title"]; ?></a>
            <?php $count++; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (has_post_thumbnail()) :?>
    <div class="media-card__image-wrapper">
        <div class="media-card__image" style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>)"></div>
    </div>
    <?php endif; ?>

</article>