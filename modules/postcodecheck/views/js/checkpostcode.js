/**
* 2007-2021 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/

// var modal = document.getElementById("myModalPostCode");

// // Get the button that opens the modal
// var btn = document.getElementById("myBtn");

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks on the button, open the modal
// btn.onclick = function () {
//   modal.style.display = "block";
// }

// // When the user clicks on <span> (x), close the modal
// span.onclick = function () {
//   modal.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function (event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }

// $(document).ready(function () {
//   let pCode = document.getElementById("postcode-button");
//   pCode.onclick = function () {
//     const url = document.getElementById("postcodecheck").dataset.postcodecheckControllerUrl;
//     const data = { postcode: document.getElementById("postcode-input").value };
//     $.ajax({
//       url: url,
//       method: 'POST',
//       data: data
//     }).success(function (data) {
//       data = JSON.parse(data);
//       alert("Postcode is: " + data.postcode);
//       console.log(data);
//     });
//   }
// });

let pCode = document.getElementById("postcode-button");
let postcodecheckdiv = document.getElementById("postcodecheck");
let proceedtocollectionbutton = document.getElementById("check-collection-distance-button");
let postcodeinputvalidation = document.getElementById("postcode-input");
if (proceedtocollectionbutton != null) {
  let postcodeinputvalidation = document.getElementById("postcode-input");
  proceedtocollectionbutton.onclick = () => {
    postcodecheckdiv.style.display = "block";
  }
}

postcodeinputvalidation.oninput =() => {
  postcodeinputvalidation.setCustomValidity('');
}

pCode.onclick = function () {
  if (postcodeinputvalidation.checkValidity() == true) {
    const url = document.getElementById("postcodecheck").dataset.postcodecheckControllerUrl;
    const data = { postcode: document.getElementById("postcode-input").value };
    const postcode_message = document.getElementById("postcode_message");
    const postcode_img = document.getElementById("postcode_img");
    console.log(postcode_img);
    console.log(data);
    fetch(url, {
      method: "POST",
      headers: {
        // 'Content-Type': 'application/json'
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams({
        'postcode': document.getElementById("postcode-input").value,
        'product_id': document.getElementById("product_id").value,
        // 'postcode': "9"
      }),
    })
      .then((res) => {
        return res.json()
      })
      .then((data) => {
        // alert(data.postcode);
        const message = JSON.parse(data.postcode);
        if (message.id == 1) {
          postcode_message.style.color = '#0BA32C';
          postcode_message.innerHTML= message.msg;
          postcode_img.src = "http://reuse-home.org.uk/modules/postcodecheck/img/greenTick.svg";
        }
        if (message.id == 2) {
          postcode_message.style.color = '#F77B86';
          postcode_message.innerHTML= message.msg;
          postcode_img.src = "http://reuse-home.org.uk/modules/postcodecheck/img/redCross.svg";
        }

        console.log(data.postcode);

    })
  } else {
    postcodeinputvalidation.setCustomValidity('Please enter a valid UK postcode');
    postcodeinputvalidation.reportValidity();
  }

}
