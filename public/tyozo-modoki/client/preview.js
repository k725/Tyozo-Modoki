/*
 * Url preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
$(document).ready(function(){
	var xOffset = -10,
		yOffset = 15;

	$(document).on('mouseenter', 'a.screenshot', function(e){
		$('body').append('<p id="screenshot"><img src="'+ this.rel +'" alt="url preview" /></p>');
		$('#screenshot')
			.css('top', (e.pageY - xOffset) + 'px')
			.css('left', (e.pageX + yOffset) + 'px')
			.fadeIn();
	});

	$(document).on('mouseleave', 'a.screenshot', function(){
		$('#screenshot').remove();
	});

	$('a.screenshot').mousemove(function(e){
		$('#screenshot')
			.css('top', (e.pageY - xOffset) + 'px')
			.css('left', (e.pageX + yOffset) + 'px');
	});
});
