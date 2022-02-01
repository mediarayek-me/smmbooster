/*
 *  Document   : be_comp_rating.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Rating Page
 */

// jQuery Raty, for more examples you can check out https://github.com/wbotelhos/raty
class pageCompRating {
    /*
     * Init demo rating functionality
     *
     */
    static initRating() {
        // Init Raty on .js-rating class
        jQuery('.js-rating').each((index, element) => {
            let el = jQuery(element);

            el.raty({
                score: el.data('score') || 0,
                number: el.data('number') || 5,
                cancel: el.data('cancel') || false,
                target: el.data('target') || false,
                targetScore: el.data('target-score') || false,
                precision: el.data('precision') || false,
                cancelOff: el.data('cancel-off') || 'fa fa-fw fa-times-circle text-danger',
                cancelOn: el.data('cancel-on') || 'fa fa-fw fa-times-circle',
                starHalf: el.data('star-half') || 'fa fa-fw fa-star-half text-warning',
                starOff: el.data('star-off') || 'fa fa-fw fa-star text-muted',
                starOn: el.data('star-on') || 'fa fa-fw fa-star text-warning',
                starType: 'i',
                hints: ['Just Bad!', 'Almost There!', 'It’s ok!', 'That’s nice!', 'Incredible!'],
                click: function(score, evt) {
                    // Here you could add your logic on rating click
                    // console.log('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
                }
            });
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initRating();
    }
}

// Initialize when page loads
jQuery(() => { pageCompRating.init(); });
