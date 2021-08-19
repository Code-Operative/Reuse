let aSearch = document.getElementById("advanceSearchButton");
let postcodeinputvalidation1 = document.getElementById("postcode-input");

// let pCode = document.getElementById("advanceSearchButton");
// let postcodeinputvalidation1 = document.getElementById("advanceSearchLocationInput");
let dropdownAdvanceSearchModule = document.querySelector("#retrieve-method");
let distanceInputAdvanceSearchModule = document.querySelector("#distance-input");

dropdownAdvanceSearchModule.value == "delivery"? distanceInputAdvanceSearchModule.disabled = true:distanceInputAdvanceSearchModule.disabled = false;
dropdownAdvanceSearchModule.addEventListener("change", ()=> {dropdownAdvanceSearchModule.value == "delivery"? distanceInputAdvanceSearchModule.disabled = true:distanceInputAdvanceSearchModule.disabled = false;})


postcodeinputvalidation1.oninput =() => {
  postcodeinputvalidation1.setCustomValidity('');
}

// postcodeinputvalidation1.oninput =() => {
//     postcodeinputvalidation1.setCustomValidity('');
// }

aSearch.onclick = function () {
    //validate postcode fields here
    if (postcodeinputvalidation1.checkValidity() != true || postcodeinputvalidation1.value.length == 0) {
        postcodeinputvalidation1.setCustomValidity('Please enter a valid UK  postcode');
      postcodeinputvalidation1.reportValidity();
    }
    else{
      document.asearchform.submit();
    }
}