/*
 *  Document   : be_comp_image_cropper.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Image Cropper Page
 */

// Image Cropper, for more examples you can check out https://fengyuanchen.github.io/cropperjs/
class pageCompImageCropper {
    /*
     * Init image cropper demo functionality
     *
     */
    static initImageCropper() {
        // Get Image Container
        let image = document.getElementById('js-img-cropper');

        // Set Options
        Cropper.setDefaults({
            aspectRatio: 4 / 3,
            preview: '.js-img-cropper-preview'
        });

        // Init Image Cropper
        let cropper = new Cropper(image, {
            crop: function (e) {
                // e.detail contains all data required to crop the image server side
                // You will have to send it to your custom server side script and crop the image there
                // Since this event is fired each time you set the crop section, you could also use getData()
                // method on demand. Please check out https://fengyuanchen.github.io/cropperjs/ for more info
                // console.log(e.detail);
            }
        });

        // Mini Cropper API
        jQuery('[data-toggle="cropper"]').on('click', e => {
            let btn     = jQuery(e.currentTarget);
            let method  = btn.data('method') || false;
            let option  = btn.data('option') || false;

            // Method selection with object literals
            let cropperAPI = {
                zoom: () => {
                    cropper.zoom(option);
                },
                setDragMode: () => {
                    cropper.setDragMode(option);
                },
                rotate: () => {
                    cropper.rotate(option);
                },
                scaleX: () => {
                    cropper.scaleX(option);
                    btn.data('option', -(option));
                },
                scaleY: () => {
                    cropper.scaleY(option);
                    btn.data('option', -(option));
                },
                setAspectRatio: () => {
                    cropper.setAspectRatio(option);
                },
                crop: () => {
                    cropper.crop();
                },
                clear: () => {
                    cropper.clear();
                }
            };

            // If method exists, execute it
            if (cropperAPI[method]) {
                cropperAPI[method]();
            }
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initImageCropper();
    }
}

// Initialize when page loads
jQuery(() => { pageCompImageCropper.init(); });
