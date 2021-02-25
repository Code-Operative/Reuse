$(document).ready(function(){
	$('.js-carousel-products').each(function() {
		var owlProducts = $(this);
		owlProducts.owlCarousel({
			items: 5,
			nav: true,
			dots: false,
			autoplay: true,
			loop: owlProducts.children().length > 1,
			responsiveClass:true,
			responsive:{
				0:{
					items:2
				},
				480:{
					items:2
				},
				768:{
					items:3
				},
				991:{
					items:4
				}
			},
			navText: ['<i class="font-left-open-big">','<i class="font-right-open-big">']
		});
	});
});