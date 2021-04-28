$(document).ready(function() {
    /*add-to-cart button in product list*/
    AddCartAfterFilter();
    $(document).ajaxComplete(function() {
        AddCartAfterFilter();
    });
});

function AddCartAfterFilter() {
    $('.js-product-miniature').hover(
        function() {
            //$('#js-product-list .ajax_block_product')
            var static_token = $('#page').attr('static_token');
            var urls_pages_cart = $('#page').attr('urls_pages_cart');
            $(".add-to-cart-or-refresh", this).attr('action', urls_pages_cart);
            $(".token-product-list", this).attr('value', static_token);
        },
        function() {

        });
}