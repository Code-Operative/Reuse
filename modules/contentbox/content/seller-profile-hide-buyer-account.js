if(document.getElementById("main")){
    const main = document.getElementById("main");

    //detect if the page has an h1 tag with Seller Account written on it
    if(main.children[1].children[1].children[0].getElementsByTagName("h1")[0].innerHTML=="Seller Account"){
        //dismiss the h1 element with "Your account" written on
        main.children[0].children[0].style.display = "none";
        const linkCollection = main.children[1].children[1].children[0].getElementsByTagName("a");

        //dismiss the rest of the buyer accout stuff
        for(let i = 0;i<7;i++){
            linkCollection[i].style.display = "none";
        }
    }
}