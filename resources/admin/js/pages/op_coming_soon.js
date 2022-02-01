/*
 *  Document   : op_coming_soon.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Coming Soon Page
 */

class pageComingSoon {
    /*
     * Init Countdown.js, for more examples you can check out https://github.com/hilios/jQuery.countdown
     *
     */
    static countdown() {
        jQuery('.js-countdown').countdown((new Date().getFullYear() + 2) + '/02/01', e => {
            jQuery(e.currentTarget).html(e.strftime('<div class="row items-push push text-center">'
                    + '<div class="col-6 col-md-3"><div class="font-size-h1 font-w700 text-white">%-D</div><div class="font-size-sm font-w700 text-muted">DAYS</div></div>'
                    + '<div class="col-6 col-md-3"><div class="font-size-h1 font-w700 text-white">%H</div><div class="font-size-sm font-w700 text-muted">HOURS</div></div>'
                    + '<div class="col-6 col-md-3"><div class="font-size-h1 font-w700 text-white">%M</div><div class="font-size-sm font-w700 text-muted">MINUTES</div></div>'
                    + '<div class="col-6 col-md-3"><div class="font-size-h1 font-w700 text-white">%S</div><div class="font-size-sm font-w700 text-muted">SECONDS</div></div>'
                    + '</div>'
            ));
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.countdown();
    }
}

// Initialize when page loads
jQuery(() => { pageComingSoon.init(); });
