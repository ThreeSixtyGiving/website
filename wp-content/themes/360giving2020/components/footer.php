<?php 
$tc_menu_name = 'footer-menu-terms';
$tc_menu_items = array();
if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $tc_menu_name ] ) ) {
    $tc_menu = wp_get_nav_menu_object( $locations[ $tc_menu_name ] );
    $tc_menu_items = wp_get_nav_menu_items($tc_menu->term_id);
}
?>
<footer class="layout__footer">
    <?php get_template_part('components/subscribe'); ?>
    <footer class="footer">
        <div class="footer__row wrapper">
            <div class="footer__column-2 footer__branding">
                <div class="footer__logo"><a href='<?php echo get_home_url(); ?>'><img src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/360-giving-logo-white.svg" alt="360Giving"></a></div>
                <p class="footer__tagline"><?php echo get_theme_mod( 'tsg_footer_tagline', TSG_DEFAULTS['footer_tagline'] ); ?></p>
            </div>
            <div class="footer__column-1 footer__social hide-print">
                <a href="https://github.com/threesixtygiving/" class="github-icon"><img src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/github-logo.svg" alt="Check our Github"></a>
                <a href="https://twitter.com/360Giving/" class="twitter-icon"><img src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/twitter-logo.svg" alt="Follow us on Twitter"></a>
            </div>
        </div>

        <div class="footer__row wrapper hide-print">
            <div class="footer__column-1 footer__section medium-up">
                <h3 class="footer__heading"><?php echo wp_get_nav_menu_name( 'footer-menu-1' ); ?></h3>
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu-1',
                            'menu' => 'footer-menu-1',
                            'container' => '',
                            'menu_class' => '',
                        )
                    );
                ?>
            </div>

            <div class="footer__column-1 footer__section medium-up">
                <h3 class="footer__heading"><?php echo wp_get_nav_menu_name( 'footer-menu-2' ); ?></h3>
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu-2',
                            'menu' => 'footer-menu-2',
                            'container' => '',
                            'menu_class' => '',
                        )
                    );
                ?>
            </div>

            <?php get_sidebar('footer'); ?>

        </div>

        <div class="wrapper footer__small-print">
            <p>
                <strong>360 Giving</strong> (Trading as <strong>360Giving</strong>) is a registered charity <a href="https://register-of-charities.charitycommission.gov.uk/charity-details/?regId=1164883&amp;subId=0">1164883</a> and a registered company <a href="https://beta.companieshouse.gov.uk/company/09668396">09668396</a>.
                <br>Registered address: 360Giving, c/o Esmée Fairbairn Foundation, Kings Place, 90 York Way, London N1 9AG.
            </p>
        </div>

        <div class="footer__row wrapper footer__small-print">

            <div class="footer__column-2">
                <p>
                    © Copyright <?php echo date("Y"); ?> 360Giving.
                    <br>Licensed under a <a href="https://creativecommons.org/licenses/by/4.0/" rel="noreferrer">Creative Commons Attribution 4.0 International License</a>.
                </p>
            </div>
            <div class="footer__column-2 footer__policy-links hide-print">
                <p>
                    <?php foreach ( (array) $tc_menu_items as $key => $menu_item ): ?>
                    <?php if($key > 0): ?> | <?php endif; ?>
                    <a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>
    </footer>
    
</footer>