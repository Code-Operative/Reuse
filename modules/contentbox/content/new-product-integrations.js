let sellerID;

if(document.getElementById("new-product-integrations")){
     //get the reuse seller id from this page
    sellerID = document.getElementsByName("id_seller")[0].value;
 
    //check if there is an ebay account link set up
    fetch(`https://reuse-home-integration-service.herokuapp.com/link/ebay/${sellerID}`)
         .then(response => response.json())
         .then(result => {
             if(result.success == true){
                const ebayCheckbox = document.getElementById("ebay-checkbox");

                ebayCheckbox.checked = true;

                const otherMarketplaces = document.getElementById("product-integrations-container");
 
                otherMarketplaces.style.display = "block";
             }
    });
    
}

function checkIntegrations () {
    const ebayCheckbox = document.getElementById("ebay-checkbox");

    const productReference = document.getElementsByName("reference")[0].value;

    //gather the info for the product

    if(ebayCheckbox.checked == true){
        const ebayProductInfo = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                sellerID,
                productReference
            })
        };

        fetch(`https://reuse-home-integration-service.herokuapp.com/product/ebay`,ebayProductInfo)
            .then(response => console.log(response))
    }
}