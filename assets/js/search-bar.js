let select = document.getElementById("select");
let list = document.getElementById("list");
let dropdown = document.getElementById("dropdown");
let selectText = document.getElementById("selectText");
let inputfield = document.getElementById("inputfield");

let options = document.getElementsByClassName("options");



select.onclick = function () {
    list.classList.toggle("open");
    dropdown.classList.toggle("reverse");
}

for(option of options) {
    option.onclick= function(){
        selectText.innerHTML = this.innerHTML;
        inputfield.placeholder = "Rechercher dans " + selectText.innerHTML;
    }
}