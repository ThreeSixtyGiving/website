<article class="article article-featured">
	<div class="row">
		<div class="col-md-5">
			<a href="<?php the_permalink(); ?>">
				<?php if (has_post_thumbnail()) : ?>
					<?php the_post_thumbnail( 'square', array('class' => 'article-image hidden-xs hidden-sm') ); ?>
					<?php the_post_thumbnail( 'post', array('class' => 'article-image hidden-md hidden-lg') ); ?>
				<?php else : ?>
					<img class="article-image hidden-xs hidden-sm" src="<?php echo ASSET . 'img/placeholder.png'; ?>" alt="<?php the_title(); ?>">
					<img class="article-image hidden-md hidden-lg" src="<?php echo ASSET . 'img/placeholder-post.png'; ?>" alt="<?php the_title(); ?>">
				<?php endif; ?>
			</a>
		</div>
		<div class="col-md-7">
			<p class="article-date"><i class="fa fa-clock-o"></i><?php the_time( get_option('date_format') ); ?></p>
			<h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="article-author">By <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author_meta('nickname'); ?></a></p>
			<p class="article-excerpt"><?php echo excerpt(50); ?></p>
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read Full Story</a>
			<?php $post_categories = wp_get_post_categories(get_the_ID()); ?>
			<ul class="article-categories">
				<?php if (count($post_categories) == 1) : ?>
					<li><span>Category:</span></li>
				<?php elseif (count($post_categories) > 1) : ?>
					<li><span>Categories:</span></li>
				<?php endif; ?>
				<?php foreach($post_categories as $post_category) : ?>
					<?php $category = get_category($post_category); ?>
					<li><a href="<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</article>