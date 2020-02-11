<section class="cards-section">
    <h2 class="cards-section__heading">Join Us</h2>
    <div class="grid grid--four-columns">
        <div class="grid__1">
            <div class="base-card base-card--spacious base-card--teal">
                <div class="base-card__content">
                    <h2 class="base-card__title"><?php echo get_theme_mod( 'tsg_funder_count', TSG_DEFAULTS['funder_count'] ); ?></h2>
                    <p class="base-card__text">Funders</p>
                </div>
            </div>
        </div>
        <div class="grid__1">
            <div class="base-card base-card--spacious base-card--teal">
                <div class="base-card__content">
                    <h2 class="base-card__title"><?php echo get_theme_mod( 'tsg_recipient_count', TSG_DEFAULTS['recipient_count'] ); ?></h2>
                    <p class="base-card__text">Recipients</p>
                </div>
            </div>
        </div>
        <div class="grid__1">
            <div class="base-card base-card--spacious base-card--teal">
                <div class="base-card__content">
                    <h2 class="base-card__title"><?php echo get_theme_mod( 'tsg_grant_count', TSG_DEFAULTS['grant_count'] ); ?></h2>
                    <p class="base-card__text">Grants</p>
                </div>
            </div>
        </div>
        <div class="grid__1">
            <div class="base-card base-card--spacious base-card--teal">
                <div class="base-card__content">
                    <h2 class="base-card__title"><small>£</small><?php echo get_theme_mod( 'tsg_grant_amount', TSG_DEFAULTS['grant_amount'] ); ?></h2>
                    <p class="base-card__text">of Grant Data</p>
                </div>
            </div>
        </div>
        <div class="grid__all align-center">
            <a href="#" class="button button--teal">Explore the data</a>
        </div>
    </div>
</section>