<?php /* Template Name: Page with tabs */ ?>
<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
    $parents = get_post_ancestors( get_the_ID() );
    $top_level_post = ($parents) ? $parents[count($parents)-1]: get_the_ID();
    $children = get_children(array(
        "post_parent"=>$top_level_post,
        "post_type"=>'page',
        "post_status"=>'publish',
        "orderby"=>"menu_order",
        "order"=>"ASC"
    )); 
    $tsg_page_kicker = get_post_meta($top_level_post, 'tsg_page_kicker', true);
?>
<div class="layout layout--single-column">
    <?php get_template_part('components/topbar'); ?>
    <?php include( locate_template( 'components/header-small.php', false, false ) ); ?>
    <main class="layout__content">
        <div class="layout__content-inner wrapper">
            <div class="prose prose--wp prose--wide">
                <?php include( locate_template( 'components/subpage-tabs.php', false, false ) ); ?>
                <h2 class="prose__h2-long">
                    <?php if($top_level_post != get_the_id()): ?>
                    <?php the_title(); ?>
                    <?php endif; ?>
                </h2>
                <section class="prose__section">
                    <?php the_content(); ?>
                </section>
            </div>
        </div>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
