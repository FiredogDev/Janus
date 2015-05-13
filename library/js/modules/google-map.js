define([
	// deps
	'common',
	'jquery',
	'async!https://maps.googleapis.com/maps/api/js?key=AIzaSyDa4gB8gtCJpl--da-KKvV5UoMluxMcvVM&amp;sensor=false'

], function(_c, $) {

	'use strict';

	/**  ____________________
	 *** GoogleMap Constructor
	 **/
	var GoogleMap = function(canvas, lnglat, title, marker_icon) {
		var that = this,
			_c_s = _c.SELECTORS;

		// Map Canvas
		this.map_canvas = canvas;
		// Lat Lng
		this.lnglat = new google.maps.LatLng(lnglat.lat,lnglat.lng);

		this.map_title = title;
		this.marker_icon = marker_icon;

		// Set map options
		this.FIREDOG_MAPTYPE = 'firedog_map_style';
		this.map_options = {
			backgroundColor:"#1f1f1f",
          	center: this.lnglat,
          	zoom: 17,
          	minZoom: 13,
          	disableDefaultUI: true,
          	mapTypeControlOptions: {
			  mapTypeIds: [google.maps.MapTypeId.ROADMAP, that.FIREDOG_MAPTYPE]
			},
			mapTypeId: that.FIREDOG_MAPTYPE
        };

        // Init Map & Street View
        this.initialize();
        this.initialize_street_view();

	}

	/**
	 * The map container
	 * @type {Object}
	 */
	GoogleMap.prototype.map_canvas = null;
	/**
	 * Google map options
	 * @type {Object}
	 */
	GoogleMap.prototype.map_options = {}
	/**
	 * The google map object
	 * @type {Object}
	 */
	GoogleMap.prototype.map = null;
	/**
	 * Google street view options
	 * @type {Object}
	 */
	GoogleMap.prototype.street_view_options = {}
	/**
	 * The google street view object
	 * @type {Object}
	 */
	GoogleMap.prototype.street_view = null;
	/**
	 * The Longitude & Latitude
	 * @type {Object}
	 */
	GoogleMap.prototype.lnglat = {};
	/**
	 * Map styles
	 * @type {Array}
	 */
	GoogleMap.prototype.map_styles = [];
	/**
	 * Styled map options
	 * @type {Object}
	 */
	GoogleMap.prototype.styled_map_options = {};
	

	/**
	 * Set map styles.
	 */
	GoogleMap.prototype.style_map = function() {
		
		// Map styles - from http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html
		this.map_styles = [
			{
		    	"stylers": [
		      		{ "invert_lightness": true },
		      		{ "saturation": -100 }
		    	]
		  	}
		];
		this.styled_map_options = { name: 'Firedog Map Style' };
		var custom_styled_map_type = new google.maps.StyledMapType(this.map_styles, this.styled_map_options);
		this.map.mapTypes.set(this.FIREDOG_MAPTYPE, custom_styled_map_type);
	}

	/**
	 * Init google map
	 */
	GoogleMap.prototype.initialize = function() {
        this.map = new google.maps.Map(this.map_canvas[0], this.map_options);
        this.map.panBy(-300,0);

        // Set custom map styles
		this.style_map();

		var marker = new google.maps.Marker({
		    position: this.lnglat,
		    title: this.map_title,
		    icon: this.marker_icon
		});

        marker.setMap(this.map);
    }

    /**
     * Init street view
     */
    GoogleMap.prototype.initialize_street_view = function() {
    	var that = this;

    	var directionsService = new google.maps.DirectionsService(),
    		directionsDisplay = new google.maps.DirectionsRenderer({
    			preserveViewport: true,
    			suppressMarkers: true,
    			polylineOptions: {
			      strokeColor: "#c70000",
			      strokeOpacity: 0.5,
			      strokeWeight: 6
			    }
    		});

    	directionsDisplay.setMap(this.map);
    		
		this.street_view_options = {
			enableCloseButton: false,
			addressControl:false,
			panControl: true,
			zoomControl: false,
			position: this.lnglat,
			pov: {
				heading: 180,
				pitch: 10
			},
			zoom: 1
		};
  		this.street_view = new google.maps.StreetViewPanorama(document.getElementById('street-view-canvas'), this.street_view_options);
  		this.street_view.setVisible(true);

  		google.maps.event.addListener(this.street_view, 'position_changed', function() {
		    var request = {
			      origin: that.street_view.getPosition(),
			      destination: that.lnglat,
			      travelMode: google.maps.TravelMode.WALKING,
			      optimizeWaypoints: true,
			};

			directionsService.route(request, function(response, status) {
			    if (status == google.maps.DirectionsStatus.OK) {
			      directionsDisplay.setDirections(response);
			    }
			});
		});
	}

	return GoogleMap;

});