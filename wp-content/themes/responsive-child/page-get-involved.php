<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Template Name: Get Invovled Page
 *
 *
 * @file           page-get-involved.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since        available since Release 1.0
 */

get_header(); ?>

<div id="content" class="<?php //echo esc_attr( implode( ' ', responsive_get_content_classes() ) ); ?>">

	<?php if ( have_posts() ) : ?>

		<?php while( have_posts() ) : the_post(); ?>
      <div class="container">
			<?php get_template_part( 'loop-header', get_post_type() ); ?>

			<?php responsive_entry_before(); ?>
      </div><!-- end of .container -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="container">
				<?php responsive_entry_top(); ?>

				<?php get_template_part( 'post-meta', get_post_type() ); ?>

				<div class="post-entry">
					<?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
        </div><!-- end of .post-entry -->
        </div><!-- end of .container -->
            <div class="banner involved">
              <div class="container">
                <h2><?php the_field('banner_text'); ?></h2>
                <div class="grid col-300 fit first">
                    <a class="call-to-action" href="<?php the_field('link_1_destination'); ?>"><?php the_field('link_1_text'); ?></a>
                </div>
                <div class="grid col-300 fit">
                    <a class="call-to-action" href="<?php the_field('link_2_destination'); ?>"><?php the_field('link_2_text'); ?></a>
                </div>
              </div><!-- end of .container -->
            </div><!-- end of .banner subscribe -->
          
        <div class="post-entry">
          <div class="container">
					<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
				</div><!-- end of .post-entry -->

				<?php get_template_part( 'post-data', get_post_type() ); ?>

				<?php responsive_entry_bottom(); ?>
        </div><!-- end of .container -->
			</div><!-- end of #post-<?php the_ID(); ?> -->

			<?php responsive_entry_after(); ?>

			<?php responsive_comments_before(); ?>
			<?php comments_template( '', true ); ?>
			<?php responsive_comments_after(); ?>

		<?php
		endwhile;

		get_template_part( 'loop-nav', get_post_type() );

	else :

		get_template_part( 'loop-no-posts', get_post_type() );

	endif;
	?>


</div><!-- end of #content -->
</div><!-- end of .container -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
