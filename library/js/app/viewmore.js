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
	}

	Viewmore.prototype.button = null;
	Viewmore.prototype.incomming_posts = null;

	Viewmore.prototype.setup_event_listeners = function(){
		var t = this,
			_c_s = _c.SELECTORS;
		// When button is clicked.
		t.button.on('click', function(){
			t.get_next_page_of_posts();
		});

		// Before send
		_c_s.windo.on('nextpage--beforesend', function(){
			console.log("Wait!!");
		});
		// On progress
		_c_s.windo.on('nextpage--progress', function(){
			console.log("Progress!!");
		});
		// On next page success
		_c_s.windo.on('nextpage--success', function(){
			console.log("Success!!");
		});
		// On next page fail
		_c_s.windo.on('nextpage--failed', function(){
			console.log("Failed!!");
		});
		// On next page complete
		_c_s.windo.on('nextpage--complete', function(){
			console.log("Complete!!");
		});
	}

	Viewmore.prototype.get_next_page_of_posts = function(){
		var t = this,
			_c_s = _c.SELECTORS;

		$.ajax({
			url: '/janus/wp-json/posts',
			dataType: 'json',
			data: {category_name: 'insights'},
			beforeSend: function( jqXHR ) {
				t.current_ready_state = jqXHR.readyState;
				_c_s.windo.trigger('nextpage--beforesend');
			},
			xhrFields: {
				onprogress: function (XHRProgressEvnt) {
					t.current_ready_state = XHRProgressEvnt.srcElement.readyState;
					_c_s.windo.trigger('nextpage--progress');
				},
			},
			
		})
		.done(function(result) {
			console.log(result);
			t.incomming_posts = result;
			_c_s.windo.trigger('nextpage--success');
		})
		.fail(function() {
			_c_s.windo.trigger('nextpage--failed');
		})
		.always(function() {
			_c_s.windo.trigger('nextpage--complete');
		});
	}

	return Viewmore;

});