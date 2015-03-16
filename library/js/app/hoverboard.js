define([

	// deps
    'jquery',
    'common',
    'lodash',
    'utils/getPageDimensions',
    'tweenmax',
    'utils/throttle',

], function ($, _c, _, PageDimensions, tweenmax) {

	/**
	 * Hoverboard Constructor
	 */
	var Hoverboard = function(module_name){
		var t = this,
			_c_s = _c.SELECTORS;
		
		// 
		t.board 				= 	$(module_name);
		t.board_entries 		= 	t.board.find(module_name + "__entry");
		t.board_entry_width 	= 	400;
		t.board_entries_count 	= 	t.board_entries.length;
		t.board_width 			= 	t.board_entry_width * t.board_entries_count;

		var start_threshold		=	20,
			percent_move;
		
		// Set width of board.
		t.board.width(t.board_width);

		// Set percentage of board on and off canvas...
		t.setPercentageOfBoardOnCanvas();
		t.setPercentageOfBoardOffCanvas();
		//... and update this value on view resize.
		_c.SELECTORS.windo.on("resize", function( event ) {
			t.setPercentageOfBoardOnCanvas();
			t.setPercentageOfBoardOffCanvas();
		}.throttle(200));

		// On mouse move...
		t.board.parent().mousemove(function(e){
			
			// ... get percentage of mouse across view.
			var cursor_x_position = e.pageX,
				cursor_x_position_as_percent = (( cursor_x_position / t.pageDimensions.viewWidth) * 100),
				cursor_x_polar_position = -cursor_x_position_as_percent;

			// If the cursor goes beyond the threshold...
			if(cursor_x_polar_position < -start_threshold){
				
				// ..., starting from beyond the threshold, ...
				cursor_x_polar_position = cursor_x_polar_position + start_threshold;

				// ... move the board in the opposite direction as far as there are elems off canvas.
				if ( cursor_x_polar_position > t.board_off_canvas ) {
					// 
					cursor_x_polar_position = cursor_x_polar_position + '%';
					percent_move = cursor_x_polar_position;
				}

			}else{
				// ... if the cursor hasn't passed the threshold,
				// move board to 0.
				percent_move = "0%";
			}

			t.moveBoard(percent_move);
		
		});

	}

	Hoverboard.prototype.board = null;
	Hoverboard.prototype.board_entries = null;
	Hoverboard.prototype.board_entry_width = 0;
	Hoverboard.prototype.board_entries_count = 0;
	Hoverboard.prototype.board_width = 0;
	Hoverboard.prototype.max_move = 0;
	Hoverboard.prototype.pageDimensions = new PageDimensions();

	Hoverboard.prototype.getPercentageOfBoardOnCanvas = function() {
		return this.board_on_canvas;
	};
	Hoverboard.prototype.setPercentageOfBoardOnCanvas = function(){
		this.board_on_canvas = ((this.pageDimensions.viewWidth / this.board_width) * 100);
	};
	Hoverboard.prototype.getPercentageOfBoardOffCanvas = function(){
		return this.board_off_canvas;
	}
	Hoverboard.prototype.setPercentageOfBoardOffCanvas = function(){
		this.board_off_canvas = this.board_on_canvas - 100;
	}


	Hoverboard.prototype.moveBoard = function(percent_move){
		// Animate board moving...
		TweenMax.to(this.board, 0.1, {x: percent_move, ease:Linear.easeNone });
	}

	return Hoverboard;

});
