<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: Three Sixty Docs
Plugin URI:  
Description: Parses documentation from git repository via shortcodes
Version:     1.0
Author:      caprenter@gmail.com
Author URI:  
License:     GPLv3
License URI: https://www.gnu.org/licenses/gpl.html
Domain Path: 
Text Domain: 
*/


/*
 * By adding a shortcode to a page, we can parse our documentation from
 * a git repository.
 * 
 * We have cloned that repo locally into a directory inside this plugin
 * threesixtygiving.github.io
 * 
 * The shortcode specifies the page to fetch, turns the markdown into 
 * HTML and then outputs it to the page.
 * 
 * Usage
 * e.g. to display the about page:
 * [standard page="about"]
 * 
 * the 'version' attribute could be used in future to link to a specific
 * git tag
 * 
*/
 
function standard_shortcode( $atts ) {

	// Attributes
	$a = shortcode_atts( array(
            'version' => '',
            'page' => ''
		), $atts );
  
  //Fetch the page from the git repository
  $dir = plugin_dir_path( __FILE__ );
  $page = file_get_contents($dir .'/threesixtygiving.github.io/' . $a['page'] . '.md');
  
  //Turn it into html using the Paresdown library
  include $dir . '/parsedown/Parsedown.php';
  $Parsedown = new Parsedown();
  $page = $Parsedown->text($page);
  return $page; 
}
add_shortcode( 'standard', 'standard_shortcode' );


?>
