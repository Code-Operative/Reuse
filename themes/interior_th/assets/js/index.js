$(document).ready(function(){
	/*Animation of blocks on scroll*/
	var wow = new WOW(
	{
		mobile: false,
	}
	);
	wow.init();
	/*product tabs on index page*/
	$('.js-products-tabs li:first a, .js-wrap-products-tabs .tab-pane:first').addClass('active');
	/*end product tabs on index page*/
});