<?php
/**
*
*   WordPress Theme Framework by Logic Design
*
*   Codename: Project Loki
*
*   Copyright 2016 Logic Design under Propriatary License
*   Unauthorised use, reverse-engineering, copying, sharing is strictly prohibited.
*
**/

/**
*
*   Post Meta
*
*   TOC:
*   hp_page_meta_boxes
*
*/

/****************************************************/
/*                                                  */
/*                 hp_page_meta_boxes               */
/*                                                  */
/****************************************************/


	// META BOX
	add_filter( 'rwmb_meta_boxes', 'hp_page_meta_boxes' );
	function hp_page_meta_boxes( $meta_boxes )
	{

		$prefix = '_loki_';

		$meta_boxes[] = array(
			'id' => 'post_meta',
			'title' => 'Post Meta',
			'pages' => array('post'),
			'context' => 'normal',
			'priority' => 'high',
			'show' => array(),
			'fields' => array(
				array(
					'name' => 'Related Articles',
					'id' => $prefix . 'related_articles',
					'type' => 'post',
					'post_type'   => 'post',
					'field_type'  => 'select_advanced',
					'multiple' => true,
					'query_args'  => array(
						'post_status'    => 'publish',
						'posts_per_page' => - 1,
					),
				),
			),
		);

		return $meta_boxes;

	}
