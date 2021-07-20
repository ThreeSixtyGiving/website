<?php get_header(); ?>
<div class="layout layout--two-columns">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <div class="layout__content-inner wrapper">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="prose prose--wp">
                <?php if(has_tag()): ?>
                <script type="text/javascript">
                    <?php $tags = get_the_tags(); ?>
                    if (typeof ga === 'function' && ga.loaded){
                        <?php foreach ( $tags as $index=>$tag ): ?>
                        ga('set', 'contentGroup<?php echo $index + 1; ?>', '<?php echo $tag->name; ?>');
                        <?php endforeach; ?>
                    }
                </script>
                <?php /*if(has_tag()): ?><h2 class="prose__brow"><?php the_tags(''); ?></h2><?php endif;*/ ?>
                <?php endif; ?>
                <h1 class="prose__h1-long"><?php the_title(); ?></h1>
                <p class="prose__author">
                    By <?php the_author_posts_link(); ?>
                    <time datetime="<?php the_time('c'); ?>"><?php the_time('F j, Y'); ?></time>
                </p>
                <section class="prose__section">
                    <?php the_content(); ?>
                </section>
            </div>
            <?php  if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
    </main>
    <?php get_template_part('components/blog-sidebar'); ?>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>