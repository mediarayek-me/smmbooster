/*
 *  Document   : template.js
 *  Author     : mediarayek
 *  Description: UI Framework custom functionality
 *
 */

// Import required modules
import Tools from './tools';
import Helpers from './helpers';

// Template
export default class Template {
    /*
     * Auto called when creating a new instance
     *
     */
    constructor() {
        this._uiInit();
    }

    /*
     * Init all vital functionality
     *
     */
    _uiInit() {
        // Layout variables
        this._lHtml                 = jQuery('html');
        this._lBody                 = jQuery('body');
        this._lpageLoader           = jQuery('#page-loader');
        this._lPage                 = jQuery('#page-container');
        this._lSidebar              = jQuery('#sidebar');
        this._lSidebarScrollCon     = jQuery('.js-sidebar-scroll', '#sidebar');
        this._lSideOverlay          = jQuery('#side-overlay');
        this._lHeader               = jQuery('#page-header');
        this._lHeaderSearch         = jQuery('#page-header-search');
        this._lHeaderSearchInput    = jQuery('#page-header-search-input');
        this._lHeaderLoader         = jQuery('#page-header-loader');
        this._lMain                 = jQuery('#main-container');
        this._lFooter               = jQuery('#page-footer');

        // Helper variables
        this._lSidebarScroll        = false;
        this._lSideOverlayScroll    = false;
        this._windowW               = Tools.getWidth();

        // Base UI Init
        this._uiHandleSidebars('init');
        this._uiHandleHeader();
        this._uiHandleNav();
        this._uiHandleTheme();

        // API Init
        this._uiApiLayout();
        this._uiApiBlocks();

        // Core Helpers Init
        this.helpers([
            'core-bootstrap-tooltip',
            'core-bootstrap-popover',
            'core-bootstrap-tabs',
            'core-bootstrap-custom-file-input',
            'core-toggle-class',
            'core-scroll-to',
            'core-year-copy',
            'core-appear',
            'core-ripple'
        ]);

        // Page Loader (hide it)
        this._uiHandlePageLoader();
    }

    /*
     * Handles sidebar and side overlay scrolling functionality/styles
     *
     */
    _uiHandleSidebars(mode) {
        let self = this;

        if (mode === 'init') {
            // Add 'side-trans-enabled' class to #page-container (enables sidebar and side overlay transition on open/close)
            // Fixes IE10, IE11 and Edge bug in which animation was executed on each page load - really annoying!
            self._lPage.addClass('side-trans-enabled');

            // Init custom scrolling
            this._uiHandleSidebars();
        } else {
            // If .side-scroll is added to #page-container enable custom scrolling
            if (self._lPage.hasClass('side-scroll')) {
                // Init custom scrolling on Sidebar container
                if ((self._lSidebar.length > 0) && !self._lSidebarScroll) {
                    self._lSidebarScroll = new SimpleBar(self._lSidebarScrollCon[0]);

                    // Enable scrolling lock
                    jQuery('.simplebar-content-wrapper', self._lSidebar).scrollLock('enable');
                }

                // Init custom scrolling on Side Overlay
                if ((self._lSideOverlay.length > 0) && !self._lSideOverlayScroll) {
                    self._lSideOverlayScroll = new SimpleBar(self._lSideOverlay[0]);

                    // Enable scrolling lock
                    jQuery('.simplebar-content-wrapper', self._lSideOverlay).scrollLock('enable');
                }
            } else {
                // If custom scrolling exists on Sidebar remove it
                if (self._lSidebar && self._lSidebarScroll) {
                    // Disable scrolling lock
                    jQuery('.simplebar-content-wrapper', self._lSidebar).scrollLock('disable');

                    // Unmount Simplebar
                    self._lSidebarScroll.unMount();
                    self._lSidebarScroll = null;

                    // Remove Simplebar leftovers
                    self._lSidebarScrollCon.removeAttr('data-simplebar')
                        .html(jQuery('.simplebar-content', self._lSidebar).html());
                }

                // If custom scrolling exists on Side Overlay remove it
                if (self._lSideOverlay && self._lSideOverlayScroll) {
                    // Disable scrolling lock
                    jQuery('.simplebar-content-wrapper', self._lSideOverlay).scrollLock('disable');

                    // Unmount Simplebar
                    self._lSideOverlayScroll.unMount();
                    self._lSideOverlayScroll = null;

                    // Remove Simplebar leftovers
                    self._lSideOverlay.removeAttr('data-simplebar')
                        .html(jQuery('.simplebar-content', self._lSideOverlay).html());
                }
            }
        }
    }

    /*
     * Handles header related classes
     *
     */
    _uiHandleHeader() {
        let self = this;

        // Unbind event in case it is already enabled
        jQuery(window).off('scroll.pixelcave.header');

        // If the header is fixed and has the glass style, add the related class on scrolling to add a background color to the header
        if (self._lPage.hasClass('page-header-glass') && self._lPage.hasClass('page-header-fixed')) {
            jQuery(window).on('scroll.pixelcave.header', e => {
                if (jQuery(e.currentTarget).scrollTop() > 60) {
                    self._lPage.addClass('page-header-scroll');
                } else {
                    self._lPage.removeClass('page-header-scroll');
                }
            }).trigger('scroll.pixelcave.header');
        }
    }

    /*
     * Toggle Submenu functionality
     *
     */
    _uiHandleNav() {
        // Unbind event in case it is already enabled
        this._lPage.off('click.pixelcave.menu');

        // When a submenu link is clicked
        this._lPage.on('click.pixelcave.menu', '[data-toggle="submenu"]', e => {
            // Get link
            let link = jQuery(e.currentTarget);

            // Check if we are in horizontal navigation, large screen and hover is enabled
            if (!(Tools.getWidth() > 991 && link.parents('.nav-main').hasClass('nav-main-horizontal nav-main-hover'))) {
                // Get link's parent
                let parentLi = link.parent('li');

                if (parentLi.hasClass('open')) {
                    // If submenu is open, close it..
                    parentLi.removeClass('open');
                    link.attr('aria-expanded', 'false');
                } else {
                    // .. else if submenu is closed, close all other (same level) submenus first before open it
                    link.closest('ul').children('li').removeClass('open');
                    parentLi.addClass('open');
                    link.attr('aria-expanded', 'true');
                }

                // Remove focus from submenu link
                link.trigger('blur');
            }

            return false;
        });
    }

    /*
     * Page loading screen functionality
     *
     */
    _uiHandlePageLoader(mode = 'hide', colorClass) {
        if (mode === 'show') {
            if (this._lpageLoader.length) {
                if (colorClass) {
                    this._lpageLoader.removeClass().addClass(colorClass);
                }

                this._lpageLoader.addClass('show');
            } else {
                this._lBody.prepend(`<div id="page-loader" class="show${colorClass ? ' ' + colorClass : ''}"></div>`);
            }
        } else if (mode === 'hide') {
            if (this._lpageLoader.length) {
                this._lpageLoader.removeClass('show');
            }
        }
    }

    /*
     * Set active color theme functionality
     *
     */
    _uiHandleTheme() {
        let themeEl = jQuery('#css-theme');
        let cookies = this._lPage.hasClass('enable-cookies') ? true : false;

        // If cookies are enabled
        if (cookies) {
            let themeName  = Cookies.get('dashmixThemeName') || false;

            // Update color theme
            if (themeName) {
                Tools.updateTheme(themeEl, themeName);
            }

            // Update theme element
            themeEl = jQuery('#css-theme');
        }

        // Set the active color theme link as active
        jQuery('[data-toggle="theme"][data-theme="' + (themeEl.length ? themeEl.attr('href') : 'default') + '"]').addClass('active');

        // Unbind event in case it is already enabled
        this._lPage.off('click.pixelcave.themes');

        // When a color theme link is clicked
        this._lPage.on('click.pixelcave.themes', '[data-toggle="theme"]', e => {
            e.preventDefault();

            // Get element and data
            let el = jQuery(e.currentTarget);
            let themeName = el.data('theme');

            // Set this color theme link as active
            jQuery('[data-toggle="theme"]').removeClass('active');
            jQuery('[data-toggle="theme"][data-theme="' + themeName + '"]').addClass('active');

            // Update color theme
            Tools.updateTheme(themeEl, themeName);

            // Update theme element
            themeEl = jQuery('#css-theme');

            // If cookies are enabled, save the new active color theme
            if (cookies) {
                Cookies.set('dashmixThemeName', themeName, { expires: 7 });
            }

            // Blur the link/button
            el.trigger('blur');
        });
    }

    /*
     * Layout API
     *
     */
    _uiApiLayout(mode = 'init') {
        let self = this;

        // Get current window width
        self._windowW = Tools.getWidth();

        // API with object literals
        let layoutAPI = {
            init: () => {
                // Unbind events in case they are already enabled
                self._lPage.off('click.pixelcave.layout');
                self._lPage.off('click.pixelcave.overlay');

                // Call layout API on button click
                self._lPage.on('click.pixelcave.layout', '[data-toggle="layout"]', e => {
                    let el = jQuery(e.currentTarget);

                    self._uiApiLayout(el.data('action'));

                    el.trigger('blur');
                });

                // Prepend Page Overlay div if enabled (used when Side Overlay opens)
                if (self._lPage.hasClass('enable-page-overlay')) {
                    self._lPage.prepend('<div id="page-overlay"></div>');

                    jQuery('#page-overlay').on('click.pixelcave.overlay', e => {
                        self._uiApiLayout('side_overlay_close');
                    });
                }
            },
            sidebar_pos_toggle: () => {
                self._lPage.toggleClass('sidebar-r');
            },
            sidebar_pos_left: () => {
                self._lPage.removeClass('sidebar-r');
            },
            sidebar_pos_right: () => {
                self._lPage.addClass('sidebar-r');
            },
            sidebar_toggle: () => {
                if (self._windowW > 991) {
                    self._lPage.toggleClass('sidebar-o');
                } else {
                    self._lPage.toggleClass('sidebar-o-xs');
                }
            },
            sidebar_open: () => {
                if (self._windowW > 991) {
                    self._lPage.addClass('sidebar-o');
                } else {
                    self._lPage.addClass('sidebar-o-xs');
                }
            },
            sidebar_close: () => {
                if (self._windowW > 991) {
                    self._lPage.removeClass('sidebar-o');
                } else {
                    self._lPage.removeClass('sidebar-o-xs');
                }
            },
            sidebar_mini_toggle: () => {
                if (self._windowW > 991) {
                    self._lPage.toggleClass('sidebar-mini');
                }
            },
            sidebar_mini_on: () => {
                if (self._windowW > 991) {
                    self._lPage.addClass('sidebar-mini');
                }
            },
            sidebar_mini_off: () => {
                if (self._windowW > 991) {
                    self._lPage.removeClass('sidebar-mini');
                }
            },
            sidebar_style_toggle: () => {
                self._lPage.toggleClass('sidebar-dark');
            },
            sidebar_style_dark: () => {
                self._lPage.addClass('sidebar-dark');
            },
            sidebar_style_light: () => {
                self._lPage.removeClass('sidebar-dark');
            },
            side_overlay_toggle: () => {
                if (self._lPage.hasClass('side-overlay-o')) {
                    self._uiApiLayout('side_overlay_close');
                } else {
                    self._uiApiLayout('side_overlay_open');
                }
            },
            side_overlay_open: () => {
                // When ESCAPE key is hit close the side overlay
                jQuery(document).on('keydown.pixelcave.sideOverlay', e => {
                    if (e.which === 27) {
                        e.preventDefault();
                        self._uiApiLayout('side_overlay_close');
                    }
                });

                self._lPage.addClass('side-overlay-o');
            },
            side_overlay_close: () => {
                // Unbind ESCAPE key
                jQuery(document).off('keydown.pixelcave.sideOverlay');

                self._lPage.removeClass('side-overlay-o');
            },
            side_overlay_mode_hover_toggle: () => {
                self._lPage.toggleClass('side-overlay-hover');
            },
            side_overlay_mode_hover_on: () => {
                self._lPage.addClass('side-overlay-hover');
            },
            side_overlay_mode_hover_off: () => {
                self._lPage.removeClass('side-overlay-hover');
            },
            header_mode_toggle: () => {
                self._lPage.toggleClass('page-header-fixed');
                self._uiHandleHeader();
            },
            header_mode_static: () => {
                self._lPage.removeClass('page-header-fixed');
                self._uiHandleHeader();
            },
            header_mode_fixed: () => {
                self._lPage.addClass('page-header-fixed');
                self._uiHandleHeader();
            },
            header_glass_toggle: () => {
                self._lPage.toggleClass('page-header-glass');
                self._uiHandleHeader();
            },
            header_glass_on: () => {
                self._lPage.addClass('page-header-glass');
                self._uiHandleHeader();
            },
            header_glass_off: () => {
                self._lPage.removeClass('page-header-glass');
                self._uiHandleHeader();
            },
            header_style_toggle: () => {
                self._lPage.toggleClass('page-header-dark');
            },
            header_style_dark: () => {
                self._lPage.addClass('page-header-dark');
            },
            header_style_light: () => {
                self._lPage.removeClass('page-header-dark');
            },
            header_search_on: () => {
                self._lHeaderSearch.addClass('show');
                self._lHeaderSearchInput.focus();

                // When ESCAPE key is hit close the search section
                jQuery(document).on('keydown.pixelcave.header.search', e => {
                    if (e.which === 27) {
                        e.preventDefault();
                        self._uiApiLayout('header_search_off');
                    }
                });
            },
            header_search_off: () => {
                self._lHeaderSearch.removeClass('show');
                self._lHeaderSearchInput.trigger('blur');

                // Unbind ESCAPE key
                jQuery(document).off('keydown.pixelcave.header.search');
            },
            header_loader_on: () => {
                self._lHeaderLoader.addClass('show');
            },
            header_loader_off: () => {
                self._lHeaderLoader.removeClass('show');
            },
            footer_mode_toggle: () => {
                self._lPage.toggleClass('page-footer-fixed');
            },
            footer_mode_static: () => {
                self._lPage.removeClass('page-footer-fixed');
            },
            footer_mode_fixed: () => {
                self._lPage.addClass('page-footer-fixed');
            },
            side_scroll_toggle: () => {
                self._lPage.toggleClass('side-scroll');
                self._uiHandleSidebars();
            },
            side_scroll_native: () => {
                self._lPage.removeClass('side-scroll');
                self._uiHandleSidebars();
            },
            side_scroll_custom: () => {
                self._lPage.addClass('side-scroll');
                self._uiHandleSidebars();
            },
            content_layout_toggle: () => {
                if (self._lPage.hasClass('main-content-boxed')) {
                    self._uiApiLayout('content_layout_narrow');
                } else if (self._lPage.hasClass('main-content-narrow')) {
                    self._uiApiLayout('content_layout_full_width');
                } else {
                    self._uiApiLayout('content_layout_boxed');
                }
            },
            content_layout_boxed: () => {
                self._lPage.removeClass('main-content-narrow').addClass('main-content-boxed');
            },
            content_layout_narrow: () => {
                self._lPage.removeClass('main-content-boxed').addClass('main-content-narrow');
            },
            content_layout_full_width: () => {
                self._lPage.removeClass('main-content-boxed main-content-narrow');
            }
        };

        // Call layout API
        if (layoutAPI[mode]) {
            layoutAPI[mode]();
        }
    }

    /*
     * Blocks API
     *
     */
    _uiApiBlocks(mode = 'init', block = false) {
        let self = this;

        // Helper variables
        let elBlock, btnFullscreen, btnContentToggle;

        // Set default icons for fullscreen and content toggle buttons
        let iconFullscreen         = 'si si-size-fullscreen';
        let iconFullscreenActive   = 'si si-size-actual';
        let iconContent            = 'si si-arrow-up';
        let iconContentActive      = 'si si-arrow-down';

        // API with object literals
        let blockAPI = {
            init: () => {
                // Auto add the default toggle icons to fullscreen and content toggle buttons
                jQuery('[data-toggle="block-option"][data-action="fullscreen_toggle"]').each((index, element) => {
                    let el = jQuery(element);

                    el.html('<i class="' + (jQuery(el).closest('.block').hasClass('block-mode-fullscreen') ? iconFullscreenActive : iconFullscreen) + '"></i>');
                });

                jQuery('[data-toggle="block-option"][data-action="content_toggle"]').each((index, element) => {
                    let el = jQuery(element);

                    el.html('<i class="' + (el.closest('.block').hasClass('block-mode-hidden') ? iconContentActive : iconContent) + '"></i>');
                });

                // Unbind event in case it is already enabled
                self._lPage.off('click.pixelcave.blocks');

                // Call blocks API on option button click
                self._lPage.on('click.pixelcave.blocks', '[data-toggle="block-option"]', e => {
                    this._uiApiBlocks(jQuery(e.currentTarget).data('action'), jQuery(e.currentTarget).closest('.block'));
                });
            },
            fullscreen_toggle: () => {
                elBlock.removeClass('block-mode-pinned').toggleClass('block-mode-fullscreen');

                // Enable/disable scroll lock to block
                if (elBlock.hasClass('block-mode-fullscreen')) {
                    jQuery(elBlock).scrollLock('enable');
                } else {
                    jQuery(elBlock).scrollLock('disable');
                }

                // Update block option icon
                if (btnFullscreen.length) {
                    if (elBlock.hasClass('block-mode-fullscreen')) {
                        jQuery('i', btnFullscreen)
                            .removeClass(iconFullscreen)
                            .addClass(iconFullscreenActive);
                    } else {
                        jQuery('i', btnFullscreen)
                            .removeClass(iconFullscreenActive)
                            .addClass(iconFullscreen);
                    }
                }
            },
            fullscreen_on: () => {
                elBlock.removeClass('block-mode-pinned').addClass('block-mode-fullscreen');

                // Enable scroll lock to block
                jQuery(elBlock).scrollLock('enable');

                // Update block option icon
                if (btnFullscreen.length) {
                    jQuery('i', btnFullscreen)
                        .removeClass(iconFullscreen)
                        .addClass(iconFullscreenActive);
                }
            },
            fullscreen_off: () => {
                elBlock.removeClass('block-mode-fullscreen');

                // Disable scroll lock to block
                jQuery(elBlock).scrollLock('disable');

                // Update block option icon
                if (btnFullscreen.length) {
                    jQuery('i', btnFullscreen)
                        .removeClass(iconFullscreenActive)
                        .addClass(iconFullscreen);
                }
            },
            content_toggle: () => {
                elBlock.toggleClass('block-mode-hidden');

                // Update block option icon
                if (btnContentToggle.length) {
                    if (elBlock.hasClass('block-mode-hidden')) {
                        jQuery('i', btnContentToggle)
                            .removeClass(iconContent)
                            .addClass(iconContentActive);
                    } else {
                        jQuery('i', btnContentToggle)
                            .removeClass(iconContentActive)
                            .addClass(iconContent);
                    }
                }
            },
            content_hide: () => {
                elBlock.addClass('block-mode-hidden');

                // Update block option icon
                if (btnContentToggle.length) {
                    jQuery('i', btnContentToggle)
                        .removeClass(iconContent)
                        .addClass(iconContentActive);
                }
            },
            content_show: () => {
                elBlock.removeClass('block-mode-hidden');

                // Update block option icon
                if (btnContentToggle.length) {
                    jQuery('i', btnContentToggle)
                        .removeClass(iconContentActive)
                        .addClass(iconContent);
                }
            },
            state_toggle: () => {
                elBlock.toggleClass('block-mode-loading');

                // Return block to normal state if the demostration mode is on in the refresh option button - data-action-mode="demo"
                if (jQuery('[data-toggle="block-option"][data-action="state_toggle"][data-action-mode="demo"]', elBlock).length) {
                    setTimeout(() => {
                        elBlock.removeClass('block-mode-loading');
                    }, 2000);
                }
            },
            state_loading: () => {
                elBlock.addClass('block-mode-loading');
            },
            state_normal: () => {
                elBlock.removeClass('block-mode-loading');
            },
            pinned_toggle: () => {
                elBlock.removeClass('block-mode-fullscreen').toggleClass('block-mode-pinned');
            },
            pinned_on: () => {
                elBlock.removeClass('block-mode-fullscreen').addClass('block-mode-pinned');
            },
            pinned_off: () => {
                elBlock.removeClass('block-mode-pinned');
            },
            close: () => {
                elBlock.addClass('d-none');
            },
            open: () => {
                elBlock.removeClass('d-none');
            }
        };

        if (mode === 'init') {
            // Call Block API
            blockAPI[mode]();
        } else {
            // Get block element
            elBlock = (block instanceof jQuery) ? block : jQuery(block);

            // If element exists, procceed with block functionality
            if (elBlock.length) {
                // Get block option buttons if exist (need them to update their icons)
                btnFullscreen       = jQuery('[data-toggle="block-option"][data-action="fullscreen_toggle"]', elBlock);
                btnContentToggle    = jQuery('[data-toggle="block-option"][data-action="content_toggle"]', elBlock);

                // Call Block API
                if (blockAPI[mode]) {
                    blockAPI[mode]();
                }
            }
        }
    }

    /*
     ********************************************************************************************
     *
     * Create aliases for easier/quicker access to vital methods
     *
     *********************************************************************************************
     */

    /*
     * Init base functionality
     *
     */
    init() {
        this._uiInit();
    }

    /*
     * Layout API
     *
     */
    layout(mode) {
        this._uiApiLayout(mode);
    }

    /*
     * Blocks API
     *
     */
    block(mode, block) {
        this._uiApiBlocks(mode, block);
    }

    /*
     * Handle Page Loader
     *
     */
    loader(mode, colorClass) {
        this._uiHandlePageLoader(mode, colorClass);
    }

    /*
     * Run Helpers
     *
     */
    helpers(helpers, options = {}) {
        Helpers.run(helpers, options);
    }
}
