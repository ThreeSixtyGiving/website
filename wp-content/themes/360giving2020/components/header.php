<?php 
    $tsg_page_kicker = get_post_meta(get_the_ID(), 'tsg_page_kicker', true);
    $tsg_page_blurb  = get_post_meta(get_the_ID(), 'tsg_page_blurb',  true);
?>
<header class="layout__header">
    <div class="hero-section">
        <div class="wrapper">
            <div class="hero hero--orange">
                <!-- .hero--orange, .hero--yellow, .hero--red -->
                <div class="hero__column hero__logo">
                    <a href="<?php echo get_home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/360-logos/360giving-main.svg" alt="360 Main">
                    </a>
                </div>
                <div class="hero__column hero__lead">
                    <h2 class="hero__title">
                        <?php if(empty($tsg_page_kicker)): ?>
                        <?php bloginfo('description'); ?>
                        <?php else: ?>
                        <?php echo $tsg_page_kicker; ?>
                        <?php endif; ?>
                    </h2>
                    <p class="hero__blurb">
                        <?php if(empty($tsg_page_blurb)): ?>
                        <?php echo get_theme_mod( 'tsg_site_description', TSG_DEFAULTS['site_description'] ); ?>
                        <?php else: ?>
                        <?php echo $tsg_page_blurb; ?>
                        <?php endif; ?>
                    </p>
                </div>  
            </div>
        </div>
    </div>
    <?php if(!is_front_page()): ?>
    <?php get_template_part('components/breadcrumbs'); ?>
    <?php endif; ?>
</header>