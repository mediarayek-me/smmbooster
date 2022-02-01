/*
 *  Document   : be_comp_maps_google.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Google Maps Page
 */

// Gmaps.js, for more examples you can check out https://hpneo.github.io/gmaps/
class pageCompMapsGoogle {
    /*
     * Init Search Map functionality
     *
     */
    static initMapSearch() {
        if (jQuery('#js-map-search').length) {
            // Init Map
            let mapSearch = new GMaps({
                div: '#js-map-search',
                lat: 20,
                lng: 0,
                zoom: 2,
                scrollwheel: false
            });

            // When the search form is submitted
            jQuery('.js-form-search').on('submit', e => {
                let inputGroup = jQuery('.js-search-address').parent('.input-group');

                GMaps.geocode({
                    address: jQuery('.js-search-address').val().trim(),
                    callback: (results, status) => {
                        if ((status === 'OK') && results) {
                            let latlng = results[0].geometry.location;

                            mapSearch.removeMarkers();
                            mapSearch.addMarker({ lat: latlng.lat(), lng: latlng.lng() });
                            mapSearch.fitBounds(results[0].geometry.viewport);

                            inputGroup.siblings('.form-text').remove();
                        } else {
                            inputGroup.after('<div class="font-text text-danger text-center animated fadeInDown">Address not found!</div>')
                        }
                    }
                });

                return false;
            });
        }
    }

    /*
     * Init Satellite Map
     *
     */
    static initMapSat() {
        if (jQuery('#js-map-sat').length) {
            new GMaps({
                div: '#js-map-sat',
                lat: 20,
                lng: 0,
                zoom: 2,
                scrollwheel: false
            }).setMapTypeId(google.maps.MapTypeId.SATELLITE);
        }
    }

    /*
     * Init Terrain Map
     *
     */
    static initMapTer() {
        if (jQuery('#js-map-ter').length) {
            new GMaps({
                div: '#js-map-ter',
                lat: 20,
                lng: 0,
                zoom: 2,
                scrollwheel: false
            }).setMapTypeId(google.maps.MapTypeId.TERRAIN);
        }
    }

    /*
     * Init Overlay Map
     *
     */
    static initMapOverlay() {
        if (jQuery('#js-map-overlay').length) {
            new GMaps({
                div: '#js-map-overlay',
                lat: 48.8566,
                lng: 2.3522,
                zoom: 10,
                scrollwheel: false
            }).drawOverlay({
                lat: 48.8566,
                lng: 2.3522,
                content: '<div class="alert alert-warning text-center" style="width: 280px;"><h4 class="alert-heading mb-2">Message</h4><p class="font-size-sm font-w600 mb-0">You can overlay messages on your maps!</p></div>'
            });
        }
    }

    /*
     * Init Markers Map
     *
     */
    static initMapMarkers() {
        if (jQuery('#js-map-markers').length) {
            new GMaps({
                div: '#js-map-markers',
                lat: 48.8566,
                lng: 2.3522,
                zoom: 11,
                scrollwheel: false
            }).addMarkers([
                {lat: 48.79, lng: 2.31, title: 'Map Marker #1', animation: google.maps.Animation.DROP, infoWindow: {content: 'Map Marker #1'}},
                {lat: 48.88, lng: 2.42, title: 'Map Marker #2', animation: google.maps.Animation.DROP, infoWindow: {content: 'Map Marker #2'}},
                {lat: 48.90, lng: 2.36, title: 'Map Marker #3', animation: google.maps.Animation.DROP, infoWindow: {content: 'Map Marker #3'}},
                {lat: 48.79, lng: 2.39, title: 'Map Marker #4', animation: google.maps.Animation.DROP, infoWindow: {content: 'Map Marker #4'}},
                {lat: 48.77, lng: 2.44, title: 'Map Marker #5', animation: google.maps.Animation.DROP, infoWindow: {content: 'Map Marker #5'}}
            ]);
        }
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initMapSearch();
        this.initMapSat();
        this.initMapTer();
        this.initMapOverlay();
        this.initMapMarkers();
    }
}

// Initialize when page loads
jQuery(() => { pageCompMapsGoogle.init(); });
