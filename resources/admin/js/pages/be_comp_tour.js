/*
 *  Document   : be_comp_tour.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Bootstrap Tour Page
 */

// Bootstrap Tourist, for more examples you can check out https://github.com/IGreatlyDislikeJavascript/bootstrap-tourist
class pageTour {
    /*
     * Bootstrap Tourist demo functionality
     *
     */
    static bootstrapTourist() {
        // Instance the tour
        let tour = new Tour({
            framework: 'bootstrap4',
            storage: false, // set storage to true to show the tour once
            showProgressBar: false,
            template: `<div class="popover" role="tooltip">
                <div class="arrow"></div>
                <h3 class="popover-header"></h3>
                <div class="popover-body"></div>
                <div class="popover-navigation">
                    <div class="btn-group mr-1">
                        <button class="btn btn-sm btn-primary" data-role="prev">
                            <i class="fa fa-arrow-left mr-1"></i> Previous
                        </button>
                        <button class="btn btn-sm btn-primary" data-role="next">
                            Next <i class="fa fa-arrow-right ml-1"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" data-role="pause-resume" data-pause-text="Pause" data-resume-text="Resume">
                            Pause
                        </button>
                    </div>
                    <button class="btn btn-sm btn-alt-danger" data-role="end">
                        Skip
                    </button>
                </div>
            </div>`,
            steps: [{
                    placement: 'bottom',
                    element: '#page-header',
                    title: 'Page Header',
                    content: 'This is your page header. All your vital account and UI settings can be managed from here.'
                },
                {
                    placement: 'right',
                    element: '#sidebar',
                    title: 'Sidebar',
                    content: 'Your main navigation can be found here. You can use it to navigate through all available pages.'
                },
                {
                    placement: 'bottom',
                    element: '#example-page-heading',
                    title: 'Page Heading',
                    content: 'This is your main heading with vital info regarding your existing page.'
                },
                {
                    placement: 'top',
                    element: '#page-footer',
                    title: 'Page Footer',
                    content: 'This is where your page footer exists. All non vital information can be put in here.'
                }
            ]
        });

        // Start the tour
        tour.start();
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.bootstrapTourist();
    }
}

// Initialize when page loads
jQuery(() => { pageTour.init(); });
