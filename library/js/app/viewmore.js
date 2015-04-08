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

			// The button and it's fill layer
			t.button = button;
			t.button_fill = t.button.find('.viewmore__fill');

			// Setup 
			t.setup_button_event_handlers();
	}

	/**
	 * The viewmore button
	 * @type {jQuery Object}
	 */
	Viewmore.prototype.button = null;
	/**
	 * The viewmore button's fill layer
	 * @type {jQuery Object}
	 */
	Viewmore.prototype.button_fill = null;
	/**
	 * The result of the ajax call
	 * @type {JSON Object}
	 */
	Viewmore.prototype.incomming_posts = null;
	/**
	 * The current XHR ready state.
	 * @type {Number}
	 */
	Viewmore.prototype.current_ready_state = 0;

	/**
	 * Add click event listent to our button
	 */
	Viewmore.prototype.setup_button_event_handlers = function(){
		var t = this;
		// When the button is clicked...
		this.button.on('click', function(){
			// ...request next page of posts.
			t.get_next_page_of_posts();
		});
	}

	/**
	 * Request the next page of posts.
	 */
	Viewmore.prototype.get_next_page_of_posts = function(){
		var t = this,
			_c_s = _c.SELECTORS;

		// Ajax call for next page.
		$.ajax({
			url: '/janus/wp-json/posts',
			dataType: 'json',
			data: {category_name: 'insights'},
			beforeSend: t.onBeforeSend(t),
			xhrFields: {
				onprogress: function (XHRProgressEvnt) {
					t.onProgress(XHRProgressEvnt);
				},
			},
		})
		.done(function(result) {
			t.whenRequestSucceded(result);
		})
		.fail(function() {
			t.whenRequestFailed();
		})
		.always(function() {
			t.whenRequestComplete();
		});
	}

	/**
	 * On before XHR open is called
	 */
	Viewmore.prototype.onBeforeSend = function(that){
		// Temprarily disable button
		that.button.off('click');
		// Attach will-cahnge property to our fill layer.
		that.button_fill.css('will-change', 'transform');
		// Animate to 15% to indicate waiting for progress.
		TweenMax.to(that.button_fill, 10, {x: "15%", ease: Power3.easeOut});
	}

	/**
	 * On XHR progress update
	 * @param  {Object} XHRProgressEvnt The XHR progress event
	 */
	Viewmore.prototype.onProgress = function(XHRProgressEvnt){
		// Update the current ready state.
		this.current_ready_state = XHRProgressEvnt.srcElement.readyState;
		// Calculate the new fill position value.
		var fill = (this.current_ready_state * 25) - 100;
			fill += "%";
		// Animate fill to new position.
		TweenMax.to(this.button_fill, 1, {x: fill, ease: Power3.easeOut});
	}

	/**
	 * On successful requests
	 * @param  {Object} result JSON object containing result of request.
	 */
	Viewmore.prototype.whenRequestSucceded = function(result){
		// The result of the ajax request.
		this.incomming_posts = result;
		// console.log(result)
	}
	/**
	 * On failed requests
	 */
	Viewmore.prototype.whenRequestFailed = function(){}

	/**
	 * [whenRequestComplete description]
	 * @return {[type]} [description]
	 */
	Viewmore.prototype.whenRequestComplete = function(){
		var that = this,
			tl = new TimelineMax();
			// Animate fill move to end then fade out before reseting.
			tl.to(that.button_fill, 0.8, {x: "0%", ease: Power3.easeOut}, "move_to_end")
				.to(that.button_fill, 0.8, {opacity: 0, ease: Power3.easeOut}, "move_to_end+=0.2")
				.to(that.button_fill, 0, {x: "-100%", opacity: 1, 
					onComplete:function(){
						// on css state reset, re-attache button event listener.
						that.setup_button_event_handlers();
						// On animation complete remove will change property.
						that.button_fill.css('will-change', '');
					}
				});
	}

	return Viewmore;

});