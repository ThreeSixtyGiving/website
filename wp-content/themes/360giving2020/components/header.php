<header class="layout__header">
    <div class="hero-section">
        <div class="wrapper">
            <div class="hero hero--orange">
                <!-- .hero--orange, .hero--yellow, .hero--red -->
                <div class="hero__column hero__logo">
                    <a href="/">
                        <img src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/360-logos/360giving-main.svg" alt="360 Main">
                    </a>
                </div>
                <div class="hero__column hero__lead">
                    <h2 class="hero__title">
                        <?php bloginfo('description'); ?>
                    </h2>
                    <p class="hero__blurb">
                        <?php echo get_theme_mod( 'tsg_site_description', TSG_DEFAULTS['site_description'] ); ?>
                    </p>
                </div>  
            </div>
        </div>
    </div>
    <?php if(!is_front_page()): ?>
    <?php get_template_part('components/breadcrumbs'); ?>
    <?php endif; ?>
</header>