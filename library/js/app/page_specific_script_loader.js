define([

	// deps
	'common',
    'utils/getClassStartsWith'

], function (_c, getClassStartsWith) {
	
	var _c_s = _c.SELECTORS,
		page_template_class = getClassStartsWith(_c_s.bdy, 'page-template-').toString().trim();

		require(['page/'+page_template_class]);

});