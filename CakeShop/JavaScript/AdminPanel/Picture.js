const file = document.querySelector("#file");
file.addEventListener("change", function(e){
    const file = e.target.files[0]; 
    const url = URL.createObjectURL(file);
    document.querySelector("#picture").src = url;
    if(document.querySelector("#picture").style.display == "none"){
        document.querySelector("#picture").style.display = "inline";
    }
});
