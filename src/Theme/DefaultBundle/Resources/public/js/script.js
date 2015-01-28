$(document).ready(function() {
	var defaults = {
		containerID: 'toTop', // fading element id
		containerHoverID: 'toTopHover', // fading element hover id
		scrollSpeed: 100,
		easingType: 'linear' 
		};
	$().UItoTop({ easingType: 'easeOutQuart' });
});