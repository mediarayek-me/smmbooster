/*
 *  Document   : be_comp_onboarding.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Onboarding Page
 */

// Onboarding Modal using Bootstrap Modal and Slick slider
class pageCompOnboarding {
    /*
     * Init example onboarding modal functionality
     *
     */
    static initOnboardingModal() {
        // Show Onboarding Modal by default
        jQuery('#modal-onboarding').modal('show');

        // Re-init Slick Slider every time the modal is shown
        jQuery('#modal-onboarding').on('shown.bs.modal', function(e) {
            // Remove enabled class added by the helper to prevent re-init
            jQuery('js-slider', '#modal-onboarding').removeClass('js-slider-enabled');

            // Re-init Slick Slider
            Dashmix.helpers('slick');
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initOnboardingModal();
    }
}

// Initialize when page loads
jQuery(() => { pageCompOnboarding.init(); });
