<?php get_header(); ?>

	<?php get_template_part( PARTIAL . 'internal-banner' ); ?>

	<div class="page-content">
		<div class="container">
			<div class="page-header">
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
					<?php if(function_exists('bcn_display')) {
						bcn_display();
					}?>
				</div>
				<h1><?php the_title(); ?></h1>
			</div>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="content-wrapper">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>