<?php
/*
Template Name: News
*/
get_header(); ?>

	<?php get_template_part( PARTIAL . 'internal-banner' ); ?>

	<div class="page-content">
		<div class="container">
			<?php if (!$banner_image) : ?>
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
					<?php if(function_exists('bcn_display')) {
						bcn_display();
					} ?>
				</div>
				<div class="page-header">
					<h1><?php the_title(); ?></h1>
				</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-sm-8 col-md-9">
					<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
							'post_type' 	 => 'post',
							'posts_per_page' => 5,
							'paged'          => $paged
						);
						$query = new WP_Query($args);
					?>
					<?php if ( $query->have_posts() ) : ?>
						<?php $i = 0; ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php $i++; ?>
							<?php if ( $i == 1 ) : ?>
								<h2 class="news-heading">Latest News Story</h2>
								<?php get_template_part( PARTIAL . 'article-featured' ); ?>
								<h2 class="news-heading">Past News Stories</h2>
							<?php else : ?>
								<?php get_template_part( PARTIAL . 'article-default' ); ?>
							<?php endif; ?>
						<?php endwhile; ?>
						<?php wp_pagenavi(array( 'query' => $query)); ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-4 col-md-3">
					<?php get_sidebar('blog'); ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>