<div class="subscribe-section">
    <div class="subscribe-section__wrapper">
        <form action="<?php echo get_theme_mod( 'tsg_mailchimp_url', TSG_DEFAULTS['mailchimp_url'] ); ?>" method="POST" class="subscribe-section__form">
            <input type="hidden" name="u" value="<?php echo get_theme_mod( 'tsg_mailchimp_u', TSG_DEFAULTS['mailchimp_u'] ); ?>">
            <input type="hidden" name="id" value="<?php echo get_theme_mod( 'tsg_mailchimp_id', TSG_DEFAULTS['mailchimp_id'] ); ?>">
            <input type="email" name="<?php echo get_theme_mod( 'tsg_mailchimp_email_field', TSG_DEFAULTS['mailchimp_email_field'] ); ?>" id="<?php echo get_theme_mod( 'tsg_mailchimp_email_field', TSG_DEFAULTS['mailchimp_email_field'] ); ?>" placeholder="Subscribe to our newsletter">
            <input type="submit" value="Submit">
        </form>
    </div>
</div>