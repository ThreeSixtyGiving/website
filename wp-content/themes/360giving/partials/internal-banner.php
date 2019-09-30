<?php 
	
	global $banner_image;

	if ( $banner_image !== false ) {
		$banner_image = has_post_thumbnail( get_the_ID() ) ? get_featured_image_url( get_the_ID(), 'banner') : ( has_post_thumbnail( $post->post_parent ) ? get_featured_image_url( $post->post_parent, 'banner') : false ); 
	}

	if ( $banner_image ) : ?>
		<div class="internal-banner">
			<div class="row">
				<div class="col-xs-12">
					<div class="page-head uk-inline uk-background-cover" style="background-image: url('<?php echo $banner_image; ?>');">
						<div class="image-container">
							<img src="<?php echo $banner_image; ?>" alt="<?php the_title(); ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>