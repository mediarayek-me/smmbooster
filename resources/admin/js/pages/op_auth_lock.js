/*
 *  Document   : op_auth_lock.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Lock Page
 */

class pageAuthLock {
    /*
     * Init Lock Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
     *
     */
    static initValidation() {
        // Load default options for jQuery Validation plugin
        Dashmix.helpers('validation');

        // Init Form Validation
        jQuery('.js-validation-lock').validate({
            rules: {
                'lock-password': {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                'lock-password': {
                    required: 'Please enter your valid password'
                }
            }
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initValidation();
    }
}

// Initialize when page loads
jQuery(() => { pageAuthLock.init(); });