let pCode = document.getElementById("advanceSearchButton");
let postcodeinputvalidation = document.getElementById("advanceSearchKeywordsInput");

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