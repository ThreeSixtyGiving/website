<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pages Template
 *
 *
 * @file           page-data.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

/*
 * This template is used to display the data pulled from CKAN
 * 
 * The data is pulled in one go via the CKAN API, stored locally, and 
 * then we iterate over the stored data to display information on this
 * page
 * 
*/ 
get_header(); ?>
<div class="container">
<div id="content" class="<?php //echo esc_attr( implode( ' ', responsive_get_content_classes() ) ); ?>">
  
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
            //Fetch and display the data from CKAN
            $dir = ABSPATH . 'wp-content/themes/responsive-child/ckan';
            $path = $dir . "/ckan";
            
            //Check to see if we need to refresh the data
            //We check to see if one of the files is older than $cache_time
            $filename = $path . '/arts-council-england';
            $cache_time = 7200; // 2 hours
            //echo $filename;
           // echo date ("F d Y H:i:s.", filemtime($filename));

              if (!file_exists($filename)) { //no data
                  require_once $dir . '/ckan.php';
                  echo 'Data fetched: ' . date ("F d Y H:i:s.", time());
              } elseif (date("U",filectime($filename) <= time() - $cache_time)) { // data older than cache time
                  require_once $dir . '/ckan.php';
                  echo 'Data last checked: ' . date ("F d Y H:i:s.", filemtime($filename));
              } else { // data is still fresh
                  echo 'Data last checked: ' . date ("F d Y H:i:s.", filemtime($filename));
              }

            
            //Confident we have some data??
            //Loop over all our CKAN 'group' files and extract data
            //Build a table
            echo '<table class="data-table"><thead><th>Logo</th><th>Organisation</th><th>Data</th><th>Last Updated</th></thead><tbody>';
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
                      $logo_file = "";
                      try {
                          //logo
                          //stored in a file called /logos/$file.$extension
                          //To get the extension
                          if ($result->groups[0]->image_display_url) {
                            $logo_link = $result->groups[0]->image_display_url;
                            $extension = explode('/', $logo_link); //split into path components
                            $extension = array_pop($extension); // grab the last part of the path
                            $extension = explode('.', $extension); // split into values seperated by .'s
                            $extension = array_pop($extension); // get the last one. This should be e.g. jpg
                            //print_r($extension); die;
                            $logo_file = get_stylesheet_directory_uri() . '/ckan/logos/' . $file . '.' . $extension;
                          }
                          //echo '<img src="' . $result->groups[0]->image_display_url . '" width=150 height=150 alt="' . $result->groups[0]->display_name .' logo" />';
                          foreach ($result->resources as $resource) {
                          echo '<tr>'; 
                          
                          
                          
                          echo '<td class="logo-cell">';
                            if (!empty($logo_file)) { echo '<img src="' . $logo_file . '" width=150 height=150 alt="' . $result->groups[0]->display_name .' logo" />'; }
                          echo '</td>';
                          echo '<td>' . $result->groups[0]->display_name . '</td>';
                          echo '<td>' . $result->title . ':';
                         
                            //echo '<ul>'; 
                            //echo '<li><a href="' . $resource->url . '">' . $resource->name . '(' . $resource->format . ')</a></li>';
                            echo '<a href="' . $resource->url . '">' . $resource->name . '(' . $resource->format . ')</a>';
                            //echo '</ul>';
                            echo '</td>';
                            echo '<td>' . $resource->revision_timestamp . '</td>';
                          
                          echo '</tr>';
                          }
                      } catch (Exception $e) {
                          // Catch exceptions here to prevent one url from breaking an entire publisher
                          print 'Caught exception in '.$file.': ' . $e->getMessage();
                      }
                    
                    }
                    //echo $data->result->groups->display_name;
                }
                closedir($handle);
                echo '</tbody></table>';
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
</div><!-- end of .container -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
