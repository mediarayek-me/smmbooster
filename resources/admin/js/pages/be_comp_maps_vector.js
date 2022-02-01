/*
 *  Document   : be_comp_maps_vector.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Vector Maps Page
 */

// Set default options for all maps
let mapOptions = {
    map: '',
    backgroundColor: '#ffffff',
    regionStyle: {
        initial: {
            fill: '#5c5c5c',
            'fill-opacity': 1,
            stroke: 'none',
            'stroke-width': 0,
            'stroke-opacity': 1
        },
        hover: {
            'fill-opacity': .8,
            cursor: 'pointer'
        }
    }
};

// jVectorMap, for more examples you can check out http://jvectormap.com/documentation/
class pageCompMapsVector {
    /*
     * Init World Map
     *
     */
    static initMapWorld() {
        // Set Active Map
        mapOptions['map'] = 'world_mill_en';

        // Init Map
        jQuery('.js-vector-map-world').vectorMap(mapOptions);
    }

    /*
     * Init Europe Map
     *
     */
    static initMapEurope() {
        // Set Active Map
        mapOptions['map'] = 'europe_mill_en';

        // Init Map
        jQuery('.js-vector-map-europe').vectorMap(mapOptions);
    }

    /*
     * Init USA Map
     *
     */
    static initMapUsa() {
        // Set Active Map
        mapOptions['map'] = 'us_aea_en';

        // Init Map
        jQuery('.js-vector-map-usa').vectorMap(mapOptions);
    }

    /*
     * Init India Map
     *
     */
    static initMapIndia() {
        // Set Active Map
        mapOptions['map'] = 'in_mill_en';

        // Init Map
        jQuery('.js-vector-map-india').vectorMap(mapOptions);
    }

    /*
     * Init China Map
     *
     */
    static initMapChina() {
        // Set Active Map
        mapOptions['map'] = 'cn_mill_en';

        // Init Map
        jQuery('.js-vector-map-china').vectorMap(mapOptions);
    }

    /*
     * Init Australia Map
     *
     */
    static initMapAustralia() {
        // Set Active Map
        mapOptions['map'] = 'au_mill_en';

        // Init Map
        jQuery('.js-vector-map-australia').vectorMap(mapOptions);
    }

    /*
     * Init South Africa Map
     *
     */
    static initMapSouthAfrica() {
        // Set Active Map
        mapOptions['map'] = 'za_mill_en';

        // Init Map
        jQuery('.js-vector-map-south-africa').vectorMap(mapOptions);
    }

    /*
     * Init France Map
     *
     */
    static initMapFrance() {
        // Set Active Map
        mapOptions['map'] = 'fr_mill_en';

        // Init Map
        jQuery('.js-vector-map-france').vectorMap(mapOptions);
    }

    /*
     * Init Germany Map
     *
     */
    static initMapGermany() {
        // Set Active Map
        mapOptions['map'] = 'de_mill_en';

        // Init Map
        jQuery('.js-vector-map-germany').vectorMap(mapOptions);
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initMapWorld();
        this.initMapEurope();
        this.initMapUsa();
        this.initMapIndia();
        this.initMapChina();
        this.initMapAustralia();
        this.initMapSouthAfrica();
        this.initMapFrance();
        this.initMapGermany();
    }
}

// Initialize when page loads
jQuery(() => { pageCompMapsVector.init(); });
