<?php
/*
Template Name: Home Page
*/
get_header(); ?>

	<?php $banners = new WP_Query(array( 'post_type' => 'banner', 'posts_per_page' => '-1', 'orderby' => 'menu_order', 'order' => 'ASC' )); ?>
	<?php if ( $banners->have_posts() ) :  ?>
		<div class="header-banner">
			<ul class="slider">
				<?php while ( $banners->have_posts() ) : $banners->the_post(); ?>
					<li class="slide uk-background-cover">
						<div class="container">
							<div class="header-banner-content row">
								<div class="row-sm-height">
									<div class="col-sm-9 col-sm-height">
										<h4><?php the_title(); ?></h4>
										<?php if (loki_meta('excerpt')) : ?>
											<p><?php echo loki_meta('excerpt'); ?></p>
										<?php endif; ?>
										<div class="actions">
											<a class="btn btn-large" href="<?php echo loki_meta('button_url'); ?>"><?php echo loki_meta('button_text'); ?></a>
										</div>
									</div>
									<div class="col-sm-3 col-sm-height hidden-xs">
										<img class="orb" src="<?php echo ASSET . 'img/orb.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="207" height="240">
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="front-page-cta">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 cta">
						<div class="cta-inner">
							<div class="cta-text">
								<h3><?php echo loki_meta('hpcta_1_title'); ?></h3>
								<p><?php echo loki_meta('hpcta_1_text'); ?></p>
								<a href="<?php echo loki_meta('hpcta_1_url'); ?>">Learn More <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
						<a class="uk-position-cover" href="<?php echo loki_meta('hpcta_1_url'); ?>"></a>
					</div>
					<div class="col-sm-4 cta">
						<div class="cta-inner">
							<div class="cta-text">
								<h3><?php echo loki_meta('hpcta_2_title'); ?></h3>
								<p><?php echo loki_meta('hpcta_2_text'); ?></p>
								<a href="<?php echo loki_meta('hpcta_2_url'); ?>">Learn More <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
						<a class="uk-position-cover" href="<?php echo loki_meta('hpcta_2_url'); ?>"></a>
					</div>
					<div class="col-sm-4 cta">
						<div class="cta-inner">
							<div class="cta-text">
								<h3><?php echo loki_meta('hpcta_3_title'); ?></h3>
								<p><?php echo loki_meta('hpcta_3_text'); ?></p>
								<a href="<?php echo loki_meta('hpcta_3_url'); ?>">Learn More <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
						<a class="uk-position-cover" href="<?php echo loki_meta('hpcta_3_url'); ?>"></a>
					</div>
				</div>
			</div>
		</div>
		<div class="front-page-community">
			<div class="container">
				<div class="row">
					<div class="row-sm-height">
						<div class="col-sm-8 col-md-9 col-sm-height">
							<h3>Our Community is growing all the time. It currently includes:</h3>
						</div>
						<div class="col-sm-4 col-md-3 text-right col-sm-height">
							<a href="http://www.threesixtygiving.org/support/publish-data/" class="btn btn-primary">Join us</a>
						</div>
					</div>
				</div>
				<div class="stats">
					<span class="stat">
						<span class="count" id="stat-1"><?php echo loki_meta('hpstat_1'); ?></span>
						<span class="text">funders</span>
					</span>
					<span class="stat">
						<span class="count" id="stat-2"><?php echo loki_meta('hpstat_2'); ?></span>
						<span class="sub">k</span>
						<span class="text">recipients</span>
					</span>
					<span class="stat">
						<span class="count" id="stat-3"><?php echo loki_meta('hpstat_3'); ?></span>
						<span class="sub">k</span>
						<span class="text">grants</span>
					</span>
					<span class="stat">
						<span class="sup">£</span>
						<span class="count" id="stat-4"><?php echo loki_meta('hpstat_4'); ?></span>
						<span class="sub">b</span>
						<span class="text">of grant data</span>
					</span>
				</div>
			</div>
		</div>
		<div class="front-page-whats-new">
			<div class="container">
				<h2>What's New?</h2>
				<div class="front-page-announcement">
					<div class="row">
						<div class="row-sm-height">
							<div class="col-sm-6 col-sm-height">
								<h3><?php echo loki_meta('hpann_title'); ?></h3>
								<p><?php echo loki_meta('hpann_text'); ?></p>
								<a href="<?php echo loki_meta('hpann_buttonurl'); ?>" class="btn btn-large"><?php echo loki_meta('hpann_buttontext'); ?></a>
							</div>
							<div class="col-sm-6 col-sm-height text-right">
								<img src="<?php echo get_meta_image_url( get_the_ID(), 'hpann_image', 'full', 'url' ); ?>" alt="<?php echo loki_meta('hpann_title'); ?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="front-page-news">
					<?php $args = array(
						'post_type' 		=> 'post',
						'posts_per_page' 	=> 3,
					);
					$query = new WP_Query($args);
					if ( $query->have_posts() ) : ?>
						<div class="row">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-sm-4">
									<?php get_template_part( PARTIAL . 'article-home' ); ?>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="front-page-content">
			<div class="container">
				<div class="row">
					<div class="row-sm-height">
						<div class="col-sm-6 col-sm-height">
							<div class="content-wrapper">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>
	<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
