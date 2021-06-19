if(document.getElementById("customer-form")){
    const form = document.getElementById("customer-form");
    
    const firstSection = form.children[0].children[0];

    if(form.children[0].children[0].children[0].innerHTML.includes("itle")){
        firstSection.style.display = 'none';
    }
}