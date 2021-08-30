

function setPhotoProfile() {
    if (userImage != "") {
        document.getElementById("profilePhoto").querySelector("img").src = 'data:image/jpg;charset=utf8;base64,' + userImage;
    }
}

function setBackgroundProfile() {
    if (userBackground != "") {
        document.getElementById('frame').style.backgroundImage = "url('data:image/jpg;charset=utf8;base64," + userBackground + "')";
    }
}

function fillProfile() {
    getSession();

    var IDField = document.getElementById("id");
    var UserField = document.getElementById("username");


    IDField.innerHTML += userID;
    UserField.innerHTML += userName;
    setPhotoProfile();
    setBackgroundProfile();
}

function Save() {

    id = userID;

    var data = new FormData();

    data.append("background", background);
    data.append("image", image);
    data.append("id", id);
    data.append("name", name);

    xhttp = new XMLHttpRequest();

    var url = "http://localhost/mychat/Tools/updateProfile.php";

    xhttp.open("POST", url, true);

    xhttp.onreadystatechange = function() {

        if (xhttp.readyState == 4) {

            var response = xhttp.responseText;

            alert(response);
        }
    };

    xhttp.send(data);
}