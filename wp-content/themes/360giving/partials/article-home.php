<article class="article">
	<div class="article-image">
		<a href="<?php the_permalink(); ?>">
			<?php if ( ! has_post_thumbnail()) : ?>
				<img src="<?php echo ASSET . 'img/placeholder-post.png'; ?>" alt="<?php the_title(); ?>">
			<?php else : ?>
				<?php the_post_thumbnail( 'post', array( 'alt' => get_the_title() ) ); ?>
			<?php endif; ?>
		</a>
	</div>
	<p class="article-date"><i class="fa fa-clock-o"></i><?php the_time( get_option('date_format') ); ?></p>
	<h4 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	<p class="article-excerpt"><?php echo excerpt(20); ?></p>
	<a class="article-read-more" href="<?php the_permalink(); ?>">Read Full Article</a>
</article>