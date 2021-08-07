let pCode = document.getElementById("advanceSearchButton");
let postcodeinputvalidation = document.getElementById("advanceSearchLocationInput");
let dropdown = document.querySelector("#advanceSearchOptionsSelect");
let distanceInput = document.querySelector("#advanceSearchDistanceInput");

dropdown.value == "delivery"? distanceInput.disabled = true:distanceInput.disabled = false;
dropdown.addEventListener("change", ()=> {dropdown.value == "delivery"? distanceInput.disabled = true:distanceInput.disabled = false;})


postcodeinputvalidation.oninput =() => {
  postcodeinputvalidation.setCustomValidity('');
}

pCode.onclick = function () {
  console.log(postcodeinputvalidation.value.length);
  if (postcodeinputvalidation.checkValidity() != true || postcodeinputvalidation.value.length == 0) {
      postcodeinputvalidation.setCustomValidity('Please enter a valid UK    postcode');
    postcodeinputvalidation.reportValidity();
  }
}