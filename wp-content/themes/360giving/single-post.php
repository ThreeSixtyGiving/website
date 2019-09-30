<?php get_header(); ?>

	<?php
	$banner_image = false;
	get_template_part( PARTIAL . 'internal-banner' ); ?>

	<div class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-9">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article class="uk-article">
							<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
									<?php if(function_exists('bcn_display')) {
										bcn_display();
									} ?>
								</div>
							<h1><?php echo the_title(); ?></h1>
							<p class="article-meta">
								<span class="article-author">Written by <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author_meta('nickname'); ?></a></span>
								<span class="article-date">on <?php the_time(get_option('date_format')); ?>.</span>
							</p>
							<div class="content-wrapper">
								<?php the_content(); ?>
							</div>
							<?php echo do_shortcode('[share]'); ?>
						</article>
					<?php endwhile; ?>
					<?php endif; ?>

					<?php

					// GET THE CATEGORIES
					$categories = wp_list_pluck( get_the_terms( get_the_ID(), 'category' ), 'slug' );

					$related_posts = loki_meta('related_articles');
					if (!empty($related_posts)) {
						$related = new WP_Query(
							array(
								'post_type' => 'post',
								'orderby' => 'rand',
								'posts_per_page' => '4',
								'post__in' => $related_posts
							)
						);
					} else {
						$related = new WP_Query(
							array(
								'post_type' => 'post',
								'orderby' => 'rand',
								'posts_per_page' => '4',
								'tax_query' => array(
									array(
										'taxonomy' => 'category',
										'field' => 'slug',
										'terms' => $categories
										)
									),
								'post__not_in' => array( get_the_ID())
							)
						);
					}
					?>
					<?php if (  $related->have_posts() ) : ?>
					<div class="related-posts">
						<h3>Related Articles</h3>
						<div class="row">
						<?php while ( $related->have_posts() ) : $related->the_post(); ?>
							<div class="col-md-3">
								<?php get_template_part( PARTIAL . 'article-small' ); ?>
							</div>
						<?php endwhile; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="col-sm-4 col-md-3">
					<?php get_sidebar('blog'); ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>