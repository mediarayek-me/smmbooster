/*
 *  Document   : be_ui_progress.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Progress Page
 */

class pageProgress {
    /*
     * Bars randomize functionality
     *
     */
    static barsRandomize() {
        jQuery('.js-bar-randomize').on('click', e => {
            jQuery(e.currentTarget)
                .parents('.block')
                .find('.progress-bar')
                .each((index, element) => {
                    let el      = jQuery(element);
                    let random  = Math.floor((Math.random() * 91) + 10);

                    // Update progress width
                    el.css('width', random  + '%');

                    // Update progress label
                    jQuery('span', el).html(random  + '%');
                });
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.barsRandomize();
    }
}

// Initialize when page loads
jQuery(() => { pageProgress.init(); });
