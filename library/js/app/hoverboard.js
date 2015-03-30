define([

	// deps
	'jquery',
	'common',
	'lodash',
	'utils/getPageDimensions',
	'gsap',
	'utils/throttle',

], function($, _c, _, PageDimensions) {

	/** ______________________
	 *** Hoverboard Constructor
	 **/
	var Hoverboard = function(board) {
		var t = this,
			_c_s = _c.SELECTORS;

		// Init vars
		t.board 				= board;
		t.board_entries 		= t.board.find(".hoverboard__entry");
		t.board_entry_width 	= t.board_entries.outerWidth();
		t.board_entries_count 	= t.board_entries.length;
		t.board_width 			= (t.board_entry_width * t.board_entries_count);
		t.cursor_x_position		= 0;

		var board_container = t.board.parent(),
			mouse_move_throttle_limit = 20;

		// Set width of board.
		t.board.width(t.board_width);

		// On mouse move...
		board_container.mousemove(function(e) {
			// ...get x position of cursor...
			t.cursor_x_position = e.pageX;
			//...pan board.
			TweenMax.to(t.board, 0.8, {x: -t.get_move_to_value(), ease: Power3.easeOut});
		}.throttle(mouse_move_throttle_limit));

	}

	/**
	 * The board...
	 * @type {jQuery Object}
	 */
	Hoverboard.prototype.board = null;
	/**
	 * Elements on the board
	 * @type {jQuery Object}
	 */
	Hoverboard.prototype.board_entries = null;
	/**
	 * The width of the entire board.
	 * @type {Number}
	 */
	Hoverboard.prototype.board_width = 0;
	/**
	 * Width of a single element on the board
	 * @type {Number}
	 */
	Hoverboard.prototype.board_entry_width = 0;
	/**
	 * Number of elements on the board
	 * @type {Number}
	 */
	Hoverboard.prototype.board_entries_count = 0;
	/**
	 * Position of cursor along x on viewport
	 * @type {Number}
	 */
	Hoverboard.prototype.cursor_x_position = 0;

	/**
	 * Get the px value to move the board to.
	 * @return {Number} The translate X value
	 */
	Hoverboard.prototype.get_move_to_value = function(){
		var range_max = (this.board_width - PageDimensions.viewWidth),
			x_value = ((this.cursor_x_position * range_max ) / (PageDimensions.viewWidth));
		return x_value;
	}

	return Hoverboard;

});