<?php
/*
Template Name: Sub Page Grid (1/3)
*/
get_header(); ?>

	<?php get_template_part( PARTIAL . 'internal-banner' ); ?>

	<div class="page-content">
		<div class="container">
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
				<?php if(function_exists('bcn_display')) {
					bcn_display();
				} ?>
			</div>
			<div class="page-header">
				<h1><?php the_title(); ?></h1>
			</div>
			<?php if ( ! empty($post->post_content) ) : ?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="content-wrapper">
						<?php the_content(); ?>
					</div>
				<?php endwhile; ?>
				<?php endif; ?>
				<hr>
			<?php endif; ?>
			<?php $subpages = new WP_Query(
				array(
					'post_type' => 'page',
					'post_parent' => get_the_ID(),
					'posts_per_page' => '-1',
					'orderby' => 'menu_order',
					'order' => 'ASC'
				)
			); ?>
			<?php if ( $subpages->have_posts() ) : ?>
			<div class="row">
				<?php while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
				<div class="col-sm-4">
					<?php get_template_part( PARTIAL . 'subpage-item' ); ?>
				</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>

<?php get_footer(); ?>