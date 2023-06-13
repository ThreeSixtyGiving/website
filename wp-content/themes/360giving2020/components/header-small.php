<?php 
    $tsg_page_kicker = get_post_meta(get_the_ID(), 'tsg_page_kicker', true);
    $tsg_page_blurb  = get_post_meta(get_the_ID(), 'tsg_page_blurb',  true);
    if ( is_category() ){
        $tsg_page_kicker = single_cat_title( '', false );
        $tsg_page_blurb  = category_description();
    } elseif( is_home() ){
        $tsg_page_kicker = 'Ideas & updates';
        $tsg_page_blurb  = 'Our latest news, blogs and events where you can find out more about our work and stories of how open grants data is being used';
    }
?>
<header class="layout__header">
    <div class="nav-bar">
        <a class="nav-bar__home-button" href="<?php echo get_home_url(); ?>">
            <img class="main-logo"
                src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/360-logos/360giving-main.svg"
                alt="360Giving Logo">
        </a>
        <h1 class="nav-bar__title">
            <a class="" href="/">
                <?php if(empty($tsg_page_kicker)): ?>
                <?php echo get_the_title($top_level_post); ?>
                <?php else: ?>
                <?php echo $tsg_page_kicker; ?>
                <?php endif; ?>
            </a>
        </h1>
    </div>
</header>