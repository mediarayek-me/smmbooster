/*
 *  Document   : be_pages_dashboard.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in default Dashboard v1 Page
 */

class pageDashboardv1 {
    /*
    * Chart.js, for more examples you can check out http://www.chartjs.org/docs
    *
    */
    static initChartsMain() {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#495057';
        Chart.defaults.scale.gridLines.color                = 'transparent';
        Chart.defaults.scale.gridLines.zeroLineColor        = 'transparent';
        Chart.defaults.scale.display                        = false;
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 0;
        Chart.defaults.global.elements.point.radius         = 0;
        Chart.defaults.global.elements.point.hoverRadius    = 0;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.labels.boxWidth        = 12;

        // Get Chart Containers
        let chartMainCon  = jQuery('.js-chartjs-dashboard-earnings');

        // Set Main Chart variables
        let chartMain, chartMainOptions, chartMainData, chartMainDataYear, chartMainDataMonth, chartMainDataWeek;

        // Main Chart Options
        chartMainOptions = {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 260
                    }
                }]
            },
            tooltips: {
                intersect: false,
                callbacks: {
                    label: function(tooltipItems, data) {
                        return ' ' + tooltipItems.yLabel + ' Sales';
                    }
                }
            }
        };

        // Main Chart Default Data
        chartMainData = {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    label: 'This Year',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .5)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(6, 101, 208, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, 1)',
                    data: [50, 210, 110, 90, 230, 130, 190, 75, 155, 120, 140, 230]
                },
                {
                    label: 'Last Year',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .2)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(6, 101, 208, .2)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, .2)',
                    data: [210, 150, 90, 220, 150, 216, 143, 150, 240, 230, 136, 150]
                }
            ]
        };

        // Main Chart for Year
        chartMainDataYear = {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    label: 'This Year',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .5)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(6, 101, 208, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, 1)',
                    data: [50, 210, 110, 90, 230, 130, 190, 75, 155, 120, 140, 230]
                },
                {
                    label: 'Last Year',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .2)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(6, 101, 208, .2)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, .2)',
                    data: [210, 150, 90, 220, 150, 216, 143, 150, 240, 230, 136, 150]
                }
            ]
        };

        // Set up month labels
        let chartMainDataMonthLabels = [];

        for (let i = 0; i < 30; i++) {
            chartMainDataMonthLabels[i] = (i === 29) ? '1 day ago' : (30 - i) + ' days ago';
        }

        // Main Chart Data for Month
        chartMainDataMonth = {
            labels: chartMainDataMonthLabels,
            datasets: [
                {
                    label: 'This Month',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .5)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(6, 101, 208, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, 1)',
                    data: [50, 210, 110, 90, 230, 130, 190, 75, 155, 120, 140, 230, 50, 210, 110, 90, 230, 130, 155, 120, 140, 230, 50, 210, 110, 90, 230, 130, 190, 75]
                },
                {
                    label: 'Last Month',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .2)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(6, 101, 208, .2)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, .2)',
                    data: [210, 150, 90, 220, 150, 216, 143, 150, 136, 150, 210, 150, 90, 220, 150, 216, 240, 230, 136, 150, 210, 150, 90, 220, 150, 216, 143, 150, 240, 230]
                }
            ]
        };

        // Main Chart Data for Week
        chartMainDataWeek = {
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
                    data: [34, 42, 62, 78, 39, 83, 98]
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
                    data: [130, 95, 125, 160, 187, 110, 143]
                }
            ]
        };

        // Init Main Chart
        if (chartMainCon.length) {
            chartMain = new Chart(chartMainCon, {
                type: 'line',
                data: chartMainData,
                options: chartMainOptions
            });
        }

        // Toggle to Week data
        jQuery('[data-toggle="dashboard-chart-set-week"]').on('click', () => {
            chartMain.data.labels       = chartMainDataWeek.labels;
            chartMain.data.datasets[0]  = chartMainDataWeek.datasets[0];
            chartMain.data.datasets[1]  = chartMainDataWeek.datasets[1];
            chartMain.update();
        });

        // Toggle to Month data
        jQuery('[data-toggle="dashboard-chart-set-month"]').on('click', () => {
            chartMain.data.labels       = chartMainDataMonth.labels;
            chartMain.data.datasets[0]  = chartMainDataMonth.datasets[0];
            chartMain.data.datasets[1]  = chartMainDataMonth.datasets[1];
            chartMain.update();
        });

        // Toggle to Year data
        jQuery('[data-toggle="dashboard-chart-set-year"]').on('click', () => {
            chartMain.data.labels       = chartMainDataYear.labels;
            chartMain.data.datasets[0]  = chartMainDataYear.datasets[0];
            chartMain.data.datasets[1]  = chartMainDataYear.datasets[1];
            chartMain.update();
        });
    }

    /*
    * Init functionality
    *
    */
    static init() {
        this.initChartsMain();
    }
}

// Initialize when page loads
jQuery(() => { pageDashboardv1.init(); });
