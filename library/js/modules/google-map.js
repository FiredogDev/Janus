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
		this.mapOptions = {
          	center: this.lnglat,
          	zoom: 17,
          	minZoom: 10,
          	mapTypeControlOptions: {
			  mapTypeIds: [google.maps.MapTypeId.ROADMAP, that.FIREDOG_MAPTYPE]
			},
			mapTypeId: that.FIREDOG_MAPTYPE
        };



        // Init Map
        this.initialize();

	}

	/**
	 * The map container
	 * @type {Object}
	 */
	GoogleMap.prototype.map_canvas = null;
	GoogleMap.prototype.map = null;
	GoogleMap.prototype.lnglat = {};
	GoogleMap.prototype.map_styles = [];
	GoogleMap.prototype.styled_map_options = {};
	GoogleMap.prototype.mapOptions = {}

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
	GoogleMap.prototype.initialize = function() {
        this.map = new google.maps.Map(this.map_canvas[0], this.mapOptions);
        this.map.panBy(-300,0);

        // Set custom map styles
		this.style_map();

		console.log(this.marker_icon);

		var marker = new google.maps.Marker({
		      position: this.lnglat,
		      title: this.map_title,
		      icon: this.marker_icon
		  });

         marker.setMap(this.map);
    }

	return GoogleMap;

});