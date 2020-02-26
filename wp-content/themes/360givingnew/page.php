<?php
$users = get_users(array(
    'meta_key'     => 'jobtitle',
    'fields'       => 'all_with_meta',
));
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
    $parents = get_post_ancestors( get_the_ID() );
    $top_level_post = ($parents) ? $parents[count($parents)-1]: get_the_ID();
    $children = get_children(array(
        "post_parent"=>$top_level_post,
        "post_type"=>'page',
        "post_status"=>'publish'
    )); 
?>
<div class="layout <?php if(!$children): ?>layout--single-column<?php else: ?>layout--two-columns<?php endif; ?>">
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <section class="cards-section">
            <h2 class="cards-section__heading"><?php the_title(); ?></h2>
            <h2 class="cards-section__tagline"></h2>
        </section>
        <div class="layout__content-inner">
            <div class="prose prose--wp">
                <section class="prose__section">
                    <?php the_content(); ?>
                </section>
            </div>
        </div>
    </main>
    <?php include( locate_template( 'components/page-sidebar.php', false, false ) ); ?>
    <?php get_template_part('components/page-sidebar'); ?>
    <?php get_template_part('components/footer'); ?>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>