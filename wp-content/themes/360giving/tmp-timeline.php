<?php
/*
Template Name: Timeline Page
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
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="content-wrapper">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
			<?php endif; ?>

			<hr>

			<div class="timeline">
				<div class="row">
					<div class="col-timeline col-md-10">
						<?php foreach (timeline_meta_boxes($meta_boxes)[0]['fields'][1]['options'] as $year) : ?>
							<?php $args = array(
								'post_type' 		=> 'timeline',
								'posts_per_page' 	=> -1,
								'meta_query'=> array(
									array(
										'key' => '_loki_year',
										'compare' => '==',
										'value' => $year,
									)
								),
								'meta_key' => '_loki_month',
								'orderby' => 'meta_value',
								'order' => 'ASC'
							);
							$query = new WP_Query($args);
							if ( $query->have_posts() ) : ?>
								<div class="timeline-year" id="timeline-<?php echo $year; ?>">
									<h2 class="year-block"><span><?php echo $year; ?></span></h2>
									<?php while ( $query->have_posts() ) : $query->the_post(); ?>
										<div class="timeline-event timeline-event-<?php echo loki_meta('colour'); ?>">
											<h3 class="timeline-event-title"><?php the_title(); ?></h3>
											<div class="timeline-event-content">
												<?php the_content(); ?>
											</div>
										</div>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						<div class="vert"></div>
					</div>
					<div class="col-timeline-nav col-md-2">
						<ul class="timeline-nav">
							<?php foreach (timeline_meta_boxes($meta_boxes)[0]['fields'][1]['options'] as $year) : ?>
								<?php $args = array(
									'post_type' 		=> 'timeline',
									'posts_per_page' 	=> -1,
									'meta_query'=> array(
										array(
											'key' => '_loki_year',
											'compare' => '==',
											'value' => $year,
										)
									),
									'meta_key' => '_loki_month',
									'orderby' => 'meta_value',
									'order' => 'ASC'
								);
								$query = new WP_Query($args);
								if ( $query->have_posts() ) : ?>
									<li><a href="#timeline-<?php echo $year; ?>"><?php echo $year; ?></a></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>