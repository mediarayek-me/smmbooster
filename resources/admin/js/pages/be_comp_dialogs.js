/*
 *  Document   : be_comp_dialogs.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Dialogs Page
 */

// SweetAlert2, for more examples you can check out https://github.com/sweetalert2/sweetalert2
class pageDialogs {
    /*
     * SweetAlert2 demo functionality
     *
     */
    static sweetAlert2() {
        // Set default properties
        let toast = Swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-success m-1',
                cancelButton: 'btn btn-danger m-1',
                input: 'form-control'
            }
        });

        // Init a simple dialog on button click
        jQuery('.js-swal-simple').on('click', e => {
            toast.fire('Hi, this is just a simple message!');
        });

        // Init an success dialog on button click
        jQuery('.js-swal-success').on('click', e => {
            toast.fire('Success', 'Everything was updated perfectly!', 'success');
        });

        // Init an info dialog on button click
        jQuery('.js-swal-info').on('click', e => {
            toast.fire('Info', 'Just an informational message!', 'info');
        });

        // Init an warning dialog on button click
        jQuery('.js-swal-warning').on('click', e => {
            toast.fire('Warning', 'Something needs your attention!', 'warning');
        });

        // Init an error dialog on button click
        jQuery('.js-swal-error').on('click', e => {
            toast.fire('Oops...', 'Something went wrong!', 'error');
        });

        // Init an question dialog on button click
        jQuery('.js-swal-question').on('click', e => {
            toast.fire('Question', 'Are you sure about that?', 'question');
        });

        // Init an example confirm dialog on button click
        jQuery('.js-swal-confirm').on('click', e => {
            toast.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButton: 'btn btn-danger m-1',
                    cancelButton: 'btn btn-secondary m-1'
                },
                confirmButtonText: 'Yes, delete it!',
                html: false,
                preConfirm: e => {
                    return new Promise(resolve => {
                        setTimeout(() => {
                            resolve();
                        }, 50);
                    });
                }
            }).then(result => {
                if (result.value) {
                    toast.fire('Deleted!', 'Your imaginary file has been deleted.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    toast.fire('Cancelled', 'Your imaginary file is safe :)', 'error');
                }
            });
        });

        // Init an example confirm alert on button click
        jQuery('.js-swal-custom-position').on('click', e => {
            toast.fire({
                position: 'top-end',
                title: 'Perfect!',
                text: 'Nice Position!',
                icon: 'success'
            });
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.sweetAlert2();
    }
}

// Initialize when page loads
jQuery(() => { pageDialogs.init(); });
