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
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( PARTIAL . 'article-search' ); ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_pagenavi(); ?>
		</div>
	</div>

<?php get_footer(); ?>