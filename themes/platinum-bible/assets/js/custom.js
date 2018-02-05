jQuery(document).ready(function() {

	jQuery('.timeline-inner').timeline();
jQuery('.carousel').slick({
  infinite: false,
  slidesToShow: 1,
  slidesToScroll: 2,
  variableWidth: true
});
			
});


(function($) {$.fn.timeline = function(options) {

	var set = $.extend({
	handle: this,
	contain: this.parent()
	}, options),

	object = this, newX, newY,
	nadir = object.css('z-index'),
	apex = Math.pow(10,4),
	move = 'mousemove touchmove',
	release = 'mouseup touchend';
	
    object.parent().css('height', object.outerHeight() + 'px');

	if (window.requestAnimationFrame) var neoteric = true;

	set.handle.on('mousedown touchstart', function(e) {

	if (e.type == 'mousedown' && e.which != 1) return;

	object.css('z-index', apex);
	var marginX = set.contain.width()-object.outerWidth(),
	marginY = set.contain.height()-object.outerHeight(),
	oldX = object.position().left,
	oldY = object.position().top,
	touch = e.originalEvent.touches,
	startX = touch ? touch[0].pageX : e.pageX,
	startY = touch ? touch[0].pageY : e.pageY;
  

	$(window).on(move, function(e) {

		var contact = e.originalEvent.touches,
		endX = contact ? contact[0].pageX : e.pageX,
		endY = contact ? contact[0].pageY : e.pageY;
		newX = Math.max(marginX, Math.min(oldX+endX-startX,0));
	/* 	newY = Math.max(0, Math.min(oldY+endY-startY, marginY)); */
	    newY = oldY;
		if (neoteric) requestAnimationFrame(setElement);
		else setElement();
		})
		.one(release, function(e) {
		e.preventDefault();
		object.css('z-index', nadir);
		$(this).off(move).off(release);
		});
	
		e.preventDefault();
		});
	
		return this;
	
	    function setElement() {
		    object.css({top: newY, left: newX});
	    }
	};
	
	

})( jQuery );
