const scrollToTop = () => {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

if(document.getElementsByClassName("js-btn-to-top")[0]){
    const buttonToTop = document.getElementsByClassName("js-btn-to-top")[0];

    buttonToTop.onclick = scrollToTop;
}