<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Index Template
 *
 *
 * @file           index.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/index.php
 * @link           http://codex.wordpress.org/Theme_Development#Index_.28index.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<div id="content">
    
  <!--Page Content-->
	<?php if ( have_posts() ) : ?>
		<?php while( have_posts() ) : the_post(); ?>

			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="container">
          <?php responsive_entry_top(); ?>

          <?php get_template_part( 'post-meta', get_post_type() ); ?>

          <div class="post-entry">
            <?php if ( has_post_thumbnail() ) : ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail(); ?>
              </a>
            <?php endif; ?>
            
            <div class="main-logo grid col-460"><img src="wp-content/themes/responsive-child/360Giving-logo.png" width=403 height=205 alt="360Giving Logo" /></div>
            
            <?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>

          </div><!-- end of .container -->
        </div><!-- end of .post-entry -->
            <div class="banner data">
              <div class="container">
                <h2><?php the_field('featured_text_1'); ?></h2>
                <div class="grid col-300 fit first">
                    <a class="call-to-action" href="<?php the_field('call_to_action_1_links_to'); ?>"><?php the_field('call_to_action_1'); ?></a>
                </div>
                <div class="grid col-300 fit">
                    <a class="call-to-action" href="<?php the_field('call_to_action_2_links_to'); ?>"><?php the_field('call_to_action_2'); ?></a>
                </div>
                <div class="grid col-300 fit">
                    <a class="call-to-action" href="<?php the_field('call_to_action_3_links_to'); ?>"><?php the_field('call_to_action_3'); ?></a>
                </div>
              </div><!-- end of .container -->
            </div><!-- end of .banner data -->
        <?php
		endwhile;

		get_template_part( 'loop-nav', get_post_type() );

	else :

		get_template_part( 'loop-no-posts', get_post_type() );

	endif;
	?>
            <!--End of Page content - now get Blog-->
            <div class="container">
              <div class="banner blog">
                <h2>Blog</h2>
              </div>
            <?php $my_query = "showposts=3"; $my_query = new WP_Query($my_query); $i=0;?>
            <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <?php $i++; ?>
              <?php if ($i==1): ?>
              <!-- standard tags to display blog post information like the_title() here -->
              <div class="blog-main grid col-540">
                <?php responsive_entry_top(); ?>
                <?php get_template_part( 'post-meta', get_post_type() ); ?>
                <div class="post-entry">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                      <?php the_post_thumbnail(); ?>
                    </a>
                  <?php endif; ?>
                  <?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
                  <?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
                </div><!-- end of .post-entry -->
              </div>
              <?php else: //$i>1 ?>
                <div class="blog-side grid col-300">
                  <?php responsive_entry_top(); ?>
                  <?php get_template_part( 'post-meta', get_post_type() ); ?>
                  <div class="post-entry">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail(); ?>
                      </a>
                    <?php endif; ?>
                    <?php //the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
                    <?php //wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
                  </div><!-- end of .post-entry -->
                  </div>
              <?php endif; //$i ?>
              
            <?php endwhile; // end of one post ?>
            <?php endif; //end of loop ?>
          </div><!-- end of .container -->
          
          

         <!--End of blog, now get page content again--> 
 	<?php if ( have_posts() ) : ?>

		<?php while( have_posts() ) : the_post(); ?> 
    
    
              <div class="banner subscribe">
              <div class="container">
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                <form action="//threesixtygiving.us10.list-manage.com/subscribe/post?u=216b8b926250184f90c7198e8&amp;id=91870dde44" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div id="mc_embed_signup_scroll">
                    <h2>Subscribe to our mailing list</h2>
                <div class="mc-field-group">
                    <label for="mce-EMAIL">Email Address</label><br/>
                    <input type="email" placeholder="Email Address" value="" name="EMAIL" class="email" id="mce-EMAIL"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_216b8b926250184f90c7198e8_91870dde44" tabindex="-1" value=""></div>
                    
                    </div>
                </form>
                </div>

<!--End mc_embed_signup-->
              </div><!-- end of .container -->
            </div><!-- end of .banner subscribe -->
    
            <!--Logos section-->
            <div class="banner who" style="height:200px">
              <div class="container">
                <h2>Who's Involved</h2>
                <?php
                //**Fetch and display the logos pulled and stored from CKAN**//
                //Where are the logso?
                $dir = ABSPATH . 'wp-content/themes/responsive-child/ckan';
                $path = $dir . "/logos";
                
                if ($handle = opendir($path)) {
                while (false !== ($file = readdir($handle))) {
                    if ('.' === $file) continue;
                    if ('..' === $file) continue;
                    
                    echo '<div class="grid col-220">';
                    echo '<img src="' . get_stylesheet_directory_uri() . '/ckan/logos/' . $file . '" alt="" width=150 height=150 />';
                    echo '</div>';
                  }
                }
                ?>
              </div><!-- end of .container -->
    </div><!-- end of .banner -->
    
    
    
    
            <div class="banner involved">
              <div class="container">
                <h2><?php the_field('featured_text_2'); ?></h2>
                <div class="grid col-300 fit first">
                    <a class="call-to-action" href="<?php the_field('action_4_links_to'); ?>"><?php the_field('call_to_action_4'); ?></a>
                </div>
                <div class="grid col-300 fit">
                    <a class="call-to-action" href="<?php the_field('action_5_links_to'); ?>"><?php the_field('call_to_action_5'); ?></a>
                </div>
              </div><!-- end of .container -->
            </div><!-- end of .banner subscribe -->
            
            
        <div class="post-entry">
          <div class="container">
          <?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
          </div><!-- end of .container -->
				</div><!-- end of .post-entry -->
        <div class="container">
				<?php get_template_part( 'post-data', get_post_type() ); ?>

				<?php responsive_entry_bottom(); ?>
        </div><!-- end of .container -->
			</div><!-- end of #post-<?php the_ID(); ?> -->
			<?php responsive_entry_after(); ?>

			<?php //responsive_comments_before(); ?>
			<?php //comments_template( '', true ); ?>
			<?php //responsive_comments_after(); ?>

		<?php
		endwhile;

		get_template_part( 'loop-nav', get_post_type() );

	else :

		get_template_part( 'loop-no-posts', get_post_type() );

	endif;
	?>

</div><!-- end of #content -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
