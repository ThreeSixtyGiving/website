<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Archive Template
 *
 *
 * @file           archive.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/responsive/archive.php
 * @link           http://codex.wordpress.org/Theme_Development#Archive_.28archive.php.29
 * @since          available since Release 1.0
 */

get_header();

global $more;
$more = 0;
?>
<div class="container">
	<div id="content-blog" class="<?php //echo esc_attr( implode( ' ', responsive_get_content_classes() ) ); ?>">

		<!-- Category page title -->
		<h1> <?php single_cat_title(); ?></h1>

		<?php get_template_part( 'loop-header', get_post_type() ); ?>

		<?php if ( have_posts() ) : ?>
      <?php $postCount = 0; ?>
			<?php while( have_posts() ) : the_post(); 
        $postCount++;
      ?>
          

				<?php responsive_entry_before(); ?>
				<div id="post-<?php the_ID(); ?>" <?php if ($postCount == sizeof($posts)) { post_class('last-post'); } else { post_class(); } ?>>
          <?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail(); ?>
							</a>
          <?php endif; ?>
          
					<?php responsive_entry_top(); ?>

					<?php get_template_part( 'post-meta', get_post_type() ); ?>

					<div class="post-entry">
						
						<?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
					</div>
					<!-- end of .post-entry -->

					<?php get_template_part( 'post-data', get_post_type() ); ?>

					<?php responsive_entry_bottom(); ?>
				</div><!-- end of #post-<?php the_ID(); ?> -->
				<?php responsive_entry_after(); ?>

			<?php
			endwhile;

			get_template_part( 'loop-nav', get_post_type() );

		else :

			get_template_part( 'loop-no-posts', get_post_type() );

		endif;
		?>

	</div><!-- end of #content-blog -->
</div><!-- end of .container -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
