<article class="article">
	<h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<p class="article-excerpt"><?php echo excerpt(150); ?></p>
	<a href="<?php the_permalink(); ?>" class="btn btn-secondary">Continue Reading</a>
</article>