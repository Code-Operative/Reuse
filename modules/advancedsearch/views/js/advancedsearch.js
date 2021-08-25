let aSearch = document.getElementById("advanceSearchButton");
let postcodeinputvalidation1 = document.getElementById("postcode-input");
let distanceinputvalidation = document.querySelector("#distance-input");

// let pCode = document.getElementById("advanceSearchButton");
// let postcodeinputvalidation1 = document.getElementById("advanceSearchLocationInput");
let dropdownAdvanceSearchModule = document.querySelector("#retrieve-method");
let distanceInputAdvanceSearchModule = document.querySelector("#distance-input");

dropdownAdvanceSearchModule.value == "delivery"? distanceInputAdvanceSearchModule.disabled = true:distanceInputAdvanceSearchModule.disabled = false;
dropdownAdvanceSearchModule.addEventListener("change", ()=> {dropdownAdvanceSearchModule.value == "delivery"? distanceInputAdvanceSearchModule.disabled = true:distanceInputAdvanceSearchModule.disabled = false;})


postcodeinputvalidation1.oninput =() => {
  postcodeinputvalidation1.setCustomValidity('');
}

distanceinputvalidation.oninput =() => {
  distanceinputvalidation.setCustomValidity('');
}

aSearch.onclick = function () {
    //validate that a distance is given
    if (distanceinputvalidation.value == "") { 
      distanceinputvalidation.setCustomValidity('Please insert a distance');
      distanceinputvalidation.reportValidity();
    }
    //validate postcode fields here
    else if (postcodeinputvalidation1.checkValidity() != true || postcodeinputvalidation1.value.length == 0) {
        postcodeinputvalidation1.setCustomValidity('Please enter a valid UK  postcode');
      postcodeinputvalidation1.reportValidity();
    }
    //submit form when everything is correct
    else if (distanceinputvalidation.value != "" && postcodeinputvalidation1.checkValidity() == true && postcodeinputvalidation1.value.length == 0) {
      document.asearchform.submit();
    }
}