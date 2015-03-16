define([

	// deps
    'jquery'

], function ($) {

	var removeClassStartsWith = function(el, starts_with, include){
		var re = new RegExp("\\b"+starts_with+"\\S+","g");
		el.removeClass(function (index, css) {
			return (css.match (re) || []).join(' ');
		});
		if(include){ el.removeClass(include[0]); }
	}

    return removeClassStartsWith;

});