if(document.getElementsByClassName("custom-checkbox")[0]){
    const customCheckbox = document.getElementsByClassName("custom-checkbox")[2];

    console.log(customCheckbox);

    if(customCheckbox.children[0].children[2]){
        const agreeStatement = customCheckbox.children[0].children[2];

        console.log(agreeStatement);

        console.log(agreeStatement.innerHTML);

        const firstSpan = document.createElement('span');
        firstSpan.innerHTML = "I agree to the ";

        const termsAndConditions = document.createElement('a');
        termsAndConditions.text = "terms and conditions";
        termsAndConditions.href = "../content/14-seller-terms-conditions";

        const secondSpan = document.createElement('span');
        secondSpan.innerHTML = " and the ";

        const privacyPolicy = document.createElement('a');
        privacyPolicy.text = "privacy policy"
        privacyPolicy.href = "../content/12-privacy-and-cookies-policy";

        agreeStatement.innerHTML = "";

        agreeStatement.append(firstSpan);
        agreeStatement.append(termsAndConditions);
        agreeStatement.append(secondSpan);
        agreeStatement.append(privacyPolicy);
    }
}