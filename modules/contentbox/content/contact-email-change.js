// change email link at the top of the site
if(document.getElementsByClassName("header__contact__item")[0]){
    const emailLink = document.getElementsByClassName("header__contact__item")[0];

    if(emailLink.href == "mailto:contact@code-operative.co.uk"){
        emailLink.href = "mailto:info@reuse-home.org.uk";

        const mailIcon = emailLink.innerHTML.split(`contact`)[0];

        emailLink.innerHTML = mailIcon + "info@reuse-home.org.uk";
    }

    const emailLinkFooter = document.getElementById("footer_contact").children[1].children[0];

    console.log(emailLinkFooter);

    emailLinkFooter.href = "mailto:info@reuse-home.org.uk";
    emailLinkFooter.innerHTML = "Email us: info@reuse-home.org.uk";
}