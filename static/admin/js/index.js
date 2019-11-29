var Index = function() {"use strict";

	// function to animate CoreBox Icons
	var runCoreBoxIcons = function() {
		$(".core-box").on("mouseover", function() {
			$(this).find(".icon-big").addClass("tada animated");
		}).on("mouseleave", function() {
			$(this).find(".icon-big").removeClass("tada animated");
		});
	};

	// function to activate owlCarousel in Appointments Panel
	var runEventsSlider = function() {
		var owlEvents = $(".appointments .e-slider").data('owlCarousel');
		$(".appointments .owl-next").on("click", function(e) {
			owlEvents.next();
			e.preventDefault();
		});
		$(".appointments .owl-prev").on("click", function(e) {
			owlEvents.prev();
			e.preventDefault();
		});
	};
	return {
		init: function() {
			runEventsSlider();
		}
	};
}();
