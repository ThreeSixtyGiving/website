<section class="cards-section">
    <h2 class="cards-section__heading">Our community</h2>
    <div class="grid grid--three-columns">
        <div class="grid__1">
            <div class="base-card base-card--spacious base-card--teal">
                <div class="base-card__content">
                    <p class="base-card__title"><?php echo tsg_number_format(get_theme_mod( 'tsg_funder_count', TSG_DEFAULTS['funder_count'] )); ?></p>
                    <p class="base-card__text"><a href="https://grantnav.threesixtygiving.org/">Funders</a></p>
                </div>
            </div>
        </div>
        <div class="grid__1">
            <div class="base-card base-card--spacious base-card--teal">
                <div class="base-card__content">
                    <p class="base-card__title"><?php echo tsg_number_format(round(get_theme_mod( 'tsg_grant_count', TSG_DEFAULTS['grant_count'] ), -3)); ?></p>
                    <p class="base-card__text"><a href="https://grantnav.threesixtygiving.org/">Grants</a></p>
                </div>
            </div>
        </div>
        <div class="grid__1">
            <div class="base-card base-card--spacious base-card--teal">
                <div class="base-card__content">
                    <p class="base-card__title"><small>£</small><?php echo tsg_number_format( get_theme_mod( 'tsg_grant_amount', TSG_DEFAULTS['grant_amount'] )); ?></p>
                    <p class="base-card__text"><a href="https://grantnav.threesixtygiving.org/">of Grants Data</a></p>
                </div>
            </div>
        </div>
    </div>
</section>