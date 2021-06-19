if(document.getElementsByClassName("tab-content")[0].getElementsByClassName("promoted-products")[0]){
    const promotedProducts = document.getElementsByClassName("tab-content")[0].getElementsByClassName("promoted-products")[0];

    const wrapper = document.getElementById("wrapper");

    const footer = document.getElementById("footer");

    wrapper.parentElement.insertBefore(promotedProducts,footer);
}