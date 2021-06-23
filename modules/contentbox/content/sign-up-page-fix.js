if(document.getElementsByClassName("form-control-label")[0]){
    const socialTitleLabel = document.getElementsByClassName("form-control-label")[0];

    let label = socialTitleLabel.innerHTML;

    if(label.includes("Social"))
        socialTitleLabel.innerHTML = "Title";
}