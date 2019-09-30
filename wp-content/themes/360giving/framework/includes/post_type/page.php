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
*   Page Meta
*
*   TOC:
*   hp_page_meta_boxes
*
*/

/****************************************************/
/*                                                  */
/*                 page_meta_boxes               */
/*                                                  */
/****************************************************/


	// META BOX
	add_filter( 'rwmb_meta_boxes', 'page_meta_boxes' );
	function page_meta_boxes( $meta_boxes )
	{

		$prefix = '_loki_';

		$meta_boxes[] = array(
			'id' => 'global',
			'title' => 'Global Configuration',
			'pages' => array( 'page' ),
			'context' => 'normal',
			'priority' => 'high',
			'show' => array(
					'template' => array('front-page.php')
			),
			'fields' => array(
				array(
					'name' => 'Contact Details',
					'type' => 'heading'
				),
				array(
					'name' => 'Telephone Number',
					'id' => $prefix . 'global_tel',
					'type' => 'text'
				),
				array(
					'name' => 'Email Address',
					'id' => $prefix . 'global_email',
					'type' => 'text'
				),
				array(
					'name' => 'Social Links',
					'type' => 'heading'
				),
				array(
					'name' => 'Twitter URL',
					'id' => $prefix . 'global_twitter',
					'type' => 'text'
				),
				array(
					'name' => 'GitHub URL',
					'id' => $prefix . 'global_github',
					'type' => 'text'
				),
			)
		);

		$meta_boxes[] = array(
			'id' => 'hp',
			'title' => 'Home Page',
			'pages' => array( 'page' ),
			'context' => 'normal',
			'priority' => 'high',
			'show' => array(
					'template' => array('front-page.php')
			),
			'fields' => array(
				array(
					'name' => 'Front Page CTAs',
					'type' => 'heading'
				),
				array(
					'name' => 'CTA 1 - Title',
					'id' => $prefix . 'hpcta_1_title',
					'type' => 'text'
				),
				array(
					'name' => 'CTA 1 - Text',
					'id' => $prefix . 'hpcta_1_text',
					'type' => 'textarea'
				),
				array(
					'name' => 'CTA 1 - URL',
					'id' => $prefix . 'hpcta_1_url',
					'type' => 'text'
				),
				array(
					'name' => 'CTA 2 - Title',
					'id' => $prefix . 'hpcta_2_title',
					'type' => 'text'
				),
				array(
					'name' => 'CTA 2 - Text',
					'id' => $prefix . 'hpcta_2_text',
					'type' => 'textarea'
				),
				array(
					'name' => 'CTA 2 - URL',
					'id' => $prefix . 'hpcta_2_url',
					'type' => 'text'
				),
				array(
					'name' => 'CTA 3 - Title',
					'id' => $prefix . 'hpcta_3_title',
					'type' => 'text'
				),
				array(
					'name' => 'CTA 3 - Text',
					'id' => $prefix . 'hpcta_3_text',
					'type' => 'textarea'
				),
				array(
					'name' => 'CTA 3 - URL',
					'id' => $prefix . 'hpcta_3_url',
					'type' => 'text'
				),
				array(
					'name' => 'Stats',
					'type' => 'heading'
				),
				array(
					'name' => 'Stat - Funders',
					'id' => $prefix . 'hpstat_1',
					'type' => 'text'
				),
				array(
					'name' => 'Stat - Recipients (K)',
					'id' => $prefix . 'hpstat_2',
					'type' => 'text'
				),
				array(
					'name' => 'Stat - Grants (K)',
					'id' => $prefix . 'hpstat_3',
					'type' => 'text'
				),
				array(
					'name' => 'Stat - Grant Data (£B)',
					'id' => $prefix . 'hpstat_4',
					'type' => 'text'
				),
				array(
					'name' => 'Announcement Box',
					'type' => 'heading'
				),
				array(
					'name' => 'Announcement - Title',
					'id' => $prefix . 'hpann_title',
					'type' => 'text'
				),
				array(
					'name' => 'Announcement - Text',
					'id' => $prefix . 'hpann_text',
					'type' => 'textarea'
				),
				array(
					'name' => 'Announcement - Buton URL',
					'id' => $prefix . 'hpann_buttonurl',
					'type' => 'text'
				),
				array(
					'name' => 'Announcement - Button Text',
					'id' => $prefix . 'hpann_buttontext',
					'type' => 'text'
				),
				array(
					'name' => 'Announcement - Image',
					'id' => $prefix . 'hpann_image',
					'type' => 'image_advanced',
					'max_file_uploads' => 1
				),
			)
		);

		return $meta_boxes;

	}
