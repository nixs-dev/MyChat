var userBackground = null;
var userImage = null;
var userID = null;
var anotherUserID = null;
var userName = null;

function getSession() {
    request = new XMLHttpRequest();
    var url = "/Tools/getPhpSession.php";
    request.open("GET", url, false);
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;

            if (response != "error") {

                var r = JSON.parse(response);

                userBackground = r["background"];
                userImage = r["image"];
                userID = r["id"];
                userName = r["username"];
            }
            else {
                window.location.href = 'http://localhost/mychat/';
            }
        }
    };
    request.send();
}

function finishSession() {
    request = new XMLHttpRequest();
    var url = "Tools/finishSession.php";
    request.open("GET", url, true);
    request.onreadystatechange = function() {

        window.location.href = '/';
        
    };
    request.send();
}

