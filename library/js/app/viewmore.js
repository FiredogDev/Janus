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
			
			// WP Query Args
			this.query_args = this.button.data('args');
			// Posts to exclude;
			this.posts_to_exclude = sticky_posts;

			// Build the parameter string
			this.build_parameter_string();
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
	 */
	Viewmore.prototype.build_parameter_string = function(){
		var that = this;
		this.query_param_string = "";

		// Add arguments tot param string...
		_.forEach(this.query_args, function(argument, key, collection){
			that.query_param_string += "filter["+key+"]="+argument+"&";
		});

		if(sticky_posts.length > 0){
			// Build the 'exclude posts' list.
			this.build_exclude_array();	
		}
	}

	Viewmore.prototype.build_exclude_array = function(){
		var that = this;
		_.forEach(this.posts_to_exclude, function(value, key){
			that.query_param_string += "filter[post__not_in][]="+value+"&";
		});
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
			_c_s = _c.SELECTORS,
			query_url = '/janus/wp-json/posts?' + this.query_param_string +
						"page=" + that.get_next_page_number();
		
		// Ajax call for next page.
		$.ajax({
			url: query_url,
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
	 * Return the next page number
	 */
	Viewmore.prototype.get_next_page_number = function(){
		this.current_page_number++
		return this.current_page_number;
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
		var tmln = new TimelineMax();
		tmln.to(that.button_fill, 0.8, {opacity: 1, ease: Power3.easeOut}, "start_fill")
			.to(that.button_fill, 20, {x: "15%", ease: Power3.easeOut}, "start_fill-=0.1");
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

		// If there are more results to come...
		if(this.postsRemaining()){
			// Append the compiled templates to the pages.
			this.appendCompiledTemplate(_.template(post_as_row_tmpl));
			this.successfulCompletionAnimation();
		// If there are no more posts after this page...
		}else{
			// ... indicate last page then hide button.
			this.unsuccessfulCompletionAnimation("END OF THE LINE!", true);
		}
	}

	/**
	 * On failed requests
	 */
	Viewmore.prototype.whenRequestFailed = function(){
		this.unsuccessfulCompletionAnimation("Something's gone horribly wrong! I'm outta here.");
	}

	/**
	 * On request completed
	 */
	Viewmore.prototype.whenRequestComplete = function(){}

	/**
	 * The button animation to occur when request is successfully completed	 
	 */
	Viewmore.prototype.successfulCompletionAnimation = function(){
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
					that.button.before(that.incoming_posts_html);
					that.incoming_posts_html = "";
					// on css state reset, re-attach button event listener.
					that.setup_button_event_handlers();
					// On animation complete remove will change property.
					that.button_fill.css('will-change', '');
				}
			}, "move_to_end+=0.65")
			.to(that.button_fill, 0, {x: "-100%", opacity: 0, })
			.to(that.button, 0, {opacity: 1, });
	}
	
	/**
	 * The button animation to occur when request is unsuccessfully completed.
	 * @param  {String} reason                  The message to appear explaining the failure.
	 * @param  {Boolean} button_should_disappear Should this button dissappear after the message.
	 */
	Viewmore.prototype.unsuccessfulCompletionAnimation = function(reason, button_should_disappear){

		var that = this,
			button_should_disappear = button_should_disappear || false,
			tmln = new TimelineMax();
		// Animate fill position and color to indicate last page/error
		tmln.to(that.button_fill, 0.8, {x: "-30%", backgroundColor: "red", ease: Power3.easeOut, 
				onStart: function(){
					that.button_label.text(reason).css('cursor', 'default');
					// that.button_label;
				}
			}, "no_posts")
			// ...fade out fill...
			.to(that.button_fill, 0.8, {x: "-100%", opacity: 0, ease: Power3.easeOut}, "no_posts+=0.4");

		if(button_should_disappear){
			// ...fade out entire button...
			tmln.to(that.button, 0.8, {opacity: 0, ease: Power3.easeOut,
					onComplete: function(){
						// On animation complete remove will change property.
						that.button_fill.css('will-change', '');
						that.button.css('display', 'none');
					}
				}, "+2");
		}else{
			// Do something else...
		}
	}

	/**
	 * Check to see if we've reached the last page
	 * @return {Boolean}             Are there posts remaining?
	 */
	Viewmore.prototype.postsRemaining = function(){
		var numberOfPosts = this.incoming_posts.length;
		return (numberOfPosts == 0) ? false : true;
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

	/**
	 * Removing the button when there are no more posts.
	 */
	Viewmore.prototype.noMorePosts = function(){
		var that = this;
		TweenMax.to(that.button, 0.8, {opacity: 0, ease:Power3.easeOut, 
			onComplete: function(){
				that.button_fill.css('will-change', '');
				that.button.css('display', 'none');
			}
		});
	}

	return Viewmore;

});