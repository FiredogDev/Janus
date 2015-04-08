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
			t.button_fill = t.button.find('.viewmore__fill');

			t.setup_button_event_handlers();
	}

	Viewmore.prototype.button = null;
	Viewmore.prototype.button_fill = null;
	Viewmore.prototype.incomming_posts = null;
	Viewmore.prototype.current_ready_state = 0;

	Viewmore.prototype.setup_button_event_handlers = function(){
		var t = this;
		// When button is clicked.
		this.button.on('click', function(){
			// Get posts
			t.get_next_page_of_posts();
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
				// Temprarily disable button
				t.button.off('click');

				t.current_ready_state = jqXHR.readyState;
				console.log("Wait!!");
				t.button_fill.css('will-change', 'transform');
				TweenMax.to(t.button_fill, 5, {x: "15%", ease: Power3.easeOut});
			},
			xhrFields: {
				onprogress: function (XHRProgressEvnt) {
					t.current_ready_state = XHRProgressEvnt.srcElement.readyState;
					
					console.log("Progress!!");
					var fill = (t.current_ready_state * 25) - 100;
						fill += "%";
					TweenMax.to(t.button_fill, 1, {x: fill, ease: Power3.easeOut});
				},
			},
		})
		.done(function(result) {
			console.log(result);
			t.incomming_posts = result;
			console.log("Success!!");
		})
		.fail(function() {
			console.log("Failed!!");
		})
		.always(function() {
			console.log("Complete!!");
			var tl = new TimelineMax();
			tl.to(t.button_fill, 0.8, {x: "0%", ease: Power3.easeOut}, "move_to_end")
				.to(t.button_fill, 0.8, {opacity: 0, ease: Power3.easeOut}, "move_to_end+=0.2")
				.to(t.button_fill, 0, {x: "-100%", opacity: 1, 
					onComplete:function(){
						t.setup_button_event_handlers();
					}
				});
			t.button_fill.css('will-change', '');
		});
	}


	return Viewmore;

});