<?php

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', array( New GalleryOverride(), 'render'));

Class GalleryOverride
{

	private $defaults = array(
		'type'       => 'grid',
		'showdotnav' => true,
		'order'      => 'ASC',
		'size' 		 => 'thumbnail',
		'link' 		 => 'attachment',
		'orderny'    => 'menu_order ID'
	);

	private $settings;

	private $post;

	private $attachments;

	public function render($attributes)
	{


		$this->post = get_post();
		$this->settings = array_merge($this->defaults, $attributes);

		if (!empty($this->settings['ids'])) {
			$this->attachments = get_posts(array(
					'include'        => $this->settings['ids'],
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $this->settings['order'],
					'orderby'        => 'post__in'// $this->settings['orderny']
					)
			);
		} // otherwise get the images attached to the post
		else {
			$this->attachments = get_posts(array(
					'post_parent'    => $this->post ? $this->post->ID : 0,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $this->settings['order'],
					'orderby'        => $this->settings['orderby'])
			);
		}


		// If no images were found...
		if (empty($this->attachments)) {
			return;
		}

		return $this->renderGrid();
	}



	/**
	 * Renders the gallery like a grid with lightbox
	 */
	private function renderGrid()
	{

		$output = array();

		$output[] = '<div class="uk-grid grid-gallery uk-grid-width-1-4" data-uk-grid-match="{target: \'.gallery-item-inner\', row: false}">';

		foreach ($this->attachments as $attachment) {

			$small = $this->getImageByAttachment($attachment, $this->settings['size']);
			$big = $this->getImageByAttachment($attachment);

			$output[] = '<div class="gallery-item">';
			$output[] = '<div class="gallery-item-inner">';
			if ( $this->settings['link'] != 'none' ) {
				$output[] = '<a class="uk-inline" href="' . $big[0] . '" data-fancybox="gallery" title="' . $attachment->post_excerpt . '">';
			}
			$output[] = '<img src=' . $small[0] . ' width="' . $small[1] . '" height="' . $small[2] . '" alt="" />';
			if ( $this->settings['link'] != 'none' ) {
				$output[] = '</a>';
			}

			if ( $attachment->post_excerpt ) {
				$output[] = '<div class="caption">';
				$output[] = $attachment->post_excerpt;
				$output[] = '</div>';
			}

			$output[] = '</div>';
			$output[] = '</div>';
		}

		$output[] = '</div>';

		return implode(" ", $output);
	}


	private function getImageByAttachment($attachment, $size = 'large')
	{
		return $this->getImageByAttachmentID($attachment->ID, $size);
	}

	private function getImageByAttachmentID($id, $size = 'large')
	{
		return wp_get_attachment_image_src($id, $size);
	}

	private function getImageCaption($id, $size = 'large')
	{
		return get_post($id);
	}

}