define([

	// deps
	'jquery',
	'common',
	'lodash',
	'text!templates/hentry-post--as-row.html',
	'gsap',

], function($, _c, _, post_as_row_tmpl) {

	/**  ____________________
	 *** Viewmore Constructor
	 **/
	var Viewmore = function(button) {
		var that = this,
			_c_s = _c.SELECTORS;

			// The button, it's label and it's fill layer
			that.button = button;
			that.button_label = that.button.find('.viewmore__btn__label');
			that.button_fill = that.button.find('.viewmore__fill');

			// Setup 
			that.setup_button_event_handlers();
	}

	/**
	 * The viewmore button
	 * @type {Object}
	 */
	Viewmore.prototype.button = null;
	/**
	 * The viewmore button's fill layer
	 * @type {Object}
	 */
	Viewmore.prototype.button_fill = null;
	/**
	 * The result of the ajax call
	 * @type {Object}
	 */
	Viewmore.prototype.incoming_posts = null;
	/**
	 * Compiled html of new posts
	 * @type {String}
	 */
	Viewmore.prototype.incoming_posts_html = "";

	/**
	 * The current XHR ready state.
	 * @type {Number}
	 */
	Viewmore.prototype.current_ready_state = 0;



	/**
	 * Add click event listent to our button
	 */
	Viewmore.prototype.setup_button_event_handlers = function(){
		var that = this;
		// When the button is clicked...
		this.button_label.on('click', function(){
			// ...request next page of posts.
			that.get_next_page_of_posts();
		});
	}

	/**
	 * Request the next page of posts.
	 */
	Viewmore.prototype.get_next_page_of_posts = function(){
		var that = this,
			_c_s = _c.SELECTORS;

		// Ajax call for next page.
		$.ajax({
			url: '/janus/wp-json/posts',
			dataType: 'json',
			data: {category_name: 'insights'},
			beforeSend: that.onBeforeSend(that),
			xhrFields: {
				onprogress: function (XHRProgressEvnt) {
					that.onProgress(XHRProgressEvnt);
				},
			},
		})
		.done(function(result) {
			that.whenRequestSucceeded(result);
		})
		.fail(function() {
			that.whenRequestFailed();
		})
		.always(function() {
			that.whenRequestComplete();
		});
	}

	/**
	 * On before XHR open is called
	 */
	Viewmore.prototype.onBeforeSend = function(that){
		// Temprarily disable button
		that.button_label.off('click');
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
	Viewmore.prototype.whenRequestSucceeded = function(results){
		// The result of the ajax request.
		this.incoming_posts = results;
		// console.log(result)
		var html = "",
			compiled_tmpl = _.template(post_as_row_tmpl);
		console.log("test");
		// Append the compiled templates to the pages.
		this.appendCompiledTemplate(compiled_tmpl);
	}
	/**
	 * On failed requests
	 */
	Viewmore.prototype.whenRequestFailed = function(){

	}

	
	Viewmore.prototype.whenRequestComplete = function(){
		var that = this,
			tmln = new TimelineMax();
			// Animate fill move to end then fade out before reseting.
			tmln.to(that.button_fill, 0.8, {x: "0%", ease: Power3.easeOut}, "move_to_end")
				// ...fade out fill...
				.to(that.button_fill, 0.8, {opacity: 0, ease: Power3.easeOut}, "move_to_end+=0.2")
				/// ...fade out entire button...
				.to(that.button, 0.6, {opacity: 0, ease: Power3.easeOut,
					onComplete: function(){
						// Appeand html before the viewmore button.
						// that.button.before(that.incoming_posts_html);
						// that.incoming_posts_html = "";
						// on css state reset, re-attach button event listener.
						that.setup_button_event_handlers();
						// On animation complete remove will change property.
						that.button_fill.css('will-change', '');
					}
				}, "move_to_end+=0.65")
				.to(that.button_fill, 0, {x: "-100%", opacity: 1, })
				.to(that.button, 0, {opacity: 1, });
	}

	/**
	 * Append compiled templates to page.
	 */
	Viewmore.prototype.appendCompiledTemplate = function(compiled){

		var that = this;
		console.log(this.incoming_posts);
		// For each post/result...
		// _.forEach(this.incoming_posts, function(post, key, posts){
		// 	console.log(post);
		// 	// ...check for a featured image...
		// 	post.hasPostThumb = "no-post-thumbnail";
		// 	if(post.featured_image){
		// 		post.hasPostThumb = "has-post-thumbnail";
		// 	}
		// 	// ...concat compiled html from lodash template.
		// 	that.incoming_posts_html += compiled(post);
		// });

	}

	return Viewmore;

});