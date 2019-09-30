<?php
/**
*
*	WordPress Theme Framework by Logic Design
*
*	Codename: Project Loki
*
*	Copyright 2016 Logic Design under Propriatary License
*	Unauthorised use, reverse-engineering, copying, sharing is strictly prohibited.
*
**/

/**
*
*	Shortcodes
*
*	TOC:
*	shortcode_empty_paragraph_fix
*	lead_shortcode
*	divider_shortcode
*	expand_shortcode
*	c2a_shortcode
*	row_shortcode
*	col_shortcode
*	partial
*	button
*	accordion
*	accordion_group
*	map
*	googlemap
*	slider
*	slide
*	contact-form-7'
*
*/

/****************************************************/
/*                                                  */
/*           shortcode_empty_paragraph_fix          */
/*                                                  */
/****************************************************/

function shortcode_empty_paragraph_fix( $content ) {

	// define your shortcodes to filter, '' filters all shortcodes
	$shortcodes = array( 'lead', 'divider', 'divide', 'expand', 'row', 'col', 'partial', 'button', 'accordion', 'accordion_group', 'map', 'slider', 'slide', 'googlemap' );

	foreach ( $shortcodes as $shortcode ) {

		$array = array (
			'<p>[' . $shortcode => '[' .$shortcode,
			'<p>[/' . $shortcode => '[/' .$shortcode,
			$shortcode . ']</p>' => $shortcode . ']',
			$shortcode . ']<br />' => $shortcode . ']'
		);

		$content = strtr( $content, $array );
	}

	return $content;
}

add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );

/****************************************************/
/*                                                  */
/*                   lead_shortcode                 */
/*                                                  */
/****************************************************/

function lead_shortcode( $atts, $content ) {
	$atts = extract( shortcode_atts( array( 'default'=>'values' ),$atts ) );
	return '<p class="lead">' . $content . '</p>';
}
add_shortcode( 'lead','lead_shortcode' );

/****************************************************/
/*                                                  */
/*                 divider_shortcode                */
/*                                                  */
/****************************************************/

function divider_shortcode() {
	return '<hr>';
}
add_shortcode( 'divider','divider_shortcode' );
add_shortcode( 'divide','divider_shortcode' );

/****************************************************/
/*                                                  */
/*                  expand_shortcode                */
/*                                                  */
/****************************************************/

function expand_shortcode( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'closed' => 'Read More',
		'open' => 'Read Less',
	), $atts );

	$rand = rand(100000, 999999);

	$html = '';

	$html .= '<div class="clearfix"></div>';
	$html .= '<div class="collapse" id="collapseExample_' . $rand . '">' . $content . '</div>';
	$html .= '<a class="collapse-btn btn btn-primary" role="button" data-closed="' . $atts['closed'] . '" data-open="' . $atts['open'] . '" data-toggle="collapse" href="#collapseExample_' . $rand . '" aria-expanded="false" aria-controls="collapseExample_' . $rand . '">' . $atts['closed'] . '</a>';

	return $html;

}
add_shortcode( 'expand','expand_shortcode' );

/****************************************************/
/*                                                  */
/*                   c2a_shortcode                  */
/*                                                  */
/****************************************************/

function c2a_shortcode( $atts ) {

	ob_start(); ?>
	<div class="c2a">
		<div class="row">
			<div class="col-md-3">
				<h5>Get in touch with us</h5>
			</div>
			<div class="col-md-9">
				<p class="clearfix">
					<span class="text">If you have any further questions or would like to enquire about any of our products and services, please simply click here to get in touch: </span>
					<span class="button"><a class="btn btn-primary" href="<?php echo get_permalink( 9 ); ?>">Contact us</a></span>
				</p>
			</div>
		</div>
	</div>
	<?php

	return ob_get_clean();

}
add_shortcode( 'c2a','c2a_shortcode' );

/****************************************************/
/*                                                  */
/*                   row_shortcode                  */
/*                                                  */
/****************************************************/

function row_shortcode($atts = array(), $content = null) {
	$content = str_replace("\r\n", '', $content);
	return force_balance_tags('<div class="row row-content">' . force_balance_tags(do_shortcode(force_balance_tags($content))) . '</div><div class="clearfix"></div>');
}
add_shortcode( 'row','row_shortcode' );

/****************************************************/
/*                                                  */
/*                   col_shortcode                  */
/*                                                  */
/****************************************************/

function col_shortcode( $atts, $content = '' ) {

	$atts = shortcode_atts( array(
		'xs' => '',
		'sm' => '',
		'md' => '',
		'lg' => '',
	), $atts );

	$class = array();

	foreach ( $atts as $size => $value ) {
		if ( ! empty( $value ) ) {
			if ( $value == 'hidden' ) {
				$class[] = 'hidden-' . $size;
			} else {
				$class[] = 'col-' . $size . '-' . $value;
			}
		}
	}

	$class = implode( ' ', $class );

	return force_balance_tags('<div class="' . $class . '">' . force_balance_tags(do_shortcode(force_balance_tags($content))) . '</div>');
}
add_shortcode( 'col','col_shortcode' );

/****************************************************/
/*                                                  */
/*                      partial                     */
/*                                                  */
/****************************************************/

function partial( $atts, $content ) {

	$atts = shortcode_atts( array(
		'file' => '',
	), $atts );

	set_query_var( 'content', do_shortcode($content) );
	set_query_var( 'atts', $atts );

	ob_start();

	get_template_part('framework/partials/' . $atts['file']);

	$return = ob_get_contents();

	ob_end_clean();

	return $return;

}
add_shortcode( 'partial','partial' );

/****************************************************/
/*                                                  */
/*                      map                         */
/*                                                  */
/****************************************************/

function map( $atts, $content ) {

	$atts = shortcode_atts( array(
		'lat' => '',
		'lon' => '',
	), $atts );

	set_query_var( 'content', do_shortcode($content) );
	set_query_var( 'atts', $atts );

	ob_start();

	get_template_part('framework/partials/map');

	$return = ob_get_contents();

	ob_end_clean();

	return $return;

}
add_shortcode( 'map','map' );

/****************************************************/
/*                                                  */
/*                       button                     */
/*                                                  */
/****************************************************/

function button( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'url' => '',
	), $atts );

	return '<div class="in-content-button-wrapper"><a href="' . $atts['url'] . '"   class="in-content-button">' . $content . '</a></div>';

}
add_shortcode( 'button', 'button');

/****************************************************/
/*                                                  */
/*                     accordion                    */
/*                                                  */
/****************************************************/

function accordion( $atts, $content = null ) {

	extract(shortcode_atts( array(
		'title' => 'Expand',
		'id' => 'accordion_' . rand(999,99999)
	), $atts ));

	return '<li><h3 class="uk-accordion-title">' . $title . '</h3>' . '<div class="uk-accordion-content">' . force_balance_tags(do_shortcode( force_balance_tags($content) ) ) . '</div></li>';

}
add_shortcode( 'accordion', 'accordion');

/****************************************************/
/*                                                  */
/*                  accordion_group                 */
/*                                                  */
/****************************************************/

function accordion_group( $atts, $content = null ) {
	return '<ul class="uk-accordion" uk-accordion>' . force_balance_tags(do_shortcode( force_balance_tags($content) ) ) . '</ul>';
}
add_shortcode( 'accordion_group', 'accordion_group');

/****************************************************/
/*                                                  */
/*                 slider_shortcode                 */
/*                                                  */
/****************************************************/

function slider_shortcode($atts, $content = null) {

	extract(shortcode_atts( array(
		'arrows' 	=> '',
		'dots' 		=> '',
		'auto'		=> '',
		'speed'		=> ''
	), $atts ));

	if ( empty($arrows) && empty($dots) && empty($auto) && empty($speed) ) {
		return force_balance_tags('<div class="content-slider">' . force_balance_tags(do_shortcode(force_balance_tags($content))) . '</div>');
	} else {
		return force_balance_tags('<div class="content-slider" data-slick=\'{"arrows": ' . $atts['arrows'] . ', "dots": ' . $atts['dots'] . ', "autoplay": ' . $atts['auto'] . ', "autoplaySpeed": ' . $atts['speed'] . '}\'>' . force_balance_tags(do_shortcode(force_balance_tags($content))) . '</div>');
	}
}
add_shortcode( 'slider','slider_shortcode' );

/****************************************************/
/*                                                  */
/*                  slide_shortcode                 */
/*                                                  */
/****************************************************/

function slide_shortcode($atts, $content = null) {

	return force_balance_tags('<div class="slide">' . force_balance_tags(do_shortcode(force_balance_tags($content))) . '</div>');
}
add_shortcode( 'slide','slide_shortcode' );

/****************************************************/
/*                                                  */
/*                googlemap_shortcode               */
/*                                                  */
/****************************************************/

function googlemap_shortcode($atts) {
	$atts = extract(shortcode_atts(array('lon_lat'=>'', 'name' => ''),$atts));

	if ( empty( $lon_lat ) ) {
		return '';
	}

	?>
	<div id="map" style="height: 300px;" class="google-map-container"></div>

	<script src="http://maps.google.com/maps/api/js?key=AIzaSyD-o_SaIr6C-FIL13KQv-U6v0xi2rZrAvU"></script>
	<script>
		var map_location = ["<div style=\"width: 200px;\"><p style='margin:0;'><strong><?php echo $name; ?></strong></p></div>", <?php echo $lon_lat; ?>],
		mapCenter = new google.maps.LatLng(map_location[1], map_location[2]),

		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 14,
			center: mapCenter,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false,
			panControl: false,
			streetViewControl: false,
		}),
		marker = new google.maps.Marker({
			map: map,
			position: mapCenter,
			title: map_location[0],
			zIndex: 9999
		}),
		infowindow = new google.maps.InfoWindow();

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(map_location[0]);
			infowindow.open(map, marker);
		});

	</script>
	<?php

// do shortcode actions here
}
add_shortcode('googlemap','googlemap_shortcode');