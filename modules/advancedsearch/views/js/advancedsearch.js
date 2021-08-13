let aSearch = document.getElementById("advancedSearch-button");
let postcodeinputvalidation = document.getElementById("postcode-input");
const url = document.getElementById("advancedsearch_block_home").dataset.searchControllerUrl;

postcodeinputvalidation.oninput =() => {
    postcodeinputvalidation.setCustomValidity('');
}

aSearch.onclick = function () {
    //validate all fields here
    if (postcodeinputvalidation.checkValidity() == false) {
        postcodeinputvalidation.setCustomValidity('Please enter a valid UK postcode');
        postcodeinputvalidation.reportValidity();
    }
    else{
      document.asearchform.submit();
    }
}