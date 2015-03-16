define([

	// deps
	'jquery',

], function ($){

	var getClassStartsWith = function (elem, prefix){
		
		var expression = new RegExp("\\b"+prefix+"\\S+","g");
			return elem.attr('class').match(expression);

	}

	return getClassStartsWith;

});