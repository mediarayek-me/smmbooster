/*
 *  Document   : be_forms_wizard.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Forms Wizard Page
 */

// Form Wizard, for more examples you can check out https://github.com/VinceG/twitter-bootstrap-wizard
class pageFormsWizard {
    /*
     * Init Wizard Defaults
     *
     */
    static initWizardDefaults() {
        jQuery.fn.bootstrapWizard.defaults.tabClass         = 'nav nav-tabs';
        jQuery.fn.bootstrapWizard.defaults.nextSelector     = '[data-wizard="next"]';
        jQuery.fn.bootstrapWizard.defaults.previousSelector = '[data-wizard="prev"]';
        jQuery.fn.bootstrapWizard.defaults.firstSelector    = '[data-wizard="first"]';
        jQuery.fn.bootstrapWizard.defaults.lastSelector     = '[data-wizard="lsat"]';
        jQuery.fn.bootstrapWizard.defaults.finishSelector   = '[data-wizard="finish"]';
        jQuery.fn.bootstrapWizard.defaults.backSelector     = '[data-wizard="back"]';
    }

    /*
     * Init Simple Wizard functionality
     *
     */
    static initWizardSimple() {
        jQuery('.js-wizard-simple').bootstrapWizard({
            onTabShow: (tab, nav, index) => {
                let percent = ((index + 1) / nav.find('li').length) * 100;

                // Get progress bar
                let progress = nav.parents('.block').find('[data-wizard="progress"] > .progress-bar');

                // Update progress bar if there is one
                if (progress.length) {
                    progress.css({ width: percent + 1 + '%' });
                }
            }
        });
    }

    /*
     * Init Validation Wizard functionality
     *
     */
    static initWizardValidation() {
        // Load default options for jQuery Validation plugin
        Dashmix.helpers('validation');

        // Get forms
        let formValidation  = jQuery('.js-wizard-validation-form');
        let formValidation2 = jQuery('.js-wizard-validation2-form');

        // Prevent forms from submitting on enter key press
        formValidation.add(formValidation2).on('keyup keypress', e => {
            let code = e.keyCode || e.which;

            if (code === 13) {
                if (e.target.tagName.toLowerCase() !== 'textarea') {
                    e.preventDefault();
                    return false;
                }
            }
        });

        // Init form validation on validation wizard form
        let validator = formValidation.validate({
            rules: {
                'wizard-validation-firstname': {
                    required: true,
                    minlength: 2
                },
                'wizard-validation-lastname': {
                    required: true,
                    minlength: 2
                },
                'wizard-validation-email': {
                    required: true,
                    email: true
                },
                'wizard-validation-bio': {
                    required: true,
                    minlength: 5
                },
                'wizard-validation-location': {
                    required: true
                },
                'wizard-validation-skills': {
                    required: true
                },
                'wizard-validation-terms': {
                    required: true
                }
            },
            messages: {
                'wizard-validation-firstname': {
                    required: 'Please enter a firstname',
                    minlength: 'Your firtname must consist of at least 2 characters'
                },
                'wizard-validation-lastname': {
                    required: 'Please enter a lastname',
                    minlength: 'Your lastname must consist of at least 2 characters'
                },
                'wizard-validation-email': 'Please enter a valid email address',
                'wizard-validation-bio': 'Let us know a few thing about yourself',
                'wizard-validation-skills': 'Please select a skill!',
                'wizard-validation-terms': 'You must agree to the service terms!'
            }
        });

        // Init form validation on validation 2 wizard form
        let validator2 = formValidation2.validate({
            rules: {
                'wizard-validation2-firstname': {
                    required: true,
                    minlength: 2
                },
                'wizard-validation2-lastname': {
                    required: true,
                    minlength: 2
                },
                'wizard-validation2-email': {
                    required: true,
                    email: true
                },
                'wizard-validation2-bio': {
                    required: true,
                    minlength: 5
                },
                'wizard-validation2-location': {
                    required: true
                },
                'wizard-validation2-skills': {
                    required: true
                },
                'wizard-validation2-terms': {
                    required: true
                }
            },
            messages: {
                'wizard-validation2-firstname': {
                    required: 'Please enter a firstname',
                    minlength: 'Your firtname must consist of at least 2 characters'
                },
                'wizard-validation2-lastname': {
                    required: 'Please enter a lastname',
                    minlength: 'Your lastname must consist of at least 2 characters'
                },
                'wizard-validation2-email': 'Please enter a valid email address',
                'wizard-validation2-bio': 'Let us know a few thing about yourself',
                'wizard-validation2-skills': 'Please select a skill!',
                'wizard-validation2-terms': 'You must agree to the service terms!'
            }
        });

        // Init wizard with validation
        jQuery('.js-wizard-validation').bootstrapWizard({
            tabClass: '',
            onTabShow: (tab, nav, index) => {
                let percent = ((index + 1) / nav.find('li').length) * 100;

                // Get progress bar
                let progress = nav.parents('.block').find('[data-wizard="progress"] > .progress-bar');

                // Update progress bar if there is one
                if (progress.length) {
                    progress.css({ width: percent + 1 + '%' });
                }
            },
            onNext: (tab, nav, index) => {
                if( !formValidation.valid() ) {
                    validator.focusInvalid();

                    return false;
                }
            },
            onTabClick: (tab, nav, index) => {
                jQuery('a', nav).trigger('blur');

		        return false;
            }
        });

        // Init wizard with validation 2
        jQuery('.js-wizard-validation2').bootstrapWizard({
            tabClass: '',
            onTabShow: (tab, nav, index) => {
                let percent = ((index + 1) / nav.find('li').length) * 100;

                // Get progress bar
                let progress = nav.parents('.block').find('[data-wizard="progress"] > .progress-bar');

                // Update progress bar if there is one
                if (progress.length) {
                    progress.css({ width: percent + 1 + '%' });
                }
            },
            onNext: (tab, nav, index) => {
                if( !formValidation2.valid() ) {
                    validator2.focusInvalid();

                    return false;
                }
            },
            onTabClick: (tab, nav, index) => {
                jQuery('a', nav).trigger('blur');

		        return false;
            }
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initWizardDefaults();
        this.initWizardSimple();
        this.initWizardValidation();
    }
}

// Initialize when page loads
jQuery(() => { pageFormsWizard.init(); });
