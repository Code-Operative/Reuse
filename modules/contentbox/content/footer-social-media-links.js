// add social media links to the footer
if(document.getElementById("footer")){
    const footer = document.getElementById("footer");

    const contactContainer = footer.getElementsByClassName("block-contact")[0];

    console.log(contactContainer);

    const socialContainer = document.createElement('div');
    socialContainer.className = "social-sharing";

    const socialList = document.createElement('ul');

    const facebookIcon = document.createElement("li");
    facebookIcon.className = "facebook icon-gray";

    const facebookLink = document.createElement("a");
    facebookLink.className = "text-hide";
    facebookLink.href="https://www.facebook.com/reusehome.uk";

    facebookIcon.append(facebookLink);

    socialList.append(facebookIcon);

    const twitterIcon = document.createElement("li");
    twitterIcon.className = "twitter icon-gray";

    const twitterLink = document.createElement("a");
    twitterLink.className = "text-hide";
    twitterLink.href="https://twitter.com/Reuse_Home";

    twitterIcon.append(twitterLink);

    socialList.append(twitterIcon);

    const instagramButton = document.createElement("li");
    instagramButton.className = "instagram icon-gray";

    const instagramLink = document.createElement("a");
    instagramLink.className = "text-hide";
    instagramLink.href="https://www.instagram.com/reusehome/";

    const instagramIcon = document.createElement("img");
    instagramIcon.src = "/img/instagram-icon.svg";
    instagramIcon.className = "instagram-icon-image";

    instagramLink.append(instagramIcon)

    instagramButton.append(instagramLink);

    socialList.append(instagramButton);

    socialContainer.append(socialList);

    contactContainer.append(socialContainer);
}