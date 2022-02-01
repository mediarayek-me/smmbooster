/*
 *  Document   : helpers.js
 *  Author     : mediarayek
 *  Description: Various jQuery plugins inits as well as custom helpers
 *
 */

// Import required modules
import Tools from './tools';

// Helper variables
let sparklineResize = false;
let sparklineTimeout;

// Helpers
export default class Helpers {
   /*
    * Run helpers
    *
    */
   static run(helpers, options = {}) {
       let helperList = {
           'core-bootstrap-tooltip': () => this.coreBootstrapTooltip(),
           'core-bootstrap-popover': () => this.coreBootstrapPopover(),
           'core-bootstrap-tabs': () => this.coreBootstrapTabs(),
           'core-bootstrap-custom-file-input': () => this.coreBootstrapCustomFileInput(),
           'core-toggle-class': () => this.coreToggleClass(),
           'core-scroll-to': () => this.coreScrollTo(),
           'core-year-copy': () => this.coreYearCopy(),
           'core-appear': () => this.coreAppear(),
           'core-ripple': () => this.coreRipple(),
           print: () => this.print(),
           'table-tools-sections': () => this.tableToolsSections(),
           'table-tools-checkable': () => this.tableToolsCheckable(),
           'magnific-popup': () => this.magnific(),
           summernote: () => this.summernote(),
           ckeditor: () => this.ckeditor(),
           ckeditor5: () => this.ckeditor5(),
           simplemde: () => this.simpleMDE(),
           slick: () => this.slick(),
           datepicker: () => this.datepicker(),
           colorpicker: () => this.colorpicker(),
           'masked-inputs': () => this.maskedInputs(),
           select2: () => this.select2(),
           highlightjs: () => this.highlightjs(),
           notify: (options) => this.notify(options),
           'easy-pie-chart': () => this.easyPieChart(),
           maxlength: () => this.maxlength(),
           rangeslider: () => this.rangeslider(),
           sparkline: () => this.sparkline(),
           validation: () => this.validation(),
           'pw-strength': () => this.pwstrength(),
           flatpickr: () => this.flatpickr()
       };

       if (helpers instanceof Array) {
           for (let index in helpers) {
               if (helperList[helpers[index]]) {
                   helperList[helpers[index]](options);
               }
           }
       } else {
           if (helperList[helpers]) {
               helperList[helpers](options);
           }
       }
   }

    /*
     ********************************************************************************************
     *
     * CORE HELPERS
     *
     * Third party plugin inits or various custom user interface helpers to extend functionality
     * They are called by default and can be used right away
     *
     *********************************************************************************************
     */

    /*
     * Bootstrap Tooltip, for more examples you can check out https://getbootstrap.com/docs/4.6/components/tooltips/
     *
     * Helpers.run('core-bootstrap-tooltip');
     *
     * Example usage:
     *
     * <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Tooltip Text">Example</button> or
     * <button type="button" class="btn btn-primary js-tooltip" title="Tooltip Text">Example</button>
     *
     */
    static coreBootstrapTooltip() {
        jQuery('[data-toggle="tooltip"]:not(.js-tooltip-enabled)').add('.js-tooltip:not(.js-tooltip-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-tooltip-enabled class to tag it as activated and init it
            el.addClass('js-tooltip-enabled').tooltip({
                container: el.data('container') || 'body',
                animation: el.data('animation') || false
            });
        });
    }

    /*
     * Bootstrap Popover, for more examples you can check out https://getbootstrap.com/docs/4.6/components/popovers/
     *
     * Helpers.run('core-bootstrap-popover');
     *
     * Example usage:
     *
     * <button type="button" class="btn btn-primary" data-toggle="popover" title="Popover Title" data-content="This is the content of the Popover">Example</button> or
     * <button type="button" class="btn btn-primary js-popover" title="Popover Title" data-content="This is the content of the Popover">Example</button>
     *
     */
    static coreBootstrapPopover() {
        jQuery('[data-toggle="popover"]:not(.js-popover-enabled)').add('.js-popover:not(.js-popover-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-popover-enabled class to tag it as activated and init it
            el.addClass('js-popover-enabled').popover({
                container: el.data('container') || 'body',
                animation: el.data('animation') || false,
                trigger: el.data('trigger') || 'hover focus'
            });
        });
    }

    /*
     * Bootstrap Tab, for examples you can check out https://getbootstrap.com/docs/4.6/components/navs/#tabs
     *
     * Helpers.run('core-bootstrap-tabs');
     *
     * Example usage:
     *
     * Please check out the Tabs page for complete markup examples
     *
     */
    static coreBootstrapTabs() {
        jQuery('[data-toggle="tabs"]:not(.js-tabs-enabled)').add('.js-tabs:not(.js-tabs-enabled)').each((index, element) => {
            // Add .js-tabs-enabled class to tag it as activated and init it
            jQuery(element).addClass('js-tabs-enabled').find('a').on('click.pixelcave.helpers.core', e => {
                e.preventDefault();
                jQuery(e.currentTarget).tab('show');
            });
        });
    }

    /*
     * Bootstrap Custom File Input Filename
     *
     * Helpers.run('core-bootstrap-custom-file-input');
     *
     * Example usage:
     *
     * Please check out the Tabs page for complete markup examples
     *
     */
    static coreBootstrapCustomFileInput() {
        // Populate custom Bootstrap file inputs with selected filename
        jQuery('[data-toggle="custom-file-input"]:not(.js-custom-file-input-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-custom-file-input-enabled class to tag it as activated
            el.addClass('js-custom-file-input-enabled').on('change', e => {
                let fileName = (e.target.files.length > 1) ? e.target.files.length + ' ' + (el.data('lang-files') || 'Files') : e.target.files[0].name;

                el.next('.custom-file-label').css('overflow-x', 'hidden').html(fileName);
            });
        });
    }

    /*
     * Toggle class on element click
     *
     * Helpers.run('core-toggle-class');
     *
     * Example usage (on button click, "exampleClass" class is toggled on the element with id "elementID"):
     *
     * <button type="button" class="btn btn-primary" data-toggle="class-toggle" data-target="#elementID" data-class="exampleClass">Toggle</button>
     *
     * or
     *
     * <button type="button" class="btn btn-primary js-class-toggle" data-target="#elementID" data-class="exampleClass">Toggle</button>
     *
     */
    static coreToggleClass() {
        jQuery('[data-toggle="class-toggle"]:not(.js-class-toggle-enabled)')
                .add('.js-class-toggle:not(.js-class-toggle-enabled)')
                .on('click.pixelcave.helpers.core', e => {
            let el = jQuery(e.currentTarget);

            // Add .js-class-toggle-enabled class to tag it as activated and then blur it
            el.addClass('js-class-toggle-enabled').trigger('blur');

            // Toggle class
            jQuery(el.data('target').toString()).toggleClass(el.data('class').toString());
        });
    }

    /*
     * Scroll to element with animation
     *
     * Helpers.run('core-scroll-to');
     *
     * Example usage (on click, the page will scroll to element with id "elementID" in "500" ms):
     *
     * <a href="#elementID" data-toggle="scroll-to" data-speed="500">Go</a> or
     * <button type="button" class="btn btn-primary" data-toggle="scroll-to" data-speed="500" data-target="#elementID">Go</button>
     *
     */
    static coreScrollTo() {
        jQuery('[data-toggle="scroll-to"]:not(.js-scroll-to-enabled)').on('click.pixelcave.helpers.core', e => {
            e.stopPropagation();

            // Set variables
            let lHeader         = jQuery('#page-header');
            let el              = jQuery(e.currentTarget);
            let elTarget        = el.data('target') || el.attr('href');
            let elSpeed         = el.data('speed') || 1000;
            let headerHeight    = (lHeader.length && jQuery('#page-container').hasClass('page-header-fixed')) ? lHeader.outerHeight() : 0;

            // Add .js-scroll-to-enabled class to tag it as activated
            el.addClass('js-scroll-to-enabled');

            // Scroll to element
            jQuery('html, body').animate({
                scrollTop: jQuery(elTarget).offset().top - headerHeight
            }, elSpeed);
        });
    }

    /*
     * Add the correct copyright year to an element
     *
     * Helpers.run('core-year-copy');
     *
     * Example usage (it will get populated with current year if empty or will append it to specified year if needed):
     *
     * <span data-toggle="year-copy"></span> or
     * <span data-toggle="year-copy"></span>
     *
     */
    static coreYearCopy() {
        let el = jQuery('[data-toggle="year-copy"]:not(.js-year-copy-enabled)');

        if (el.length > 0) {
            let date        = new Date();
            let curYear     = date.getFullYear();
            let baseYear    = (el.html().length > 0) ? el.html() : curYear;

            // Add .js-scroll-to-enabled class to tag it as activated and set the correct year
            el.addClass('js-year-copy-enabled').html(
                (parseInt(baseYear) >= curYear) ? curYear : baseYear + '-' + curYear.toString().substr(2, 2)
            );
        }
    }

    /*
     * jQuery Appear, for more examples you can check out https://github.com/bas2k/jquery.appear
     *
     * Helpers.run('core-appear');
     *
     * Example usage (the following div will appear on scrolling, remember to add the invisible class):
     *
     * <div class="invisible" data-toggle="appear">...</div>
     *
     */
    static coreAppear() {
        // Add a specific class on elements (when they become visible on scrolling)
        jQuery('[data-toggle="appear"]:not(.js-appear-enabled)').each((index, element) => {
            let windowW     = Tools.getWidth();
            let el          = jQuery(element);
            let elCssClass  = el.data('class') || 'animated fadeIn';
            let elOffset    = el.data('offset') || 0;
            let elTimeout   = (windowW < 992) ? 0 : (el.data('timeout') ? el.data('timeout') : 0);

            // Add .js-appear-enabled class to tag it as activated and init it
            el.addClass('js-appear-enabled').appear(() => {
                setTimeout(() => {
                    el.removeClass('invisible').addClass(elCssClass);
                }, elTimeout);
            }, {accY: elOffset});
        });
    }

    /*
     * Ripple effect fuctionality
     *
     * Helpers.run('core-ripple');
     *
     * Example usage:
     *
     * <button type="button" class="btn btn-primary" data-toggle="click-ripple">Click Me!</button>
     *
     */
    static coreRipple() {
        jQuery('[data-toggle="click-ripple"]:not(.js-click-ripple-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-click-ripple-enabled class to tag it as activated and init it
            el.addClass('js-click-ripple-enabled')
                .css({
                    overflow: 'hidden',
                    position: 'relative',
                    'z-index': 1
                }).on('click.pixelcave.helpers.core', e => {
                    let cssClass = 'click-ripple', ripple, d, x, y;

                    // If the ripple element doesn't exist in this element, add it..
                    if (el.children('.' + cssClass).length === 0) {
                        el.prepend('<span class="' + cssClass + '"></span>');
                    }
                    else { // ..else remove .animate class from ripple element
                        el.children('.' + cssClass).removeClass('animate');
                    }

                    // Get the ripple element
                    ripple = el.children('.' + cssClass);

                    // If the ripple element doesn't have dimensions, set them accordingly
                    if(!ripple.height() && !ripple.width()) {
                        d = Math.max(el.outerWidth(), el.outerHeight());
                        ripple.css({height: d, width: d});
                    }

                    // Get coordinates for our ripple element
                    x = e.pageX - el.offset().left - ripple.width()/2;
                    y = e.pageY - el.offset().top - ripple.height()/2;

                    // Position the ripple element and add the class .animate to it
                    ripple.css({top: y + 'px', left: x + 'px'}).addClass('animate');
                });
        });
    }

    /*
     ********************************************************************************************
     *
     * UI HELPERS (ON DEMAND)
     *
     * Third party plugin inits or various custom user interface helpers to extend functionality
     * They need to be called in a page to be initialized. They are included to be easy to
     * init them on demand on multiple pages (usually repeated init code in common components)
     *
     ********************************************************************************************
     */

     /*
      * Print Page functionality
      *
      * Helpers.run('print');
      *
      */
    static print() {
        // Store all #page-container classes
        let lPage = jQuery('#page-container');
        let pageCls = lPage.prop('class');

        // Remove all classes from #page-container
        lPage.prop('class', '');

        // Print the page
        window.print();

        // Restore all #page-container classes
        lPage.prop('class', pageCls);
    }

    /*
     * Table sections functionality
     *
     * Helpers.run('table-tools-sections');
     *
     * Example usage:
     *
     * Please check out the Table Helpers page for complete markup examples
     *
     */
    static tableToolsSections() {
        // For each table
        jQuery('.js-table-sections:not(.js-table-sections-enabled)').each((index, element) => {
            let table = jQuery(element);

            // Add .js-table-sections-enabled class to tag it as activated
            table.addClass('js-table-sections-enabled');

            // When a row is clicked in tbody.js-table-sections-header
            jQuery('.js-table-sections-header > tr', table).on('click.pixelcave.helpers', e => {
                if (e.target.type !== 'checkbox'
                        && e.target.type !== 'button'
                        && e.target.tagName.toLowerCase() !== 'a'
                        && !jQuery(e.target).parent('a').length
                        && !jQuery(e.target).parent('button').length
                        && !jQuery(e.target).parent('.custom-control').length
                        && !jQuery(e.target).parent('label').length) {
                    let row    = jQuery(e.currentTarget);
                    let tbody  = row.parent('tbody');

                    if (!tbody.hasClass('show')) {
                        jQuery('tbody', table).removeClass('show table-active');
                    }

                    tbody.toggleClass('show table-active');
                }
            });
        });
    }

    /*
     * Checkable table functionality
     *
     * Helpers.run('table-tools-checkable');
     *
     * Example usage:
     *
     * Please check out the Table Helpers page for complete markup examples
     *
     */
    static tableToolsCheckable() {
        // For each table
        jQuery('.js-table-checkable:not(.js-table-checkable-enabled)').each((index, element) => {
            let table = jQuery(element);

            // Add .js-table-checkable-enabled class to tag it as activated
            table.addClass('js-table-checkable-enabled');

            // When a checkbox is clicked in thead
            jQuery('thead input:checkbox', table).on('click.pixelcave.helpers', e => {
                let checkedStatus = jQuery(e.currentTarget).prop('checked');

                // Check or uncheck all checkboxes in tbody
                jQuery('tbody input:checkbox', table).each((index, element) => {
                    let checkbox = jQuery(element);

                    checkbox.prop('checked', checkedStatus).change();
                    this.tableToolscheckRow(checkbox, checkedStatus);
                });
            });

            // When a checkbox is clicked in tbody
            jQuery('tbody input:checkbox, tbody input + label', table).on('click.pixelcave.helpers', e => {
                let checkbox = jQuery(e.currentTarget);
                let checkedStatus  = checkbox.prop('checked');

                if (!checkedStatus) {
                    jQuery('thead input:checkbox', table).prop('checked', false);
                } else {
                    if (jQuery('tbody input:checkbox:checked', table).length === jQuery('tbody input:checkbox', table).length) {
                        jQuery('thead input:checkbox', table).prop('checked', true);
                    }
                }

                this.tableToolscheckRow(checkbox, checkbox.prop('checked'));
            });

            // When a row is clicked in tbody
            jQuery('tbody > tr', table).on('click.pixelcave.helpers', e => {
                if (e.target.type !== 'checkbox'
                        && e.target.type !== 'button'
                        && e.target.tagName.toLowerCase() !== 'a'
                        && !jQuery(e.target).parent('a').length
                        && !jQuery(e.target).parent('button').length
                        && !jQuery(e.target).parent('.custom-control').length
                        && !jQuery(e.target).parent('label').length) {
                    let checkbox       = jQuery('input:checkbox', e.currentTarget);
                    let checkedStatus  = checkbox.prop('checked');

                    checkbox.prop('checked', !checkedStatus).change();
                    this.tableToolscheckRow(checkbox, !checkedStatus);

                    if (checkedStatus) {
                        jQuery('thead input:checkbox', table).prop('checked', false);
                    } else {
                        if (jQuery('tbody input:checkbox:checked', table).length === jQuery('tbody input:checkbox', table).length) {
                            jQuery('thead input:checkbox', table).prop('checked', true);
                        }
                    }
                }
            });
        });
    }

    // Checkable table functionality helper - Checks or unchecks table row
    static tableToolscheckRow(checkbox, checkedStatus) {
        if (checkedStatus) {
            checkbox.closest('tr').addClass('table-active');
        } else {
            checkbox.closest('tr').removeClass('table-active');
        }
    }

    /*
     ********************************************************************************************
     *
     * All the following helpers require each plugin's resources (JS, CSS) to be included in order to work
     *
     ********************************************************************************************
     */

    /*
     * Magnific Popup functionality, for more examples you can check out http://dimsemenov.com/plugins/magnific-popup/
     *
     * Helpers.run('magnific-popup');
     *
     * Example usage:
     *
     * Please check out the Gallery page in Components for complete markup examples
     *
     */
    static magnific() {
        // Gallery init
        jQuery('.js-gallery:not(.js-gallery-enabled)').each((index, element) => {
            // Add .js-gallery-enabled class to tag it as activated and init it
            jQuery(element).addClass('js-gallery-enabled').magnificPopup({
                delegate: 'a.img-lightbox',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    }

    /*
     * Summernote init, for more examples you can check out https://summernote.org/
     *
     * Helpers.run('summernote');
     *
     * Example usage:
     *
     * <div class="js-summernote-air"><p>Hello inline Summernote!</p></div> or
     * <div class="js-summernote">Hello Summernote!</div>
     *
     *
     */
    static summernote() {
        // Init text editor in air mode (inline)
        jQuery('.js-summernote-air:not(.js-summernote-air-enabled)').each((index, element) => {
            // Add .js-summernote-air-enabled class to tag it as activated and init it
            jQuery(element).addClass('js-summernote-air-enabled').summernote({
                airMode: true,
                tooltip: false
            });
        });

        // Init full text editor
        jQuery('.js-summernote:not(.js-summernote-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-summernote-enabled class to tag it as activated and init it
            el.addClass('js-summernote-enabled').summernote({
                height: el.data('height') || 350,
                minHeight: el.data('min-height') || null,
                maxHeight: el.data('max-height') || null
            });
        });
    }

    /*
     * CKEditor init, for more examples you can check out http://ckeditor.com/
     *
     * Helpers.run('ckeditor');
     *
     * Example usage:
     *
     * <textarea id="js-ckeditor" name="ckeditor">Hello CKEditor!</textarea> or
     * <div id="js-ckeditor-inline">Hello inline CKEditor!</div>
     *
     */
    static ckeditor() {
        // Init inline text editor
        if (jQuery('#js-ckeditor-inline:not(.js-ckeditor-inline-enabled)').length) {
            jQuery('#js-ckeditor-inline').attr('contenteditable','true');
            CKEDITOR.inline('js-ckeditor-inline');

            // Add .js-ckeditor-inline-enabled class to tag it as activated
            jQuery('#js-ckeditor-inline').addClass('js-ckeditor-inline-enabled');
        }

        // Init full text editor
        if (jQuery('#js-ckeditor:not(.js-ckeditor-enabled)').length) {
            CKEDITOR.replace('js-ckeditor');

            // Add .js-ckeditor-enabled class to tag it as activated
            jQuery('#js-ckeditor').addClass('js-ckeditor-enabled');
        }
    }

    /*
     * CKEditor 5 init, for more examples you can check out http://ckeditor.com/
     *
     * Helpers.run('ckeditor5');
     *
     * Example usage:
     *
     * <div id="js-ckeditor5-classic">Hello classic CKEditor 5!</div>
     * ..or..
     * <div id="js-ckeditor5-inline">Hello inline CKEditor 5!</div>
     *
     */
    static ckeditor5() {
        // Init inline text editor
        if (jQuery('#js-ckeditor5-inline:not(.js-ckeditor5-inline-enabled)').length) {
            InlineEditor
                .create( document.querySelector( '#js-ckeditor5-inline' ) )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( error => {
                    console.error( 'There was a problem initializing the inline editor.', error );
                } );

            // Add .js-ckeditor5-inline-enabled class to tag it as activated
            jQuery('#js-ckeditor5-inline').addClass('js-ckeditor5-inline-enabled');
        }

        // Init full text editor
        if (jQuery('#js-ckeditor5-classic:not(.js-ckeditor5-classic-enabled)').length) {
            ClassicEditor
                .create( document.querySelector( '#js-ckeditor5-classic' ) )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( error => {
                    console.error( 'There was a problem initializing the classic editor.', error );
                } );

            // Add .js-ckeditor5-classic-enabled class to tag it as activated
            jQuery('#js-ckeditor5-classic').addClass('js-ckeditor5-classic-enabled');
        }
    }

    /*
     * SimpleMDE init, for more examples you can check out https://github.com/NextStepWebs/simplemde-markdown-editor
     *
     * Helpers.run('simplemde');
     *
     * Example usage:
     *
     * <textarea class="js-simplemde" id="simplemde" name="simplemde">Hello SimpleMDE!</textarea>
     *
     */
    static simpleMDE() {
        // Init markdown editor (with .js-simplemde class)
        jQuery('.js-simplemde:not(.js-simplemde-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-simplemde-enabled class to tag it as activated
            el.addClass('js-simplemde-enabled');

            // Init editor
            new SimpleMDE({ element: el[0], autoDownloadFontAwesome: false });
        });
    }

    /*
     * Slick init, for more examples you can check out http://kenwheeler.github.io/slick/
     *
     * Helpers.run('slick');
     *
     * Example usage:
     *
     * <div class="js-slider">
     *   <div>Slide #1</div>
     *   <div>Slide #2</div>
     *   <div>Slide #3</div>
     * </div>
     *
     */
    static slick() {
        // Get each slider element (with .js-slider class)
        jQuery('.js-slider:not(.js-slider-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-slider-enabled class to tag it as activated and init it
            el.addClass('js-slider-enabled').slick({
                arrows: el.data('arrows') || false,
                dots: el.data('dots') || false,
                slidesToShow: el.data('slides-to-show') || 1,
                centerMode: el.data('center-mode') || false,
                autoplay: el.data('autoplay') || false,
                autoplaySpeed: el.data('autoplay-speed') || 3000,
                infinite: typeof el.data('infinite') === 'undefined' ? true : el.data('infinite')
            });
        });
    }

    /*
     * Bootstrap Datepicker init, for more examples you can check out https://github.com/eternicode/bootstrap-datepicker
     *
     * Helpers.run('datepicker');
     *
     * Example usage:
     *
     * <input type="text" class="js-datepicker form-control">
     *
     */
    static datepicker() {
        // Init datepicker (with .js-datepicker and .input-daterange class)
        jQuery('.js-datepicker:not(.js-datepicker-enabled)').add('.input-daterange:not(.js-datepicker-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-datepicker-enabled class to tag it as activated and init it
            el.addClass('js-datepicker-enabled').datepicker({
                weekStart: el.data('week-start') || 0,
                autoclose: el.data('autoclose') || false,
                todayHighlight: el.data('today-highlight') || false,
                orientation: 'bottom' // Position issue when using BS4, set it to bottom until officially supported
            });
        });
    }

    /*
     * Bootstrap Colorpicker init, for more examples you can check out https://github.com/itsjavi/bootstrap-colorpicker/
     *
     * Helpers.run('colorpicker');
     *
     * Example usage:
     *
     * <input type="text" class="js-colorpicker form-control" value="#db4a39">
     *
     */
    static colorpicker() {
        // Get each colorpicker element (with .js-colorpicker class)
        jQuery('.js-colorpicker:not(.js-colorpicker-enabled)').each((index, element) => {
            // Add .js-enabled class to tag it as activated and init it
            jQuery(element).addClass('js-colorpicker-enabled').colorpicker();
        });
    }

    /*
     * Masked Inputs, for more examples you can check out https://github.com/digitalBush/jquery.maskedinput
     *
     * Helpers.run('masked-inputs');
     *
     * Example usage:
     *
     * Please check out the Form plugins page for complete markup examples
     *
     */
    static maskedInputs() {
        // Init Masked Inputs
        // a - Represents an alpha character (A-Z,a-z)
        // 9 - Represents a numeric character (0-9)
        // * - Represents an alphanumeric character (A-Z,a-z,0-9)
        jQuery('.js-masked-date:not(.js-masked-enabled)').mask('99/99/9999');
        jQuery('.js-masked-date-dash:not(.js-masked-enabled)').mask('99-99-9999');
        jQuery('.js-masked-phone:not(.js-masked-enabled)').mask('(999) 999-9999');
        jQuery('.js-masked-phone-ext:not(.js-masked-enabled)').mask('(999) 999-9999? x99999');
        jQuery('.js-masked-taxid:not(.js-masked-enabled)').mask('99-9999999');
        jQuery('.js-masked-ssn:not(.js-masked-enabled)').mask('999-99-9999');
        jQuery('.js-masked-pkey:not(.js-masked-enabled)').mask('a*-999-a999');
        jQuery('.js-masked-time:not(.js-masked-enabled)').mask('99:99');

        jQuery('.js-masked-date')
            .add('.js-masked-date-dash')
            .add('.js-masked-phone')
            .add('.js-masked-phone-ext')
            .add('.js-masked-taxid')
            .add('.js-masked-ssn')
            .add('.js-masked-pkey')
            .add('.js-masked-time')
            .addClass('js-masked-enabled');
    }

    /*
     * Select2, for more examples you can check out https://github.com/select2/select2
     *
     * Helpers.run('select2');
     *
     * Example usage:
     *
     * <select class="js-select2 form-control" style="width: 100%;" data-placeholder="Choose one..">
     *   <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
     *   <option value="1">HTML</option>
     *   <option value="2">CSS</option>
     *   <option value="3">Javascript</option>
     * </select>
     *
     */
    static select2() {
        // Init Select2 (with .js-select2 class)
        jQuery('.js-select2:not(.js-select2-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-select2-enabled class to tag it as activated and init it
            el.addClass('js-select2-enabled').select2({
                placeholder: el.data('placeholder') || false
            });
        });
    }

    /*
     * Highlight.js, for more examples you can check out https://highlightjs.org/usage/
     *
     * Helpers.run('highlightjs');
     *
     * Example usage:
     *
     * Please check out the Syntax Highlighting page in Components for complete markup examples
     *
     */
    static highlightjs() {
        // Init Highlight.js
        if ( ! hljs.isHighlighted) {
            hljs.initHighlighting();
        }
    }

    /*
     * Bootstrap Notify, for more examples you can check out http://bootstrap-growl.remabledesigns.com/
     *
     * Helpers.run('notify');
     *
     * Example usage:
     *
     * Please check out the Notifications page for examples
     *
     */
    static notify(options = {}) {
        if (jQuery.isEmptyObject(options)) {
            // Init notifications (with .js-notify class)
            jQuery('.js-notify:not(.js-notify-enabled)').each((index, element) => {
                // Add .js-notify-enabled class to tag it as activated and init it
                jQuery(element).addClass('js-notify-enabled').on('click.pixelcave.helpers', e => {
                    let el = jQuery(e.currentTarget);

                    // Create notification
                    jQuery.notify({
                            icon: el.data('icon') || '',
                            message: el.data('message'),
                            url: el.data('url') || ''
                        },
                        {
                            element: 'body',
                            type: el.data('type') || 'info',
                            placement: {
                                from: el.data('from') || 'top',
                                align: el.data('align') || 'right'
                            },
                            allow_dismiss: true,
                            newest_on_top: true,
                            showProgressbar: false,
                            offset: 20,
                            spacing: 10,
                            z_index: 1033,
                            delay: 5000,
                            timer: 1000,
                            animate: {
                                enter: 'animated fadeIn',
                                exit: 'animated fadeOutDown'
                            }
                        });
                });
            });
        } else {
            // Create notification
            jQuery.notify({
                    icon: options.icon || '',
                    message: options.message,
                    url: options.url || ''
                },
                {
                    element: options.element || 'body',
                    type: options.type || 'info',
                    placement: {
                        from: options.from || 'top',
                        align: options.align || 'right'
                    },
                    allow_dismiss: (options.allow_dismiss === false) ? false : true,
                    newest_on_top: (options.newest_on_top === false) ? false : true,
                    showProgressbar: options.show_progress_bar ? true : false,
                    offset: options.offset || 20,
                    spacing: options.spacing || 10,
                    z_index: options.z_index || 1033,
                    delay: options.delay || 5000,
                    timer: options.timer || 1000,
                    animate: {
                        enter: options.animate_enter || 'animated fadeIn',
                        exit: options.animate_exit || 'animated fadeOutDown'
                    }
                });
        }
    }

    /*
     * Easy Pie Chart, for more examples you can check out http://rendro.github.io/easy-pie-chart/
     *
     * Helpers.run('easy-pie-chart');
     *
     * Example usage:
     *
     * <div class="js-pie-chart pie-chart" data-percent="25" data-line-width="2" data-size="100">
     *   <span>..Content..</span>
     * </div>
     *
     */
    static easyPieChart() {
        // Init Easy Pie Charts (with .js-pie-chart class)
        jQuery('.js-pie-chart:not(.js-pie-chart-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-pie-chart-enabled class to tag it as activated and init it
            el.addClass('js-pie-chart-enabled').easyPieChart({
                barColor: el.data('bar-color') || '#777777',
                trackColor: el.data('track-color') || '#eeeeee',
                lineWidth: el.data('line-width') || 3,
                size: el.data('size') || '80',
                animate: el.data('animate') || 750,
                scaleColor: el.data('scale-color') || false
            });
        });
    }

    /*
     * Bootstrap Maxlength, for more examples you can check out https://github.com/mimo84/bootstrap-maxlength
     *
     * Helpers.run('maxlength');
     *
     * Example usage:
     *
     * <input type="text" class="js-maxlength form-control" maxlength="20">
     *
     */
    static maxlength() {
        // Init Bootstrap Maxlength (with .js-maxlength class)
        jQuery('.js-maxlength:not(.js-maxlength-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-maxlength-enabled class to tag it as activated and init it
            el.addClass('js-maxlength-enabled').maxlength({
                alwaysShow: el.data('always-show') ? true : false,
                threshold: el.data('threshold') || 10,
                warningClass: el.data('warning-class') || 'badge badge-warning',
                limitReachedClass: el.data('limit-reached-class') || 'badge badge-danger',
                placement: el.data('placement') || 'bottom',
                preText: el.data('pre-text') || '',
                separator: el.data('separator') || '/',
                postText: el.data('post-text') || ''
            });
        });
    }

    /*
     * Ion Range Slider, for more examples you can check out https://github.com/IonDen/ion.rangeSlider
     *
     * Helpers.run('rangeslider');
     *
     * Example usage:
     *
     * <input type="text" class="js-rangeslider form-control" value="50">
     *
     */
    static rangeslider() {
        // Init Ion Range Slider (with .js-rangeslider class)
        jQuery('.js-rangeslider:not(.js-rangeslider-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-rangeslider-enabled class to tag it as activated and init it
            jQuery(element).addClass('js-rangeslider-enabled').ionRangeSlider({
                input_values_separator: ';',
                skin: el.data('skin') || 'round'
            });
        });
    }

    /*
     * jQuery Sparkline Charts, for more examples you can check out http://omnipotent.net/jquery.sparkline/#s-docs
     *
     * Helpers.run('sparkline');
     *
     * Example usage:
     *
     * <span class="js-sparkline" data-type="line" data-points="[10,20,30,25,15,40,45]"></span>
     *
     */
    static sparkline() {
        let self = this;

        // Init jQuery Sparkline Charts (with .js-sparkline class)
        jQuery('.js-sparkline:not(.js-sparkline-enabled)').each((index, element) => {
            let el      = jQuery(element);
            let type    = el.data('type');
            let options = {};

            // Sparkline types
            let types = {
                line: () => {
                    options['type']                 = type;
                    options['lineWidth']            = el.data('line-width') || 2;
                    options['lineColor']            = el.data('line-color') || '#0665d0';
                    options['fillColor']            = el.data('fill-color') || '#0665d0';
                    options['spotColor']            = el.data('spot-color') || '#495057';
                    options['minSpotColor']         = el.data('min-spot-color') || '#495057';
                    options['maxSpotColor']         = el.data('max-spot-color') || '#495057';
                    options['highlightSpotColor']   = el.data('highlight-spot-color') || '#495057';
                    options['highlightLineColor']   = el.data('highlight-line-color') || '#495057';
                    options['spotRadius']           = el.data('spot-radius') || 2;
                    options['tooltipFormat']        = '{{prefix}}{{y}}{{suffix}}';
                },
                bar: () => {
                    options['type']                 = type;
                    options['barWidth']             = el.data('bar-width') || 8;
                    options['barSpacing']           = el.data('bar-spacing') || 6;
                    options['barColor']             = el.data('bar-color') || '#0665d0';
                    options['tooltipFormat']        = '{{prefix}}{{value}}{{suffix}}';
                },
                pie: () => {
                    options['type']                 = type;
                    options['sliceColors']          = ['#ffb119','#8dc451', '#3c90df','#e04f1a'];
                    options['highlightLighten']     = el.data('highlight-lighten') || 1.1;
                    options['tooltipFormat']        = '{{prefix}}{{value}}{{suffix}}';
                },
                tristate: () => {
                    options['type']                 = type;
                    options['barWidth']             = el.data('bar-width') || 8;
                    options['barSpacing']           = el.data('bar-spacing') || 6;
                    options['posBarColor']          = el.data('pos-bar-color') || '#82b54b';
                    options['negBarColor']          = el.data('neg-bar-color') || '#e04f1a';
                }
            };

            // If the correct type is set init the chart
            if (types[type]) {
                types[type]();

                // Extra options added only if specified
                if (type === 'line') {
                    if (el.data('chart-range-min') >= 0 || el.data('chart-range-min')) {
                        options['chartRangeMin'] = el.data('chart-range-min');
                    }

                    if (el.data('chart-range-max') >= 0 || el.data('chart-range-max')) {
                        options['chartRangeMax'] = el.data('chart-range-max');
                    }
                }

                // Add common options used in all types
                options['width']            = el.data('width') || '120px';
                options['height']           = el.data('height') || '80px';
                options['tooltipPrefix']    = el.data('tooltip-prefix') ? el.data('tooltip-prefix') + ' ' : '';
                options['tooltipSuffix']    = el.data('tooltip-suffix') ? ' ' + el.data('tooltip-suffix') : '';

                // If we need a responsive width for the chart, then don't add .js-sparkline-enabled class and re-run the helper on window resize
                if (options['width'] === '100%') {
                    if (!sparklineResize) {
                        // Make sure that we bind the event only once
                        sparklineResize = true;

                        // On window resize, re-run the Sparkline helper
                        jQuery(window).on('resize.pixelcave.helpers.sparkline', function(e) {
                            clearTimeout(sparklineTimeout);

                            sparklineTimeout = setTimeout(() => {
                                self.sparkline();
                            }, 500);
                        });
                    }
                } else {
                    // It has a specific width (it doesn't need to re-init again on resize), so add .js-sparkline-enabled class to tag it as activated
                    jQuery(element).addClass('js-sparkline-enabled');
                }

                // Finally init it
                jQuery(element).sparkline(el.data('points') || [0], options);
            } else {
                console.log('[jQuery Sparkline JS Helper] Please add a correct type (line, bar, pie or tristate) in all your elements with \'js-sparkline\' class.')
            }
        });
    }

    /*
     * jQuery Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
     *
     * Helpers.run('validation');
     *
     * Example usage:
     *
     * By calling the helper, you set up the default options that will be used for jQuery Validation
     *
     */
    static validation() {
        // Set default options for jQuery Validation plugin
        jQuery.validator.setDefaults({
            errorClass: 'invalid-feedback animated fadeIn',
            errorElement: 'div',
            errorPlacement: (error, el) => {
                jQuery(el).addClass('is-invalid');
                jQuery(el).parents('.form-group').append(error);
            },
            highlight: el => {
                jQuery(el).parents('.form-group').find('.is-invalid').removeClass('is-invalid').addClass('is-invalid');
            },
            success: el => {
                jQuery(el).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
                jQuery(el).remove();
            }
        });
    }

    /*
     * Password Strength Meter, for more examples you can check out https://github.com/ablanco/jquery.pwstrength.bootstrap
     *
     * Helpers.run('pw-strength');
     *
     * Example usage:
     *
     * <div class="js-pw-strength-container form-group">
     *     <label for="example-pw-strength1">Password</label>
     *     <input type="password" class="js-pw-strength form-control" id="example-pw-strength1" name="example-pw-strength1">
     *     <div class="js-pw-strength-progress pw-strength-progress mt-1"></div>
     *     <p class="js-pw-strength-feedback form-text mb-0"></p>
     * </div>
     *
     */
    static pwstrength() {
        // Init Password Strength Meter (with .js-pw-strength class)
        jQuery('.js-pw-strength:not(.js-pw-strength-enabled)').each((index, element) => {
            let el          = jQuery(element);
            let container   = el.parents('.js-pw-strength-container');
            let progress    = jQuery('.js-pw-strength-progress', container);
            let verdict     = jQuery('.js-pw-strength-feedback', container);

            // Add .js-pw-strength-enabled class to tag it as activated and init it
            el.addClass('js-pw-strength-enabled').pwstrength({
                ui: {
                    container: container,
                    viewports: {
                        progress: progress,
                        verdict: verdict
                    }
                }
            });
        });
    }

    /*
     * Flatpickr init, for more examples you can check out https://github.com/flatpickr/flatpickr
     *
     * Helpers.run('flatpickr');
     *
     * Example usage:
     *
     * <input type="text" class="js-flatpickr form-control">
     *
     */
    static flatpickr() {
        // Init Flatpickr (with .js-flatpickr class)
        jQuery('.js-flatpickr:not(.js-flatpickr-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-flatpickr-enabled class to tag it as activated
            el.addClass('js-flatpickr-enabled');

            // Init it
            flatpickr(el, {});
        });
    }
}
