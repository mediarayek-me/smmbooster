/*
 *  Document   : db_gaming.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Gaming Dashboard Page
 */

class pageDashboardGaming {
    /*
     * Example of how to live update already initialized Sparklines Charts
     *
     */
    static initLiveSparklines() {
        // Set Options
        this._updateCpuInterval = 1000;
        this._updateRamInterval = 3000;

        // Contextual colors
        this._normalColor   = '#9c9c9c';
        this._normalFill    = 'rgba(0,0,0,.05)';
        this._warningColor  = '#ffb119';
        this._warningFill   = 'rgba(255,177,25,.1)';
        this._dangerColor   = '#de4f28';
        this._dangerFill    = 'rgba(224,79,26,.1)';

        // Get chart and info elements
        this._chartCpu        = jQuery('#dm-gaming-sl-cpu');
        this._chartCpuCurrent = jQuery('#dm-gaming-sl-cpu-current');
        this._chartRam        = jQuery('#dm-gaming-sl-ram');
        this._chartRamCurrent = jQuery('#dm-gaming-sl-ram-current');
    }

    /*
     * Updates CPU Chart with a new value
     *
     */
    static updateChartCpu() {
        let self = this;

        // Helper variables
        let cpuData     = self._chartCpu.data('points');
        let lastItem    = cpuData[cpuData.length - 1];

        // Here you could get a real world value (we get a random one for demonstration)
        let newValue    = self.getRandomInt(15, 85);

        // Remove first element and add the new value
        cpuData.shift();
        cpuData.push(newValue);

        // Set new color to chart options based on the new value
        if (newValue >= 0 && newValue <= 33) {
            // Normal colors
            self._chartCpu
                .data('line-color', self._normalColor)
                .data('fill-color', self._normalFill)
                .data('highlight-spot-color', self._normalColor)
                .data('highlight-line-color', self._normalColor);
        } else if (newValue > 33 && newValue <= 66) {
            // Warning colors
            self._chartCpu
                .data('line-color', self._warningColor)
                .data('fill-color', self._warningFill)
                .data('highlight-spot-color', self._warningColor)
                .data('highlight-line-color', self._warningColor);
        } else {
            // Danger colors
            self._chartCpu
                .data('line-color', self._dangerColor)
                .data('fill-color', self._dangerFill)
                .data('highlight-spot-color', self._dangerColor)
                .data('highlight-line-color', self._dangerColor);
        }

        // Reinit Sparklines with helper
        self._chartCpu.removeClass('js-sparkline-enabled').data('points', cpuData);
        Dashmix.helpers('sparkline');

        // Update current value
        self._chartCpuCurrent.text(newValue);

        // Rerun after second
        setTimeout(() => self.updateChartCpu(), self._updateCpuInterval);
    }

    /*
     * Updates CPU Chart with a new value
     *
     */
    static updateChartRam() {
        let self = this;

        // Helper variables
        let ramData     = this._chartRam.data('points');
        let lastItem    = ramData[ramData.length - 1];

        // Here you could get a real world value (we get a random one for demonstration)
        let newValue    = self.getRandomInt(150, 850);

        // Remove first element and add the new value
        ramData.shift();
        ramData.push(newValue);

        // Set new color to chart options based on the new value
        if (newValue >= 0 && newValue <= 330) {
            // Normal colors
            self._chartRam
                .data('line-color', self._normalColor)
                .data('fill-color', self._normalFill)
                .data('highlight-spot-color', self._normalColor)
                .data('highlight-line-color', self._normalColor);
        } else if (newValue > 330 && newValue <= 660) {
            // Warning colors
            self._chartRam
                .data('line-color', self._warningColor)
                .data('fill-color', self._warningFill)
                .data('highlight-spot-color', self._warningColor)
                .data('highlight-line-color', self._warningColor);
        } else {
            // Danger colors
            self._chartRam
                .data('line-color', self._dangerColor)
                .data('fill-color', self._dangerFill)
                .data('highlight-spot-color', self._dangerColor)
                .data('highlight-line-color', self._dangerColor);
        }

        // Reinit Sparklines with helper
        self._chartRam.removeClass('js-sparkline-enabled').data('points', ramData);
        Dashmix.helpers('sparkline');

        // Update current value
        self._chartRamCurrent.text(newValue);

        // Rerun after second
        setTimeout(() => self.updateChartRam(), self._updateRamInterval);
    }

    /**
     * Get a random integer between `min` and `max`.
     *
     */
    static getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initLiveSparklines();

        // Start updating charts
        this.updateChartCpu();
        this.updateChartRam();
    }
}

// Initialize when page loads
jQuery(() => { pageDashboardGaming.init(); });
