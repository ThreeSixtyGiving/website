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
				<h1>404 Page Not Found</h1>
			</div>
			<p>Sorry, that page could not be found. Please try again.</p>
		</div>
	</div>

<?php get_footer(); ?>