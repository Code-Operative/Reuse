window.onload = function fetchSellerId() {
	
  var x = document.getElementById("kbmp-seller-info").getElementsByTagName("a");
  
  var requiredElement = x[0].href;
  
  var lengthElement = requiredElement.length;
  
  var position = requiredElement.indexOf("id_seller=")+10;
  
  var sellerid = requiredElement.substring(position, lengthElement);
  
  var seller = document.getElementById("seller_id1");
  
  if (seller) {
	  seller.value = sellerid;
  }
  
  var product_page_id = document.getElementById("product_page_product_id");
  
  if (product_page_id) {
	  var product_id = product_page_id.value;
	  
	  var product_id_field = document.getElementById("product_id");
	  
	  if (product_id && product_id_field) {
		  
		product_id_field.value = product_id;
	  }
	  
  }	  
  
}

// document.getElementById('selectProductSort').value='sl.title:asc';
// document.getElementById('selectProductSort').selectedIndex = 1;
// document.getElementById('selectProductSort').trigger('change');

document.getElementsByName('id_contact')[0].options[1].textContent="techincal support";