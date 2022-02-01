/*
 *  Document   : db_crypto.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Crypto Dashboard Page
 */

class pageDashboardCrypto {
    /*
     * Chart.js, for more examples you can check out http://www.chartjs.org/docs
     *
     */
    static initChartsBitcoin() {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = 'rgba(0,0,0,.75)';
        Chart.defaults.scale.gridLines.color                = 'transparent';
        Chart.defaults.scale.gridLines.zeroLineColor        = 'transparent';
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 2;
        Chart.defaults.global.elements.point.radius         = 0;
        Chart.defaults.global.elements.point.hoverRadius    = 0;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.display                = false;

        // Get Chart Container
        let chartBitcoinCon  = jQuery('.js-chartjs-bitcoin');

        // Set up labels
        let chartBitcoinlabels = [];
        for (let i = 0; i < 30; i++) {
            chartBitcoinlabels[i] = (i === 29) ? '1 day ago' : (30 - i) + ' days ago';
        }

        // Crypto Data
        let chartBitcoinData  = [10500, 10400, 9500, 8268, 10218, 8250, 8707, 9284, 9718, 9950, 9879, 10147, 10883, 11071, 11332, 11584, 11878, 13540, 16501, 16007, 15142, 14869, 16762, 17276, 16808, 16678, 16771, 12900, 13100, 14000];

        // Init Chart
        let chartBitcoin = new Chart(chartBitcoinCon, {
            type: 'line',
            data: {
                labels: chartBitcoinlabels,
                datasets: [
                    {
                        label: 'Bitcoin Price',
                        fill: true,
                        backgroundColor: 'rgba(255,193,7,.25)',
                        borderColor: 'rgba(255,193,7,1)',
                        pointBackgroundColor: 'rgba(255,193,7,1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(255,193,7,1)',
                        data: chartBitcoinData
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 6000,
                            suggestedMax: 20000
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
            }
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initChartsBitcoin();
    }
}

// Initialize when page loads
jQuery(() => { pageDashboardCrypto.init(); });
