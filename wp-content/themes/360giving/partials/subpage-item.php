<div class="uk-inline subpage-item uk-transition-toggle">

	<?php the_post_thumbnail( 'square', array( 'alt' => get_the_title() ) ); ?>

	<?php if ( ! has_post_thumbnail() ) : ?>
		<img src="<?php echo ASSET . 'img/placeholder.png'; ?>" alt="<?php the_title(); ?>" class="uk-transition-scale-up uk-transition-opaque">
	<?php endif; ?>

	<div class="uk-overlay-primary uk-position-cover"></div>
	<div class="uk-overlay-panel uk-position-middle uk-position-center uk-text-center">
		<div class="panel-inner">
			<h3><?php the_title(); ?></h3>
			<p class="hidden-xs"><?php echo excerpt(10); ?></p>
			<span class="btn btn-primary">Read More</span>
		</div>
	</div>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="uk-position-cover"></a>
</div>