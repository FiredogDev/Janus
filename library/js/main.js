/******************************************************************
File: Main
Author:

███████╗██╗██████╗ ███████╗██████╗  ██████╗  ██████╗
██╔════╝██║██╔══██╗██╔════╝██╔══██╗██╔═══██╗██╔════╝
█████╗  ██║██████╔╝█████╗  ██║  ██║██║   ██║██║  ███╗
██╔══╝  ██║██╔══██╗██╔══╝  ██║  ██║██║   ██║██║   ██║
██║     ██║██║  ██║███████╗██████╔╝╚██████╔╝╚██████╔╝
╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═════╝  ╚═════╝  ╚═════╝

******************************************************************/

/* Global Require */
'use strict';

// Global Namespace
var Frdg_App = Frdg_App || {};

require.config({
	paths: {
		fastclick: "../../bower_components/fastclick/lib/fastclick",
		jquery: "../../bower_components/jquery/dist/jquery",
		lodash: "../../bower_components/lodash/lodash",
		qunit: "../../bower_components/qunit/qunit/qunit",
		requirejs: "../../bower_components/requirejs/require",
		slick: "../../bower_components/slick.js/slick/slick.min",
		gsap: "../../bower_components/gsap/src/uncompressed/TweenMax",
		text: "../../bower_components/requirejs-text/text",
		moment: "../../bower_components/moment/moment",
		"requirejs-text": "../../bower_components/requirejs-text/text"
	},
	packages: [

	]
});

require(['common', 'jquery', 'lodash', 'fastclick'], function (_c, $, _) {

	// Common Selectors:
	var _c_s = _c.SELECTORS;
	
	// Primary Navigation
	var nav__toggle = $('.nav__toggle');
		nav__toggle.on('click', function(){
			_c_s.bdy.toggleClass('is--open__primary-nav');
		});


	// Hoverboard
	var $hoverboard = $(".hoverboard");
	if($hoverboard.length){
		require(['app/hoverboard'], function (hoverboard) {

			_.forEach($hoverboard, function(board, key){
				new hoverboard($(board));
			});

		});

	}


	// Viewmore Posts Button
	var $viewmoreButtons = $(".viewmore");
	if($viewmoreButtons.length){
		require(['app/viewmore'], function (viewmore) {
			_.forEach($viewmoreButtons, function(button, key){
				new viewmore($(button));
			});
		});
	}



});
