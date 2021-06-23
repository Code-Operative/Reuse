import $ from 'jquery';

export default class DisplayView {
	init() {
		this.displayView();
	}
	displayView(){
		$('.show_list').click(function(){
			document.cookie = "show_list=true; expires=Thu, 30 Jan 2100 12:00:00 UTC; path=/";
			$('#products').removeClass('grid');
			$('#products').addClass('list');
			$('.show_grid').removeClass('active');
			$('.show_list').addClass('active');
		});
		 
		$('.show_grid').click(function(){
			document.cookie = "show_list=; expires=Thu, 30 Jan 1970 12:00:00 UTC; path=/";
			$('#products').removeClass('list');
			$('#products').addClass('grid');
			$('.show_list').removeClass('active');
			$('.show_grid').addClass('active');
		});
		 
		prestashop.on('updateProductList', function (event) {
			$('.show_list').click(function(){
				$('#products').removeClass('grid');
				$('#products').addClass('list');
				$('.show_grid').removeClass('active');
				$('.show_list').addClass('active');
			});
			 
			$('.show_grid').click(function(){
				$('#products').removeClass('list');
				$('#products').addClass('grid');
				$('.show_list').removeClass('active');
				$('.show_grid').addClass('active');
			});
		});
	}
}