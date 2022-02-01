/*
 *  Document   : db_corporate_slim.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Corporate Slim Dashboard Page
 */

// Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs
class DbCorporateSlim {
    /*
     * Init Charts
     *
     */
    static initCorporateChartJS() {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#7c7c7c';
        Chart.defaults.scale.gridLines.color                = "transparent";
        Chart.defaults.scale.gridLines.zeroLineColor        = "transparent";
        Chart.defaults.scale.display                        = false;
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 2;
        Chart.defaults.global.elements.point.radius         = 6;
        Chart.defaults.global.elements.point.hoverRadius    = 10;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.display                = false;

        // Chart Containers
        let chartCorporateSlimProjectsCon   = jQuery('.js-chartjs-corporate-slim-projects');
        let chartCorporateSlimTicketsCon    = jQuery('.js-chartjs-corporate-slim-tickets');

        // Chart Variables
        let chartCorporateSlimProjects, chartCorporateSlimTickets;

        // Lines Charts Data
        let chartCorporateSlimProjectsData = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(73, 80, 87, .1)',
                    borderColor: 'rgba(73, 80, 87, .35)',
                    pointBackgroundColor: 'rgba(73, 80, 87, .5)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(73, 80, 87, .5)',
                    data: [14, 16, 6, 14, 10, 19, 12]
                }
            ]
        };

        let chartCorporateSlimProjectsOptions = {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 22
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: (tooltipItems, data) => {
                        return ' ' + tooltipItems.yLabel + ' Projects';
                    }
                }
            }
        };

        let chartCorporateSlimTicketsData = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(130, 181, 75, .1)',
                    borderColor: 'rgba(130, 181, 75, .35)',
                    pointBackgroundColor: 'rgba(130, 181, 75, .5)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(130, 181, 75, .5)',
                    data: [35, 20, 29, 20, 40, 34, 45]
                }
            ]
        };

        let chartCorporateSlimTicketsOptions = {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 50
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: (tooltipItems, data) => {
                        return ' ' + tooltipItems.yLabel + ' Tickets';
                    }
                }
            }
        };

        // Init Charts
        if (chartCorporateSlimProjectsCon.length) {
            chartCorporateSlimProjects = new Chart(chartCorporateSlimProjectsCon, {
                type: 'line',
                data: chartCorporateSlimProjectsData,
                options: chartCorporateSlimProjectsOptions
            });
        }

        if (chartCorporateSlimTicketsCon.length) {
            chartCorporateSlimTickets = new Chart(chartCorporateSlimTicketsCon, {
                type: 'line',
                data: chartCorporateSlimTicketsData,
                options: chartCorporateSlimTicketsOptions
            });
        }
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initCorporateChartJS();
    }
}

// Initialize when page loads
jQuery(() => { DbCorporateSlim.init(); });
