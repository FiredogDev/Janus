define([

	// deps
	'jquery',
	'common',
	'lodash',
	'gsap',

], function($, _c, _) {

	/** _____________________
	 *** Viewmore Constructor
	 **/
	var Viewmore = function(button) {
		var t = this,
			_c_s = _c.SELECTORS;

			t.button = button;

			t.setup_event_listeners();

			$.ajax({
				url: '/janus/wp-json/posts',
				dataType: 'json',
				// data: {category_name: 'insights'},
			})
			.done(function(res) {
				console.log(res);
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
	}




	Hoverboard.prototype.button = null;

	Hoverboard.prototype.setup_event_listeners = function(){
		t.button.on('click', function(){
			var incomming_posts = get_next_page_of_posts();
		});
	}

	Hoverboard.prototype.get_next_page_of_posts = function(){
		return "";
	}




	return Viewmore;

});