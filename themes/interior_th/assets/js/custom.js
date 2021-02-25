$(document).ready(function(){
    $('.js-btn-to-top').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
    });
    $('.js-btn-to-top').fadeOut();
    $(window).scroll(function(){
        if ($(window).scrollTop() > 250) {
            $('.js-btn-to-top').fadeIn();
        }
        else {
            $('.js-btn-to-top').fadeOut();
        }
        if ($(window).scrollTop() > 600) {
            //hide dropdown cart on scroll
            if ($('#toggle-cart').is(':checked')) {
                $('#toggle-cart').attr('checked', false);
            }
        }
    });

    dropCustomDown();
    fixedHeader();
    $(window).resize(function(){
        fixedHeader();
    });
    $('.sidebar .h6').click(function(){
        $(this).toggleClass('active');
        $(this).closest($('.column-block')).toggleClass('open');
    })
});
function fixedHeader(){
    if($(window).width() + scrollCompensate() > 991){
        var hideHeight = 0;
        hideHeight =  $(".header-nav").outerHeight();
        setTimeout(function(){
            var hh =  $("#header").outerHeight();
            if($("#page").css("padding-top")=='0px'){
                $("#page").css( "padding-top", hh );
            }
            $("#header").addClass( "fixed-top");
        },500);
        var updateTopbar = function(){
             var pos = $(window).scrollTop();
             if( pos > 100){
                $("#header").addClass('hide-bar').css({
                    '-webkit-transform' : 'translateY(' + (-hideHeight) + 'px)',
                    'transform'         : 'translateY(' + (-hideHeight) + 'px)'
                });
            }else {
                $("#header").removeClass("hide-bar").css({
                    '-webkit-transform' : 'translateY(' + 0 + ')',
                    'transform'         : 'translateY(' + 0 + ')'
                });
            } 
        }
        $(window).scroll(function() {
           updateTopbar();
        });
    }else {
        $("#page").css( "padding-top", '0' );
        $("#header").removeClass( "fixed-top hide-bar");
    }
}
/*width of a scroll bar*/
function scrollCompensate()
{
    var div = $('<div>').css({
        position: "absolute",
        top: "0px",
        left: "0px",
        width: "100px",
        height: "100px",
        visibility: "hidden",
        overflow: "scroll"
    });
    
    $('body').eq
    (0).append(div);
    
    var width = div.get(0).offsetWidth - div.get(0).clientWidth;
    
    div.remove();
    
    return width;
}
function dropCustomDown()
{
    var elementClickCustom = '.js-toggle';
    var elementSlideCustom =  '.js-toggle-list';
    var activeClassCustom = 'active';

    $(elementClickCustom).on('click', function(e){
        e.stopPropagation();
        $(this).toggleClass(activeClassCustom);
        e.preventDefault();
    });

    $(elementSlideCustom).on('click', function(e){
        e.stopPropagation();
    });

    $(document).on('click', function(e){
        e.stopPropagation();
        $(elementClickCustom).removeClass('active');
    });
}
