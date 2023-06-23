<header class="layout__header">
    <div class="nav-bar">
        <a class="nav-bar__home-button" href="<?php echo get_home_url(); ?>">
            <img class="main-logo"
                src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/360-logos/360giving-main.svg"
                alt="360Giving Logo">
        </a>
        <div class="nav-bar__title">
            <h1 class="" style="font-weight: 400; margin: 0;">
                <?php if(empty($tsg_page_kicker)): ?>
                <?php echo get_the_title($top_level_post); ?>
                <?php else: ?>
                <?php echo $tsg_page_kicker; ?>
                <?php endif; ?>
            </h1>
            <?php if(!empty($tsg_page_blurb)): ?>
            <p class="">
                <?php echo $tsg_page_blurb; ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
</header>