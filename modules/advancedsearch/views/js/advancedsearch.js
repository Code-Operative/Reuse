let aSearch = document.getElementById("advanceSearchButton");
let postcodeinputvalidation1 = document.getElementById("postcode-input");

// let pCode = document.getElementById("advanceSearchButton");
// let postcodeinputvalidation1 = document.getElementById("advanceSearchLocationInput");
let dropdown = document.querySelector("#advanceSearchOptionsSelect");
let distanceInput = document.querySelector("#advanceSearchDistanceInput");

dropdown.value == "delivery"? distanceInput.disabled = true:distanceInput.disabled = false;
dropdown.addEventListener("change", ()=> {dropdown.value == "delivery"? distanceInput.disabled = true:distanceInput.disabled = false;})


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