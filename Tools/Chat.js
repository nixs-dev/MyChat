var receivedMessages = [];

function showProfile(param) {

    if (param == "Mine") {

        window.location.href = 'http://localhost/mychat/otherPages/MyProfile.php';

    }
    else {

        window.location.href = 'http://localhost/mychat/otherPages/OtherProfile.php?id=' + anotherUserID;

    }

}


setInterval(updateUserStatus, 1000);

function updateUserStatus()
{
    request = new XMLHttpRequest();
    var url = "http://localhost/mychat/Tools/getUserStatuses.php";
    request.open("GET", url, true);
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var r = JSON.parse(request.responseText);

            r.forEach(user => {
                var userDiv = document.getElementById(user.id);
                var status;
                var cor;

                if (user.status == 1) {
                    status = "Online";
                    cor = "#0ed200";
                }
                else {
                    status = "Offline";
                    cor = "#dd0c00";
                }

                userDiv = userDiv.querySelector("#status");
                userDiv.innerHTML = status;
                userDiv.style.color = cor;
            });

        }
    };
    request.send();
}

setInterval(updateMessagesList, 500);

function updateMessagesList()
{
    if (document.getElementById("chat").style.display == "block") {
        request = new XMLHttpRequest();
        var url = "http://localhost/mychat/Tools/getMessages.php?main=" + userID + "&user=" + anotherUserID;
        request.open("GET", url, true);
        request.onreadystatechange = function () {

            if (request.readyState == 4) {

                var r = JSON.parse(request.responseText);
                
                var chat = document.getElementById("chat-body");

                r.forEach(msg => {


                    if (receivedMessages.indexOf(msg["id"]) == -1 && msg["content"] != null) {
                        
                        var element = document.createElement("div");

                        if (msg["sentby"] == userID) {
                            element.className = "msg";
                        }
                        else {
                            element.className = "msgAnother";
                        }

                        element.textContent = msg["content"];

                        chat.appendChild(element);

                        setMessageAsReceived(msg["id"]);
                    }
                });

            }
        };
        request.send();
    }
}

function setMessageAsReceived(id) {
    receivedMessages.push(id);
}

function sendMessage() {
    var message = document.getElementById("message").value;

    request = new XMLHttpRequest();
    var url = "http://localhost/mychat/Tools/sendMessage.php?main=" + userID + "&user=" + anotherUserID + "&msg=" + message;
    request.open("GET", url, true);
    request.onreadystatechange = function () {};
    request.send();

    document.getElementById("message").value = "";
}
