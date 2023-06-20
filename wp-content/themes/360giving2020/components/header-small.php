<header class="layout__header">
    <div class="nav-bar">
        <a class="nav-bar__home-button" href="<?php echo get_home_url(); ?>">
            <img class="main-logo"
                src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/360-logos/360giving-main.svg"
                alt="360Giving Logo">
        </a>
        <h1 class="nav-bar__title">
			<?php if(empty($tsg_page_kicker)): ?>
			<?php echo get_the_title($top_level_post); ?>
			<?php else: ?>
			<?php echo $tsg_page_kicker; ?>
			<?php endif; ?>
        </h1>
    </div>
</header>
