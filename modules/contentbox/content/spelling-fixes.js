//spelling fixes

const previeus = document.getElementsByClassName("button_previeus");

if(previeus){
    for(let i = 0;i<previeus.length;i++){
        if(previeus[i].innerHTML == "Previeus")
            previeus[i].innerHTML = "Previous";
    }
}