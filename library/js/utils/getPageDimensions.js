define([
	// Deps
	'common',
	'utils/throttle'

] , function (_c) {

	var PageDimensions = function(){

		var t = this,
			_c_s = _c.SELECTORS;

		this.doc = document;
		this.docbdy = this.doc.body;
		this.docelem = this.doc.documentElement;
		this.docHeight = this.setDocHeight();
		this.docWidth = this.setDocWidth();
		this.viewHeight = this.docelem.clientHeight;
		this.viewWidth = this.docelem.clientWidth;

		_c_s.windo.on("resize", function( event ) {
			t.setDocHeight();
			t.setDocWidth();
			t.viewHeight = t.docelem.clientHeight;
			t.viewWidth = t.docelem.clientWidth;
		}.throttle(200));
	}

	PageDimensions.prototype.doc = null;
	PageDimensions.prototype.docbdy = null;
	PageDimensions.prototype.docelem = null;
	PageDimensions.prototype.docHeight = 0;
	PageDimensions.prototype.docWidth = 0;
	PageDimensions.prototype.viewHeight = 0;
	PageDimensions.prototype.viewWidth = 0;
	PageDimensions.prototype.setDocHeight = function(){
		return Math.max(
			Math.max(this.docbdy.scrollHeight, this.docelem.scrollHeight),
			Math.max(this.docbdy.offsetHeight, this.docelem.offsetHeight),
			Math.max(this.docbdy.clientHeight, this.docelem.clientHeight)
		);
	}
	PageDimensions.prototype.setDocWidth = function(){
		return Math.max(
			Math.max(this.docbdy.scrollWidth, this.docelem.scrollWidth),
			Math.max(this.docbdy.clientWidth, this.docelem.clientWidth)
		);
	}

	return PageDimensions;

});