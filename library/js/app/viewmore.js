define([

	// deps
	'jquery',
	'common',
	'lodash',
	'moment',
	'text!templates/hentry-post--as-row.html',
	'gsap',

], function($, _c, _, moment, post_as_row_tmpl) {

	/**  ____________________
	 *** Viewmore Constructor
	 **/
	var Viewmore = function(button) {
		var that = this,
			_c_s = _c.SELECTORS;

			// The button, it's label and it's fill layer
			this.button = button;
			this.button_label = this.button.find('.viewmore__btn__label');
			this.button_fill = this.button.find('.viewmore__fill');
			this.query_args = this.button.data('args');

			// Build the parameter string
			this.build_parameter_string(this.query_args);

			// Setup event handlers
			this.setup_button_event_handlers();
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
	 * Current Page
	 * @type {Number}
	 */
	Viewmore.prototype.current_page_number = 1;

	/**
	 * The number of posts returned
	 * @type {Number}
	 */
	Viewmore.prototype.number_of_results = 0;


	/**
	 * Build the parameter string for wp query.
	 * @param  {Object} args The arguments of the query
	 */
	Viewmore.prototype.build_parameter_string = function(args){
		var that = this;
		this.query_param_string = "";
		_.forEach(args, function(argument, key, collection){
			that.query_param_string += "filter["+key+"]="+argument+"&";
		});
	}

	/**
	 * Return the next page number
	 */
	Viewmore.prototype.get_next_page_number = function(){
		this.current_page_number++
		return this.current_page_number;
	}

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
			url: '/janus/wp-json/posts?'+that.query_param_string+"page="+that.get_next_page_number(),
			dataType: 'json',
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
		console.log(this.postsRemaining());
		if(this.postsRemaining()){
			// Append the compiled templates to the pages.
			this.appendCompiledTemplate(_.template(post_as_row_tmpl));
		}
	}

	/**
	 * On failed requests
	 */
	Viewmore.prototype.whenRequestFailed = function(){}

	/**
	 * On request completed
	 */
	Viewmore.prototype.whenRequestComplete = function(){
		var that = this,
			tmln = new TimelineMax();

			if(this.postsRemaining()){
				// Animate fill move to end then fade out before reseting.
				tmln.to(that.button_fill, 0.8, {x: "0%", ease: Power3.easeOut}, "move_to_end")
					// ...fade out fill...
					.to(that.button_fill, 0.8, {opacity: 0, ease: Power3.easeOut}, "move_to_end+=0.2")
					/// ...fade out entire button...
					.to(that.button, 0.6, {opacity: 0, ease: Power3.easeOut,
						onComplete: function(){
							// Appeand html before the viewmore button.
							that.button.before(that.incoming_posts_html);
							that.incoming_posts_html = "";
							// on css state reset, re-attach button event listener.
							that.setup_button_event_handlers();
							// On animation complete remove will change property.
							that.button_fill.css('will-change', '');
						}
					}, "move_to_end+=0.65")
					.to(that.button_fill, 0, {x: "-100%", opacity: 1, })
					.to(that.button, 0, {opacity: 1, });
			}else{
				// Animate fill position and color to indicate last page/error
				tmln.to(that.button_fill, 0.8, {x: "-40%", backgroundColor: "red", ease: Power3.easeOut, 
						onStart: function(){
							that.button_label.text("END OF THE LINE!").css('cursor', 'default');
							// that.button_label;
						}
					}, "no_posts")
					// ...fade out fill...
					.to(that.button_fill, 0.8, {x: "-100%", opacity: 0, ease: Power3.easeOut}, "no_posts+=0.4")
					/// ...fade out entire button...
					.to(that.button, 0.8, {opacity: 0, ease: Power3.easeOut,
						onComplete: function(){
							// On animation complete remove will change property.
							that.button_fill.css('will-change', '');
							that.button.css('display', 'none');
						}
					}, "+2");
			}
	}

	/**
	 * Check to see if we've reached the last page
	 * @return {Boolean}             Are there posts remaining?
	 */
	Viewmore.prototype.postsRemaining = function(){
		var numberOfPosts = this.incoming_posts.length;
		if(numberOfPosts < this.query_args.posts_per_page)
			{ return false; }
		else
			{ return true; }
	}

	/**
	 * Append compiled templates to page.
	 */
	Viewmore.prototype.appendCompiledTemplate = function(compiled){
		var that = this;
		// For each post/result...
		_.forEach(this.incoming_posts, function(post, key, posts){
			// ...concat compiled html from lodash template.
			that.incoming_posts_html += compiled(that.filterPost(post));
		});
	}

	/**
	 * Make changes to the returned post object.
	 * @param  {Object} post A single post JSON object.
	 * @return {Object}      The filtered post.
	 */
	Viewmore.prototype.filterPost = function(post){
		// ...check for a featured image...
		if(post.featured_image)
			{ post.hasPostThumb = "has-post-thumbnail"; }
		else
			{ post.hasPostThumb = ""; }

		// Date formatting...
		post.displayDate = moment(post.date, moment.ISO_8601).format("DD.MM.YY"); // 04.03.15

		// return filtered post
		return post;
	}




	Viewmore.prototype.noMorePosts = function(){
		console.log("no more posts!");
		var that = this;
		TweenMax.to(that.button, 0.8, {opacity: 0, ease:Power3.easeOut, 
			onComplete: function(){
				console.log("Complete!");
				that.button_fill.css('will-change', '');
				that.button.css('display', 'none');
			}
		});
	}

	return Viewmore;

});