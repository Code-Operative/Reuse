if(document.getElementsByClassName("product-thumbnail").length > 0){
    const thumbnails = document.getElementsByClassName("product-thumbnail");

    for(let i = 0;i<thumbnails.length;i++){
        const thumbnail = thumbnails[i];
        
        if(thumbnail.children[0].attributes[3])
            if(thumbnail.children[0].attributes[3].name =="data-full-size-image-url"){
                console.log("found a way")
                thumbnail.children[0].src = thumbnail.children[0].attributes[3].value;
            }
    }
}