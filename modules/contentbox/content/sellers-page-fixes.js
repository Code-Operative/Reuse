if(document.getElementById("seller_list_to_customers")){
    document.title = "Stores";
}

// change links to sellers page
if(document.getElementById("kb_displaynav1_links_container")){
    const linkContainer = document.getElementById("kb_displaynav1_links_container");

    const sellersLink = linkContainer.children[0].children[0];

    sellersLink.setAttribute("href","/sellers?kb_page_start=0&orderby=sl.title&orderway=asc");

    const storesLink = document.getElementById("link-static-page-stores-2");
    storesLink.href = "/sellers?kb_page_start=0&orderby=sl.title&orderway=asc";
}