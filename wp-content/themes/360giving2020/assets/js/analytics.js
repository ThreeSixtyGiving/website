var _paq = window._paq = window._paq || [];
var siteID = 31;
/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
_paq.push(['requireCookieConsent']); // Don't use cookies unless we have consent
_paq.push(['setCookieDomain', '*.threesixtygiving.org']);
_paq.push(['setDomains', '*.threesixtygiving.org']);
_paq.push(['setDownloadExtensions', "json|csv|xlsx"]);
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function () {
    var u = "https://analytics.threesixtygiving.org/";
    _paq.push(['setTrackerUrl', u + 'matomo.php']);
    if (!siteID) throw new Error("siteID not set");
    _paq.push(['setSiteId', siteID]);
    var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
    g.type = 'text/javascript'; g.async = true; g.src = u + 'matomo.js'; s.parentNode.insertBefore(g, s);
})();

function hideCookieConsentDialog(hide) {
    if (hide) {
        document.getElementsByClassName("cookie-consent")[0].style.display = 'none';
    } else {
        document.getElementsByClassName("cookie-consent")[0].style.display = 'block';
    }
}

function noCookieConsent() {
    document.cookie = "noEnhancedAnalytics=1; domain=threesixtygiving.org";
}

function addGoogleAnalytics() {
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
            m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-158107262-1', 'auto');
    ga('send', 'pageview');
}

if (document.cookie.indexOf("mtm_cookie_consent") > -1) {
    addGoogleAnalytics();
}

document.addEventListener('DOMContentLoaded', function () {
    if (document.cookie.indexOf("mtm_cookie_consent") > -1 ||
        document.cookie.indexOf("mtm_consent_removed") > -1 ||
        document.cookie.indexOf("noEnhancedAnalytics") > -1) {
        hideCookieConsentDialog(true);
    } else {
        hideCookieConsentDialog(false);
    }
});