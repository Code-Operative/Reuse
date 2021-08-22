if(document.getElementById("kb-sprofile-integrations")){
    const sellerID = document.getElementsByName("kb_id_seller")[0].value;
    
    const urlParams = new URLSearchParams(window.location.search);
    const ebayOAuthCode = urlParams.get('code');
    
    if(ebayOAuthCode){
        const ebayAccountInfo = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                sellerID,
                ebayOAuthCode
            })
        };

        console.log(ebayAccountInfo)

        fetch("https://reuse-home-integration-service.herokuapp.com/link/ebay",ebayAccountInfo)
        .then(response => response.json())
        .then(result => {
            if(result.success){
                const ebayNo = document.getElementById("ebay-no-link");
                const ebayYes = document.getElementById("ebay-yes-link");

                ebayNo.style.display = "none";
                ebayYes.style.display = "block";
            }
        });
    }
}

if(document.getElementById("integrations")){
    //get the reuse seller ID from this page

    const sellerID = document.getElementsByName("kb_id_seller")[0].value;

    //check if there is a link already
    fetch(`https://reuse-home-integration-service.herokuapp.com/link/ebay/${sellerID}`)
        .then(response => response.json())
        .then(result => {
            if(result.success == true){

                const ebayNo = document.getElementById("ebay-no-link");
                const ebayYes = document.getElementById("ebay-yes-link");

                ebayNo.style.display = "none";
                ebayYes.style.display = "block";
            }
        });
}
