/*
 *  Document   : be_comp_charts.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Charts Page
 */

// Full Calendar, for more examples you can check out http://fullcalendar.io/
class pageCompCharts {
    /*
    * Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs
    *
    */
    static initChartsChartJS() {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#495057';
        Chart.defaults.scale.gridLines.color                = "rgba(0,0,0,.04)";
        Chart.defaults.scale.gridLines.zeroLineColor        = "rgba(0,0,0,.1)";
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 2;
        Chart.defaults.global.elements.point.radius         = 5;
        Chart.defaults.global.elements.point.hoverRadius    = 7;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.labels.boxWidth        = 12;

        // Get Chart Containers
        let chartLinesCon  = jQuery('.js-chartjs-lines');
        let chartBarsCon   = jQuery('.js-chartjs-bars');
        let chartRadarCon  = jQuery('.js-chartjs-radar');
        let chartPolarCon  = jQuery('.js-chartjs-polar');
        let chartPieCon    = jQuery('.js-chartjs-pie');
        let chartDonutCon  = jQuery('.js-chartjs-donut');

        // Set Chart and Chart Data variables
        let chartLines, chartBars, chartRadar, chartPolar, chartPie, chartDonut;
        let chartLinesBarsRadarData, chartPolarPieDonutData;

        // Lines/Bar/Radar Chart Data
        chartLinesBarsRadarData = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(6, 101, 208, .75)',
                    borderColor: 'rgba(6, 101, 208, 1)',
                    pointBackgroundColor: 'rgba(6, 101, 208, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(6, 101, 208, 1)',
                    data: [34, 42, 62, 78, 39, 83, 98]
                },
                {
                    label: 'Last Week',
                    fill: true,
                    backgroundColor: 'rgba(108, 117, 125, .25)',
                    borderColor: 'rgba(108, 117, 125, .75)',
                    pointBackgroundColor: 'rgba(108, 117, 125, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(108, 117, 125, 1)',
                    data: [130, 95, 125, 160, 187, 110, 143]
                }
            ]
        };

        // Polar/Pie/Donut Data
        chartPolarPieDonutData = {
            labels: [
                'Earnings',
                'Sales',
                'Tickets'
            ],
            datasets: [{
                data: [
                    65,
                    15,
                    20
                ],
                backgroundColor: [
                    'rgba(141, 196, 81, 1)',
                    'rgba(255, 177, 25, 1)',
                    'rgba(224, 79, 26, 1)'
                ],
                hoverBackgroundColor: [
                    'rgba(141, 196, 81, .5)',
                    'rgba(255, 177, 25, .5)',
                    'rgba(224, 79, 26, .5)'
                ]
            }]
        };

        // Init Charts
        if (chartLinesCon.length) {
            chartLines = new Chart(chartLinesCon, { type: 'line', data: chartLinesBarsRadarData });
        }

        if (chartBarsCon.length) {
            chartBars  = new Chart(chartBarsCon, { type: 'bar', data: chartLinesBarsRadarData });
        }

        if (chartRadarCon.length) {
            chartRadar = new Chart(chartRadarCon, { type: 'radar', data: chartLinesBarsRadarData });
        }

        if (chartPolarCon.length) {
            chartPolar = new Chart(chartPolarCon, { type: 'polarArea', data: chartPolarPieDonutData });
        }

        if (chartPieCon.length) {
            chartPie   = new Chart(chartPieCon, { type: 'pie', data: chartPolarPieDonutData });
        }

        if (chartDonutCon.length) {
            chartDonut = new Chart(chartDonutCon, { type: 'doughnut', data: chartPolarPieDonutData });
        }
    }

    /*
    * Randomize Easy Pie Chart values
    *
    */
    static initRandomEasyPieChart() {
        jQuery('.js-pie-randomize').on('click', e => {
            jQuery(e.currentTarget)
                .parents('.block')
                .find('.pie-chart')
                .each((index, element) => jQuery(element).data('easyPieChart').update(Math.floor((Math.random() * 100) + 1)));
        });
    }

    /*
    * Init functionality
    *
    */
    static init() {
        this.initChartsChartJS();
        this.initRandomEasyPieChart();
    }
}

// Initialize when page loads
jQuery(() => { pageCompCharts.init(); });
