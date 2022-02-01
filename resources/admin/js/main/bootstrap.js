/*
 *  Document   : bootstrap.js
 *  Author     : mediarayek
 *  Description: Import global dependencies
 *
 */

/*
 ********************************************************************************************
 *
 * If you would like to use webpack to handle all required core JS files, you can uncomment
 * the following imports and window assignments to have them included in the compiled
 * dashmix.app.min.js as well.
 *
 * After that change, you won't have to include dashmix.core.min.js in your pages any more
 *
 *********************************************************************************************
 */

// Import all vital core JS files..
import jQuery from 'jquery';
import SimpleBar from 'simplebar';
import Cookies from 'js-cookie';
import 'bootstrap';
import 'popper.js';
import 'jquery.appear';
import 'jquery-scroll-lock';

// ..and assign to window the ones that need it
window.$ = window.jQuery  = jQuery;
window.SimpleBar          = SimpleBar;
window.Cookies            = Cookies;
