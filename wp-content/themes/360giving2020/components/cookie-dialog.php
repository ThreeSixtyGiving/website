<div role="dialog" aria-labelledby="cookie-dialog-title" aria-describedby="cookie-dialog-desc">
    <div class="base-card base-card--new cookie-consent">
        <div class="base-card__content">
            <h2 class="base-card__title" id="cookie-dialog-title">Allow analytics cookies? <br>
                <a class="base-card__text" href="https://www.threesixtygiving.org/privacy/"> More Information &amp;
                    Privacy Policy</a>
            </h2>
            <p class="base-card__text">
                <a href="#"
                    onclick="_paq.push(['rememberCookieConsentGiven']); hideCookieConsentDialog(true); addGoogleAnalytics();"
                    class="button">Yes</a>
                <a href="#" onclick="noCookieConsent(); hideCookieConsentDialog(true);" class="button">No</a>
                <a href="#" onclick="_paq.push(['optUserOut']); hideCookieConsentDialog(true);" class="button">Disable
                    Analytics</a>
            </p>
            <?php /* ?><p id="cookie-dialog-desc" style="font-style: italic;">360Giving uses privacy-respecting
                analytics. If you
                don't accept cookies, we will track only basic information about your visit. Click "Disable Analytics"
                if you don't want us to track at all. </p><?php */ ?>
            <p id="cookie-dialog-desc" style="font-style: italic;">360Giving uses analytics. If you
                don't accept cookies, we will track only basic information about your visit. Click "Disable Analytics"
                if you don't want us to track at all. </p>
        </div>
    </div>
</div>