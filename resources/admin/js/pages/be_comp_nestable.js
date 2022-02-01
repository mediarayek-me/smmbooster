/*
 *  Document   : be_comp_nestable.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Nestable Page
 */

// Nestable2, for more examples you can check out https://github.com/RamonSmit/Nestable2
class pageCompNestable {
    /*
     * Nestable2 demo functionality
     *
     */
    static nestable2() {
        // Init Connected Lists
        jQuery('.js-nestable-connected-simple').
            add('.js-nestable-connected-icons').
            add('.js-nestable-connected-treeview').nestable({
            group: 0
        });

        // Init Simple List
        jQuery('.js-nestable-simple').nestable({
            group: 1
        });

        // Init Icons List
        jQuery('.js-nestable-icons').nestable({
            group: 2
        });

        // Init Tree View List
        jQuery('.js-nestable-treeview').nestable({
            group: 3
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.nestable2();
    }
}

// Initialize when page loads
jQuery(() => { pageCompNestable.init(); });
