/*
 *  Document   : be_comp_calendar.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Calendar Page
 */

// Full Calendar, for more examples you can check out http://fullcalendar.io/
class pageCompCalendar {
    /*
     * Add event to the events list
     *
     */
    static addEvent() {
        let eventInput      = jQuery('.js-add-event');
        let eventInputVal   = '';

        // When the add event form is submitted
        jQuery('.js-form-add-event').on('submit', e => {
            // Get input value
            eventInputVal = eventInput.prop('value');

            // Check if the user entered something
            if (eventInputVal) {
                // Add it to the events list
                jQuery('#js-events')
                    .prepend('<li>' + '<div class="js-event p-2 text-white font-size-sm font-w500 bg-info">' +
                            jQuery('<div />').text(eventInputVal).html() +
                            '</div>' + '</li>');

                // Clear input field
                eventInput.prop('value', '');
            }

            return false;
        });
    }

    /*
     * Init drag and drop event functionality
     *
     */
    static initEvents() {
        new FullCalendar.Draggable(document.getElementById('js-events'), {
            itemSelector: '.js-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText,
                    backgroundColor: getComputedStyle(eventEl).backgroundColor,
                    borderColor: getComputedStyle(eventEl).backgroundColor
                };
            }
        });
    }

    /*
     * Init calendar demo functionality
     *
     */
    static initCalendar() {
        let date = new Date();
        let d    = date.getDate();
        let m    = date.getMonth();
        let y    = date.getFullYear();

        let calendar = new FullCalendar.Calendar(document.getElementById('js-calendar'), {
            themeSystem: 'bootstrap',
            firstDay: 1,
            editable: true,
            droppable: true,
            headerToolbar: {
                left: 'title',
                right: 'prev,next today dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            drop: function(info) {
                info.draggedEl.parentNode.remove();
            },
            events: [
                {
                    title: 'Gaming Day',
                    start: new Date(y, m, 1),
                    allDay: true
                },
                {
                    title: 'Skype Meeting',
                    start: new Date(y, m, 3)
                },
                {
                    title: 'Project X',
                    start: new Date(y, m, 9),
                    end: new Date(y, m, 12),
                    allDay: true,
                    color: '#e04f1a'
                },
                {
                    title: 'Work',
                    start: new Date(y, m, 17),
                    end: new Date(y, m, 19),
                    allDay: true,
                    color: '#82b54b'
                },
                {
                    id: 999,
                    title: 'Hiking (repeated)',
                    start: new Date(y, m, d - 1, 15, 0)
                },
                {
                    id: 999,
                    title: 'Hiking (repeated)',
                    start: new Date(y, m, d + 3, 15, 0)
                },
                {
                    title: 'Landing Template',
                    start: new Date(y, m, d - 3),
                    end: new Date(y, m, d - 3),
                    allDay: true,
                    color: '#ffb119'
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d + 7, 15, 0),
                    color: '#82b54b'
                },
                {
                    title: 'Coding',
                    start: new Date(y, m, d, 8, 0),
                    end: new Date(y, m, d, 14, 0),
                },
                {
                    title: 'Trip',
                    start: new Date(y, m, 25),
                    end: new Date(y, m, 27),
                    allDay: true,
                    color: '#ffb119'
                },
                {
                    title: 'Reading',
                    start: new Date(y, m, d + 8, 20, 0),
                    end: new Date(y, m, d + 8, 22, 0)
                },
                {
                    title: 'Follow us on Twitter',
                    start: new Date(y, m, 22),
                    allDay: true,
                    url: 'http://twitter.com/pixelcave',
                    color: '#3c90df'
                }
            ]
        });

        calendar.render();
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.addEvent();
        this.initEvents();
        this.initCalendar();
    }
}

// Initialize when page loads
jQuery(() => { pageCompCalendar.init(); });
