/*
 *  Document   : be_pages_ecom_dashboard.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in eCommerce Dashboard Page
 */

class pageEcomDashboard {
    /*
    * Chart.js, for more examples you can check out http://www.chartjs.org/docs
    *
    */
    static initOverviewChart() {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#495057';
        Chart.defaults.scale.gridLines.color                = 'transparent';
        Chart.defaults.scale.gridLines.zeroLineColor        = 'transparent';
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 0;
        Chart.defaults.global.elements.point.radius         = 0;
        Chart.defaults.global.elements.point.hoverRadius    = 0;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.labels.boxWidth        = 12;

        // Get Chart Container
        let chartOverviewCon  = jQuery('.js-chartjs-overview');

        // Set Chart Variables
        let chartOverview, chartOverviewOptions, chartOverviewData;

        // Overview Chart Options
        chartOverviewOptions = {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 600
                    }
                }]
            },
            tooltips: {
                intersect: false,
                callbacks: {
                    label: function(tooltipItems, data) {
                        return ' $' + tooltipItems.yLabel;
                    }
                }
            }
        };

        // Overview Chart Data
        chartOverviewData = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .5)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(6, 101, 208, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, 1)',
                    data: [369, 255, 420, 330, 460, 160, 350]
                },
                {
                    label: 'Last Week',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .2)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(6, 101, 208, .2)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, .2)',
                    data: [270, 460, 290, 231, 419, 450, 280]
                }
            ]
        };

        // Init Overview Chart
        if (chartOverviewCon.length) {
            chartOverview = new Chart(chartOverviewCon, {
                type: 'line',
                data: chartOverviewData,
                options: chartOverviewOptions
            });
        }
    }

    /*
    * Init functionality
    *
    */
    static init() {
        this.initOverviewChart();
    }
}

// Initialize when page loads
jQuery(() => { pageEcomDashboard.init(); });
