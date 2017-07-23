/*----------------------------- Navigation --------------------------*/
jQuery(document).ready(function($) {
	"use strict";

	$( '#angles-slider' ).sliderPro({
		width: '900',
		height: '93vh',
		fade: true,
		arrows: true,
		buttons: false,
		waitForLayers: false,
		autoplay: true,
		autoplayDelay: 4000,
		autoplayOnHover: 'none',
		autoScaleLayers: false,
		touchSwipe: 'false',
		slideAnimationDuration: 2000
	});

	$('#counter').appear(function() {
		$('.counter').counterUp({
			delay: 20,
			time: 1000
		});
	});		

	jQuery('#progressbar').appear(function() {
		$('.progress .progress-bar').progressbar({
			transition_delay: 500,
			refresh_speed: 10,
		});
	});


	$('#skills').appear(function() {
		$('.chart').each(function () {
			$(this).easyPieChart({
				size: 110,
				animate: 2000,
				lineCap: 'butt',
				scaleColor: false,
				barColor: '#222',
				lineWidth: 10,
				onStep: function (from, to, percent) {
					$(this.el).find('.data-percent').text(Math.round(percent));
				}
			});
		});
	});
});


//jQuery('.site-header').removeClass('separator');

/*----------- Google Map - with support of gmaps.js ----------------*/

function isMobile() { 
	return ('ontouchstart' in document.documentElement);
}

function init_gmap() {
	if ( typeof google == 'undefined' ) return;
	var options = {
		center: [53.599339, 10.172954],
		zoom: 15,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		navigationControl: true,
		scrollwheel: false,
		streetViewControl: true
	}

	if (isMobile()) {
		options.draggable = false;
	}

	jQuery('#googleMaps').gmap3({
		map: {
			options: options
		},
		marker: {
			latLng: [53.599339, 10.172954],
			options: { icon: 'images/mapicon.png' }
		}
	});
}

init_gmap();