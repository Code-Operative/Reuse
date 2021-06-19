/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store. 
 *
 * @category  PrestaShop Module
 * @author    knowband.com <support@knowband.com>
 * @copyright 2017 knowband
 * @license   see file: LICENSE.txt
 */

$(document).ready(function() {
    
//    $('#sfl_banner_1_link').keyup(function() {
//        alert('d');
//        var validate_link = velovalidation.checkUrl($('#sfl_banner_1_link'));
//        if(validate_link != true){
//            error = true;
//            $('#sfl_banner_1_link_error').show();
//            $('#sfl_banner_1_link_error').html(validate_link);
////            $(this).parent().append('<span class="validation-advice">'+velovalidation.checkMandatory($(this))+'</div>');
//        }
//        console.log($('#sfl_banner_1_link').val());
//    });
    
    
//    alert('sd');
//console.log($('input[name="banner[banner_1][file]"]').val());
    
//    $("#banner[banner_1][file]").change(function () {
//        console.log($(this));
//        var imgPath = $(this)[0].value;
//        alert('sd');
//        console.log(imgPath);
//        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
//        var image_holder = $("#sfl-banner-banner_1 .banner_block");
//        // image_holder.hide();
//        $('#sfl-banner-banner_1 .banner_block img').hide();
//        $('.thumb-image').remove();
//        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
//            if (this.files[0].size < 512000) {
//                if (typeof (FileReader) != "undefined") {
//
//
//                    var reader = new FileReader();
//                    reader.onload = function (e) {
//                        $("<img />", {
//                            "src": e.target.result,
//                            "class": "thumb-image",
//                            "width": "200px",
//                            "id": "new-image"
//                        }).appendTo(image_holder);
//                    }
//                    // $('#remove-button').show();
//                    image_holder.show();
//                    reader.readAsDataURL($(this)[0].files[0]);
//
//
//                } else {
//                    alertshowErrorMessage(browser_support_text);
//                }
//            } else {
//                $('.default-image').show();
//                $('.thumb-image').remove();
//                $("input[name=filename]").val('');
////            $('#velsof_exitpopup_image-name').val('');
//                showErrorMessage('File Size must be less than 500kb.');
//
//            }
//        } else {
//            // $('#remove-button').hide();
//            $('.default-image').show();
//            $('.thumb-image').remove();
//            showErrorMessage(image_select_text);
//        }
//    });
});