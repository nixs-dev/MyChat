var background = "null";
var image = "null";
var id = "null";
var name = "null";

function ChangeBackground(fileInput) {
    var preview = document.getElementById("frame");
    var reader = new FileReader();
    var file = fileInput.files[0];

    reader.onloadend = function () {
        preview.style.backgroundImage = "url('" + reader.result + "')";
        background = file;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.style.backgroundImage = "url('')";
    }

    changeButtonStatus();
}

function ChangeProfilePhoto(fileInput) {
    var preview = document.getElementById("photo");
    var reader = new FileReader();
    var file = fileInput.files[0];

    reader.onloadend = function () {
        preview.src = reader.result;
        image = file;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }

    changeButtonStatus();
}

function changeButtonStatus() {
    var saveButton = document.getElementById("save");

    if (saveButton.disabled) {
        saveButton.disabled = false;
    }
}

function TextToInput(tagID){
    var elem = document.getElementById(tagID), newNode;
    var parent = elem.parentNode;

    newNode = document.createElement("input");
    newNode.onblur = function() { InputToText(tagID) };
    newNode.onchange = function () {
        name = newNode.value;
        changeButtonStatus();
    };
    newNode.value = elem.innerHTML;

    newNode.id = tagID;
    parent.replaceChild(newNode, elem);
    newNode.focus();
}

function InputToText(tagID){
    var elem = document.getElementById(tagID), newNode;
    var parent = elem.parentNode;

    newNode = document.createElement("label");
    newNode.onclick = function() {TextToInput(tagID)};
    newNode.innerHTML = elem.value;

    newNode.id = tagID;
    parent.replaceChild(newNode, elem);
}

function showPasswordInput() {
    var input = document.getElementById("ChangePassword");
    var txt = document.getElementById("txtChangePass");

    if (input.style.display == "none") {
        input.style.display = "block";
        txt.innerHTML = "Cancelar";
    }
    else {
        input.style.display = "none";
        txt.innerHTML = "Alterar senha";
    }
}
