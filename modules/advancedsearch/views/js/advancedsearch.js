let aSearch = document.getElementById("advancedSearch-button");
let postcodeinputvalidation = document.getElementById("postcode-input");
const url = document.getElementById("advancedsearch_block_home").dataset.postcodecheckControllerUrl;

postcodeinputvalidation.oninput =() => {
    postcodeinputvalidation.setCustomValidity('');
}

aSearch.onclick = function () {
    if (postcodeinputvalidation.checkValidity() == false) {
        postcodeinputvalidation.setCustomValidity('Please enter a valid UK postcode');
        postcodeinputvalidation.reportValidity();
    }
    else{
        fetch(url, {
            method: "POST",
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'search': document.getElementById("search-input").value, 
                'postcode': document.getElementById("postcode-input").value,
                'distance': document.getElementById("distance-input").value,
                'retrieve': document.getElementById("retrieve-method").value,
            }),
          })
            .then((res) => {
              return res.json()
            })
            //.then((data) => {
              // alert(data.postcode);
             // const message = JSON.parse(data.postcode);
             // if (message.id == 1) {
             //   postcode_message.style.color = '#0BA32C';
              //  postcode_message.innerHTML= message.msg;
              //  postcode_img.src = "http://reuse-home.org.uk/modules/postcodecheck/img/greenTick.svg";
             // }
             // if (message.id == 2) {
              //  postcode_message.style.color = '#F77B86';
              //  postcode_message.innerHTML= message.msg;
              //  postcode_img.src = "http://reuse-home.org.uk/modules/postcodecheck/img/redCross.svg";
              //}
      
              //console.log(data.postcode);
      
          //})
    }
}