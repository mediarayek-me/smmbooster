/*
 *  Document   : db_analytics.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Analytics Dashboard Page
 */
const weeks = ["MON","TUE","WED","THU","FRI","SAT","SUN"];
const months = ['December', 'November', 'October', 'September', 'August', 'July', 'June', 'May', 'April', 'March', 'February', 'January'].reverse();
class pageDashboardAnalytics {
    /*
     * Chart.js, for more examples you can check out http://www.chartjs.org/docs
     *
     */
    static initChartsBars(weeks_data,months_data) {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#495057';
        Chart.defaults.scale.gridLines.color                = 'transparent';
        Chart.defaults.scale.gridLines.zeroLineColor        = 'transparent';
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 1;
        Chart.defaults.global.legend.labels.boxWidth        = 12;

        // Get Chart Containers
        let chartBarsCon1 = jQuery('.js-chartjs-analytics-bars-weeks');
        let chartBarsCon2 = jQuery('.js-chartjs-analytics-bars-months');

        // Set Chart and Chart Data variables
        let chartLinesBarsData1,chartLinesBarsData2;

        // Bars Chart Data
        chartLinesBarsData1 = {
            labels: weeks,
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: '#82b54b',
                    borderColor: '#82b54b',
                    pointBackgroundColor: 'rgba(103, 114, 229, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(103, 114, 229, 1)',
                   // data: [500, 750, 650, 570, 582, 480, 580]
                    data: weeks_data
                },
               
            ]
        };
        // Bars Chart Data
        chartLinesBarsData2 = {
            labels: months,
            datasets: [
                {
                    label: 'This Year',
                    fill: true,
                    backgroundColor: '#ffb119',
                    borderColor: '#ffb119',
                    pointBackgroundColor: 'rgba(103, 114, 229, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(103, 114, 229, 1)',
                   // data: [500, 750, 650, 570, 582, 480, 680, 750, 650, 570, 582, 480, 680]
                    data:months_data
                },
               
            ]
        };

        // Init Chart
        if (chartBarsCon1.length) {
             new Chart(chartBarsCon1, { type: 'bar', data: chartLinesBarsData1 });
             jQuery('.js-chartjs-analytics-bars-weeks').parent().find('.loading').hide()
        }

        // Init Chart
        if (chartBarsCon2.length) {
             new Chart(chartBarsCon2, { type: 'bar', data: chartLinesBarsData2 });
             jQuery('.js-chartjs-analytics-bars-months').parent().find('.loading').hide()
        }
    }

    /*
     * Init functionality
     *
     */
    static init() {
        axios.get('/admin/dashboard/get-chart-profit').then(res=>{
            this.initChartsBars(res.data.weekProfit,res.data.yearProfit);
        })
    }
}

// Initialize when page loads
jQuery(() => { pageDashboardAnalytics.init(); });
