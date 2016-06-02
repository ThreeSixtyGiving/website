<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.2
 * @filesource     wp-content/themes/responsive/footer.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */

/*
 * Globalize Theme options
 */
global $responsive_options;
$responsive_options = responsive_get_options();
?>
<?php responsive_wrapper_bottom(); // after wrapper content hook ?>
</div><!-- end of #wrapper -->
<?php responsive_wrapper_end(); // after wrapper hook ?>
</div><!-- end of #container -->
<?php responsive_container_end(); // after container hook ?>

<div id="footer" class="clearfix">
	<?php responsive_footer_top(); ?>

	<div id="footer-wrapper" class="container">

		<?php get_sidebar( 'footer' ); ?>
    
    

		<div class="grid col-940">

			

			<div class="grid col-380 fit">
				<?php echo responsive_get_social_icons() ?>
			</div><!-- end of col-380 fit -->
      
      <div id="shared-footer">
      <div class="grid col-220">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/360logo_invert.png" height="80" width="196">
      </div>
      <div class="grid col-620">
        <p class="footer-info">We provide support for grantmakers to publish their grants data openly, to understand their data, and to use the data to create online tools that make grantmaking more effective.</p>
      </div>
      </div>


		</div><!-- end of col-940 -->
		<?php get_sidebar( 'colophon' ); ?>

    <!--<div class="grid col-300 scroll-top"><a href="#scroll-top" title="<?php esc_attr_e( 'scroll to top', 'responsive' ); ?>"><?php _e( '&uarr;', 'responsive' ); ?></a></div>-->

		<div class="grid col-940 copyright">
			<p class="footer-info">360Giving is a company limited by guarantee (Company Number 9668396) and a registered charity (Charity Number 1164883)</p>
		</div><!-- end of .copyright -->
    
    <div class="grid col-940">
				<?php if ( has_nav_menu( 'footer-menu', 'responsive' ) ) {
					wp_nav_menu( array(
						'container'      => '',
						'fallback_cb'    => false,
						'menu_class'     => 'footer-menu',
						'theme_location' => 'footer-menu'
					) );
				} ?>
			</div><!-- end of col-220 -->
      <div class="grid col-940">
				<?php if ( has_nav_menu( 'second_footer', 'responsive' ) ) {
					wp_nav_menu( array(
						'container'      => '',
						'fallback_cb'    => false,
						'menu_class'     => 'footer-menu',
						'theme_location' => 'second_footer'
					) );
				} ?>

			</div><!-- end of col-220 -->
      
      <div class="grid col-940">
      <p class="footer-info small">This site uses icons from <a href="http://glyphicons.com/">GLYPHICONS.com</a> which are released under the <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 Unported (CC BY 3.0)</a> license.</p>
		</div><!-- end of .copyright -->

		

		<div class="grid col-300 fit powered">
			<a href="<?php echo esc_url( 'http://cyberchimps.com/responsive-theme/' ); ?>" title="<?php esc_attr_e( 'Responsive Theme', 'responsive' ); ?>">
				Responsive Theme</a>
			<?php esc_attr_e( 'powered by', 'responsive' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'responsive' ); ?>">
				WordPress</a>
		</div><!-- end .powered -->

	</div><!-- end #footer-wrapper -->

	<?php responsive_footer_bottom(); ?>
</div><!-- end #footer -->
<?php responsive_footer_after(); ?>

<?php wp_footer(); ?>
<?php if (is_tree(11)): ?>
   <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/toc/dist/toc.js"></script>
    <script>
    jQuery('#toc').toc({
        'selectors': 'h2,h3,h4', //elements to use as headings
        'smoothScrolling': true, //enable or disable smooth scrolling on click
        'prefix': 'toc' //prefix for anchor tags and class names
    });
    </script>
<?php endif; ?>
</body>
</html>
