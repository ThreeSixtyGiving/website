<?php get_header(); ?>

	<?php
		$banner_image = false;
		get_template_part( PARTIAL . 'internal-banner' );
	?>

	<div class="page-content">
		<div class="container">
			<div class="page-header">
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
					<?php if(function_exists('bcn_display')) {
						bcn_display();
					} ?>
				</div>
				<h1><?php echo loki_title(); ?></h1>
			</div>
			<div class="row">
				<div class="col-sm-8 col-md-9">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( PARTIAL . 'article-default' ); ?>
						<?php endwhile; ?>
					<?php endif; ?>
					<div class="clearfix"></div>
					<?php wp_pagenavi(); ?>
				</div>
				<div class="col-sm-4 col-md-3">
					<?php get_sidebar('blog'); ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>