/*global define*/
'use strict';

define(['jquery'], function ($) {
	var BWC = BWC || {};
	return {

		// ENTER KEY CONST
		ENTER_KEY: 13,
		ESCAPE_KEY: 27,

		// GLOBAL SELECTORS
		SELECTORS: {
			windo: $(window),
			bdy: $('body'),
			primary_nav: $("#primary_nav"),
			main: $('main.main'),
		}
	};
});
