$(document).ready(function(){
	var productid = $("[name=id_product]").val();
	
	if ( productid == "0" ) {
		/* Disable sections they cannot populate */
		$("[data-toggle=kb-product-form-image]").hide();
		$("[data-toggle=kb-product-form-image]").closest("div").parent().nextAll(".kb-vspacer5:first").hide();
		$("[data-toggle=kb-product-form-features]").hide();
		$("[data-toggle=kb-product-form-features]").closest("div").parent().nextAll(".kb-vspacer5:first").hide();
		$("[data-toggle=kb-product-form-suppliers]").hide();
		$("[data-toggle=kb-product-form-suppliers]").closest("div").parent().nextAll(".kb-vspacer5:first").hide();
		$("[data-toggle=kb-product-form-combination]").hide();
		$("[data-toggle=kb-product-form-combination]").closest("div").parent().nextAll(".kb-vspacer5:first").hide();
		
		/* Auto show information open */
		$("#kb-product-form-information").show();
		
		/* Highlight necessary fields on first input */
		$("[name=name_2]").css({"border":"2px solid #003C50"});
		$("[name=price]").css({"border":"2px solid #003C50"});
		$("[name=tax-rule]").css({"border":"2px solid #003C50"});
		$("[name=qty_0]").css({"border":"2px solid #003C50"});
		$("[name=tax_rule]").css({"border":"2px solid #003C50"});
		$("[name=id_category_default]").css({"border":"2px solid #003C50"});
		$("#seller-categories-tree").css({"padding":"8px"});
		$("#seller-categories-tree").css({"border":"2px solid #003C50"});
		$("[name=availableShipping]").css({"border":"2px solid #003C50"});
		$("#selectedShipping").css({"border":"2px solid #003C50"});
		
	} else {
		
		/* Auto show image inputs open when product exists */
		$("[data-toggle=kb-product-form-image]").show();
		$("#kb-product-form-image").show();
		
	}
	
	$("[name=name_2]").keydown(function(){
		var seolabel = $("[name=link_rewrite_2]").val();
		$("[name=reference]").val(seolabel);
		});
	
	$("[name=active]").val(1);
	$("#kb-product-form-category").find(".form-inp-help").html("<i class=\"kb-material-icons\" style=\"margin-right:0;\"></i> Click on the 'Home' category to get a list of all the categories, and select the ones that apply to your product. Please bear in mind you cannot make the 'Home' category your default category.");
	$("#kb-product-form-category").find(".form-inp-help").css({"padding":"8px"});
	$("#kb-product-form-category").find(".form-inp-help").css({"margin":"8px"});
	$("#kb-product-form-category").find(".form-inp-help").css({"font-size":"1.0em"});
	$("#kb-product-form-category").find(".form-inp-help").css({"background-color":"#fcf8e3"});
	$("#kb-product-form-category").find(".form-inp-help").css({"border":"1px solid #8a6d3b"});
	$("[name=ean13]").css({"border":"1px solid #ddd"});
	$("[name=ean13]").closest("li").css({"color":"#aaa"});
	$("[name=upc]").css({"border":"1px solid #ddd"});
	$("[name=upc]").closest("li").css({"color":"#aaa"});
	$("[name=show_price]").closest("div").hide();
	$("[name=visibility]").closest("li").hide();
	$("[name=active]").closest("li").hide();
	$("[name=available_now_2]").closest("li").hide();
	$("[name=available_later_2]").closest("li").hide();
	$("[name=minimal_quantity]").closest("li").hide();
	$("[data-toggle=kb-product-form-seo]").hide();
	$("[data-toggle=kb-product-form-seo]").closest("div").parent().nextAll(".kb-vspacer5:first").hide();
    $("[name=condition]").val('used');
	$("[name=id_manufacturer]").closest("li").removeClass("kb-form-l");
	$("[name=id_manufacturer]").closest("li").addClass("kb-form-r");
	$("[name=show_condition]").val('1');
	$("[name=show_condition]").hide();
	$("[name=show_condition]").closest("li").hide();
	
	//hide manufacturer dropdown in 
	$(".manufacturer-logo").hide();
	
	//sort seller alphabetically 
	// document.getElementById('selectProductSort').selectedIndex = 1;
	// $(#selectProductSort).trigger('change');
	
	//add next button to seller profile 
	// var node = document.querySelector("#sellerprofile-update-btn"),
	// nextButton = document.createElement("button");
	// nextButton.setAttribute("type","button");

	// nextButton.className = "sellerprofile-next-btn";
	// nextButton.innerHTML = "Next";
	// node.parentNode.insertBefore(nextButton, node.nextSibling);
	// nextButton.onclick = () => console.log('clicked');
	
	//create functions for next button in seller profile
	var generalTab = document.getElementById("kb-sprofile-general");
	var metaTab = document.getElementById("kb-sprofile-metadata");
	var policyTab = document.getElementById("kb-sprofile-policydata");
	var PaymentTab = document.getElementById("kb-sprofile-paymentinfo");
	
	var general = document.getElementById("general");
	var metadata = document.getElementById("metadata");
	var policydata = document.getElementById("policydata");
	var paymentinfo = document.getElementById("paymentinfo");
	
	SellerProfileFormNextMeta = () => {
		metaTab.classList.add("active");
		generalTab.classList.remove("active");
		metadata.style.display = "block";
		general.style.display = "none";
	}

	SellerProfileFormNextPolicy = () => {
		policyTab.classList.add("active");
		metaTab.classList.remove("active");
		policydata.style.display = "block";
		metadata.style.display = "none";
	}

	SellerProfileFormNextInfo = () => {
		PaymentTab.classList.add("active");
		policyTab.classList.remove("active");
		paymentinfo.style.display = "block";
		policydata.style.display = "none";
	}
	
});

	//remove navbar when seller at dashboard 
if (window.location.href.indexOf("kbmarketplace") > -1) {
	$(".top-menu").hide();
	$("#_desktop_cart").hide();
}