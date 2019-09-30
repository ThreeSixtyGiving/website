<?php

	define( 'ASSET', get_stylesheet_directory_uri() . '/assets/' );
	define( 'PARTIAL', 'partials/' );

	// ADD ASSETS
	function custom_queue_scripts_custom() {
		wp_enqueue_style( 'design',  get_stylesheet_directory_uri() . '/assets/css/theme.css', array( 'uikit', 'bootstrap', 'fontawesome', 'loki' ));
		wp_enqueue_script( 'detect', get_stylesheet_directory_uri() . '/assets/js/detect.js', array( 'jquery' ), '1', true );
		wp_enqueue_script( 'countup', get_stylesheet_directory_uri() . '/assets/js/countup.js', array( 'jquery' ), '1', true );
		wp_enqueue_script( 'headroom', get_stylesheet_directory_uri() . '/assets/js/headroom.js', array( 'jquery' ), '1', true );
		wp_enqueue_script( 'theme', get_stylesheet_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '1', true );
	}
	add_action( 'wp_enqueue_scripts', 'custom_queue_scripts_custom' );

	// MENU LOCATIONS
	register_nav_menus(array(
		'main' => __( 'Main', 'loki' ),
		'footer_1' => __( 'Footer 1', 'loki' ),
		'footer_2' => __( 'Footer 2', 'loki' ),
	));

	// IMAGE SIZES
	add_image_size( 'square', 600, 600, true );
	add_image_size( 'square_small', 300, 300, true );
	add_image_size( 'banner', 1500, 520, true );
	add_image_size( 'post', 600, 400, true );

	// HOME PAGE ID
	function hp_id() {
		return get_option('page_on_front');
	}

	function split_heading( $str = '', $spilt_on = '|' ) {
		if ( strpos($str, $spilt_on) !== false ) {
			$parts = explode( $spilt_on, $str );
			return $parts[0] . ' <strong>' . $parts[1] . '</strong>';
		}
		return $str;
	}

	// WRAP VIDEOS IN DIV
	add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;
	function custom_oembed_filter($html, $url, $attr, $post_ID) {
		$return = '<div class="video-container">'.$html.'</div>';
		return $return;
	}


	// AJAX LOADER FOR CONTACT FORM
	add_filter('wpcf7_ajax_loader', 'my_wpcf7_ajax_loader');
	function my_wpcf7_ajax_loader () {
		return  get_bloginfo('stylesheet_directory') . '/assets/img/ajax-loader.gif';
	}

	// GET MEDIA URL BY ID
	function get_attachment_image_url( $attachment_id, $size = 'square' ) {
		$image = wp_get_attachment_image_src( $attachment_id, $size );
		return isset($image[0]) ? $image[0] : false;
	}

	// GET MEDIA URL BY IMAGE URL
	function get_attachment_image_by_url( $attachment_url, $size = 'square' ) {
		$attachment_id = z_get_attachment_id_by_url( $attachment_url );
		$image = wp_get_attachment_image_src( $attachment_id, $size );
		return isset($image[0]) ? $image[0] : false;
	}

	// GET FEATURED IMAGE URL BY POST ID
	function get_featured_image_url( $post_id, $size = 'square' ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
		return isset($image[0]) ? $image[0] : false;
	}

	// GET LINK FOR TEL
	function get_tel_link($meta) {
		return $telLink = 'tel:+44'.substr(str_replace(' ', '', get_global_meta( get_option('page_on_front'), $meta )), 1);
	}

	// GET META BY POST ID
	function get_global_meta( $post_id, $key ) {
		$meta = loki_meta($key, array(), $post_id);
		return isset($meta) ? $meta : false;
	}

	// GET IMAGE URL BY PAGE ID AND META KEY
	function get_meta_image_url( $post_id, $key, $size, $return = 'image' ) {
		$image = loki_meta($key, array(), $post_id);

		if ( is_array($image) ) {
			$image = array_shift(array_slice($image, 0, 1));
		}

		if ( $return == 'image'  ) {
			if ( is_array($image) ) {
				return wp_get_attachment_image( $image['ID'], $size );
			} else {
				return wp_get_attachment_image( $image, $size );
			}
			return wp_get_attachment_image( $image['ID'], $size );
		} else

		if ( $return == 'url' ) {
			if ( is_array($image) ) {
				$image = wp_get_attachment_image_src( $image['ID'], $size );
			} else {
				$image = wp_get_attachment_image_src( $image, $size );
			}
			return isset($image[0]) ? $image[0] : false;
		}
	}

	// HIDE EMAIL ADDRESS FROM SPAM BOTS
	if ( ! function_exists('safe_mailto')) {
		function safe_mailto($email, $title = '', $attributes = '') {
			$title = (string) $title;
			if ($title == "") {
				$title = $email;
			}
			for ($i = 0; $i < 16; $i++) {
				$x[] = substr('<a href="mailto:', $i, 1);
			}
			for ($i = 0; $i < strlen($email); $i++) {
				$x[] = "|".ord(substr($email, $i, 1));
			}
			$x[] = '"';
			if ($attributes != '') {
				if (is_array($attributes)) {
					foreach ($attributes as $key => $val) {
						$x[] =  ' '.$key.'="';
						for ($i = 0; $i < strlen($val); $i++) {
							$x[] = "|".ord(substr($val, $i, 1));
						}
						$x[] = '"';
					}
				} else {
					for ($i = 0; $i < strlen($attributes); $i++) {
						$x[] = substr($attributes, $i, 1);
					}
				}
			}
			$x[] = '>';
			$temp = array();
			for ($i = 0; $i < strlen($title); $i++) {
				$ordinal = ord($title[$i]);
				if ($ordinal < 128) {
					$x[] = "|".$ordinal;
				} else {
					if (count($temp) == 0) {
						$count = ($ordinal < 224) ? 2 : 3;
					}
					$temp[] = $ordinal;
					if (count($temp) == $count) {
						$number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);
						$x[] = "|".$number;
						$count = 1;
						$temp = array();
					}
				}
			}
			$x[] = '<'; $x[] = '/'; $x[] = 'a'; $x[] = '>';
			$x = array_reverse($x);
			ob_start();
		?><script type="text/javascript">
		//<![CDATA[
		var l=new Array();
		<?php
		$i = 0;
		foreach ($x as $val){ ?>l[<?php echo $i++; ?>]='<?php echo $val; ?>';<?php } ?>
		for (var i = l.length-1; i >= 0; i=i-1){
		if (l[i].substring(0, 1) == '|') document.write("&#"+unescape(l[i].substring(1))+";");
		else document.write(unescape(l[i]));}
		//]]>
		</script><?php
			$buffer = ob_get_contents();
			ob_end_clean();
			return $buffer;
		}
	}

	// SOCIAL MEDIA SHARE SHORTCODE
	function add_social( $content = '' ) { ?>
		<?php ob_start(); ?>
	 	<div class="share-button">
		 	<!-- AddToAny BEGIN -->
		 	<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
		 	<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
		 	<a class="a2a_button_facebook"></a>
		 	<a class="a2a_button_twitter"></a>
		 	<a class="a2a_button_linkedin"></a>
		 	<a class="a2a_button_google_plus"></a>
		 	<!-- <a class="a2a_button_pinterest"></a> -->
		 	<!-- <a class="a2a_button_email"></a> -->
		 	</div>
		 	<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
			<!-- AddToAny END -->
	 	</div>
		<?php
		 	$buffer = ob_get_contents();
		 	ob_end_clean();
		 	return $content . $buffer;
	 	?>
	<?php }
	add_shortcode('share', 'add_social');

	// LOGIC DASHBOARD WIDGET
	add_action( 'wp_dashboard_setup', 'register_logic_dashboard_widget' );
	function register_logic_dashboard_widget() {
		wp_add_dashboard_widget(
			'logic_dashboard_widget',
			'Welcome',
			'logic_dashboard_widget_display'
		);
	}
	function logic_dashboard_widget_display() { ?>
		<p>Welcome to your website admin area! If you have any questions, please give Logic Design a call or drop us an email using the details below.</p>
		<p><i style="display:inline-block;width: 30px;" class="dashicons-before dashicons-phone"></i><strong>01284 706 842</strong></p>
		<p><i style="display:inline-block;width: 30px;" class="dashicons-before dashicons-email-alt"></i><a href="mailto:hello@logicdesign.co.uk">hello@logicdesign.co.uk</a></p>
		<p><i style="display:inline-block;width: 30px;" class="dashicons-before dashicons-admin-site"></i><a href="https://www.logicdesign.co.uk/" target="_blank">www.logicdesign.co.uk</a></p>
	<?php }

	// LOKI LAST
	require_once 'framework/init.php';
	// require_once 'framework/install.php';