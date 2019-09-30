<article class="article article-related">
	<a href="<?php the_permalink(); ?>">
		<?php if (has_post_thumbnail()) : ?>
			<?php the_post_thumbnail( 'square_small', array('class' => 'article-image hidden-xs hidden-sm') ); ?>
			<?php the_post_thumbnail( 'post', array('class' => 'article-image hidden-md hidden-lg') ); ?>
		<?php else : ?>
			<img class="article-image hidden-xs hidden-sm" src="<?php echo ASSET . 'img/placeholder.png'; ?>" alt="<?php the_title(); ?>">
			<img class="article-image hidden-md hidden-lg" src="<?php echo ASSET . 'img/placeholder-post.png'; ?>" alt="<?php the_title(); ?>">
		<?php endif; ?>
	</a>
	<h4 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	<p class="article-date"><i class="fa fa-clock-o"></i><?php the_time( get_option('date_format') ); ?></p>
</article>