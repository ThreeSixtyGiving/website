<footer class="layout__footer">
    <div class="subscribe-section">
        <div class="subscribe-section__wrapper">
            <form action="#" class="subscribe-section__form">
                <input type="text" placeholder="Subscribe to our newsletter">
                <input type="submit" value="Send">
            </form>
        </div>
    </div>
    <footer class="footer">
        <div class="footer__row wrapper">
            <div class="footer__column-2 footer__branding">
                <div class="footer__logo"><img src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/360-giving-logo-white.svg" alt="360Giving"></div>
                <p class="footer__tagline">Open data for more effective grantmaking</p>
            </div>
            <div class="footer__column-1 footer__social">
                <a href="#" class="github-icon"><img src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/github-logo.svg" alt="Check our Github"></a>
                <a href="#" class="twitter-icon"><img src="<?php echo get_template_directory_uri() . '/assets'; ?>/images/twitter-logo.svg" alt="Follow us on Twitter"></a>
            </div>
        </div>

        <div class="footer__row wrapper">
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
            <p>© Copyright <?php echo date("Y"); ?> 360Giving, licensed under a <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank">Creative Commons Attribution 4.0 International License</a>.</p>
        </div>

        <div class="footer__row wrapper footer__small-print">

            <div class="footer__column-2">
                <p>360Giving: 
                    Company <a href="https://beta.companieshouse.gov.uk/company/09668396" target="_blank">09668396</a>
                    Charity <a href="http://beta.charitycommission.gov.uk/charity-details/?regid=1164883&subid=0" target="_blank">1164883</a>
                </p>
            </div>
            <div class="footer__column-2 footer__policy-links">
                <p>
                    <a href="https://www.threesixtygiving.org/privacy/">Privacy Notice</a> | 
                    <a href="https://www.threesixtygiving.org/terms-conditions/">Terms & Conditions</a> | 
                    <a href="https://www.threesixtygiving.org/cookie-policy/">Cookie Policy</a> | 
                    <a href="https://www.threesixtygiving.org/take-down-policy/">Take Down Policy</a> | 
                    <a href="https://creativecommons.org/licenses/by/4.0/">License</a>
                </p>
            </div>
        </div>
    </footer>
    
</footer>