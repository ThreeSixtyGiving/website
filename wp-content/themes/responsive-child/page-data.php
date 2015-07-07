<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pages Template
 *
 *
 * @file           page.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<div id="content" class="<?php echo esc_attr( implode( ' ', responsive_get_content_classes() ) ); ?>">

	<?php if ( have_posts() ) : ?>

		<?php while( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'loop-header', get_post_type() ); ?>

			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php responsive_entry_top(); ?>

				<?php get_template_part( 'post-meta', get_post_type() ); ?>

				<div class="post-entry">

					<?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
          
          <?php
            
            $dir = ABSPATH . 'wp-content/themes/responsive-child/ckan';
            $path = $dir . "/ckan";
            
            $filename = $path . '/arts-council-england';
            //echo $filename;
           // echo date ("F d Y H:i:s.", filemtime($filename));

              if (!file_exists($filename)) {
                  require_once $dir . '/ckan.php';
                  echo 'Data fetched: ' . date ("F d Y H:i:s.", time());
              } elseif (date("U",filectime($filename) <= time() - 10)) {
                  require_once $dir . '/ckan.php';
                  echo 'Data last checked: ' . date ("F d Y H:i:s.", time());
              } else {
                  echo 'Data last checked: ' . date ("F d Y H:i:s.", filemtime($filename));
              }

            
            
            if ($handle = opendir($path)) {
                while (false !== ($file = readdir($handle))) {
                    if ('.' === $file) continue;
                    if ('..' === $file) continue;
                    
                    $json = file_get_contents($path . '/' . $file);
                    $data = json_decode($json);
                   // echo $file;
                    //print_r($results);
                    foreach ($data->result as $result) {
                      //print_r($package);
                      try {
                          echo '<h2>' . $result->groups[0]->display_name . '</h2>';
                          echo '<img src="' . $result->groups[0]->image_display_url . '" width=150 height=150 alt="' . $result->groups[0]->display_name .' logo" />';
                          echo '<p>Datasets: ' . $result->title . '</p>';
                          foreach ($result->resources as $resource) {
                            echo '<ul>'; 
                            echo '<li><a href="' . $resource->url . '">' . $resource->name . '(' . $resource->format . ')</a></li>';
                            echo '</ul>';
                          }
                      } catch (Exception $e) {
                          // Catch exceptions here to prevent one url from breaking an entire publisher
                          print 'Caught exception in '.$file.': ' . $e->getMessage();
                      }
                    }
                    //echo $data->result->groups->display_name;
                }
                closedir($handle);
            }
          
          ?>
					<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
				</div><!-- end of .post-entry -->

				<?php get_template_part( 'post-data', get_post_type() ); ?>

				<?php responsive_entry_bottom(); ?>
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>
