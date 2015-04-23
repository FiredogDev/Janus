define([

	// deps
	'jquery',
	'common',
	'lodash',
	'slick',
	'utils/getPageDimensions',
	'gsap',

], function($, _c, _, slick, the_dimes) {

	/**  ____________________
	 *** Gallery Constructor
	 **/
	var Gallery = function(gallery) {
		var that = this,
			_c_s = _c.SELECTORS;

			// The gallery, it's items and it's captions
			this.gallery 				= 	gallery;
			this.gallery_items 			= 	this.gallery.find('.gallery__items');
			this.gallery_items__imgs	= 	this.gallery_items.find('.gallery__item__image');
			this.gallery_captions 		= 	this.gallery.find('.gallery__captions');

			var view_height = the_dimes['viewHeight']; // add header height to common...

			// this.gallery.height(view_height);
			// this.gallery_items__imgs.height(view_height);
			// this.gallery_captions.height(view_height);
			
			// Start gallery
			this.init();
	}

	/**
	 * The gallery container
	 * @type {Object}
	 */
	Gallery.prototype.gallery = null;
	/**
	 * The gallery slides
	 * @type {Object}
	 */
	Gallery.prototype.gallery_items = null;
	/**
	 * The gallery captions
	 * @type {Object}
	 */
	Gallery.prototype.gallery_captions = null;

	/**
	 * Init the gallery
	 */
	Gallery.prototype.init = function(){
		this.init_item_slider();
		this.init_caption_slider();
	}

	/**
	 * Init the slick item slider
	 */
	Gallery.prototype.init_item_slider = function(){
		var that = this;
		this.gallery_items.slick({
			infinite: true,
			speed: 600,
			arrows: false,
			slidesToScroll: 1,
			slidesToShow: 1,
			fade: true,
			slide: '.gallery__item',
			asNavFor: that.gallery_captions
		});
	}

	/**
	 * Init the slick caption slider
	 */
	Gallery.prototype.init_caption_slider = function(){
		var that = this;
		this.gallery_captions.slick({
			infinite: true,
			speed: 600,
			arrows: true,
			slidesToScroll: 1,
			slidesToShow: 1,
			fade: true,
			draggable: false,
			prevArrow: '.gallery__control--prev',
			nextArrow: '.gallery__control--next',
			slide: '.gallery__caption',
			asNavFor: that.gallery_items,
			focusOnSelect: true
		});
	}

	

	return Gallery;

});