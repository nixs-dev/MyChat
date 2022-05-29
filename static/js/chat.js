var receivedMessages = [];

function showProfile(param) {
    if (param == "Mine") {
        window.location.href = '/views/my_profile.php';
    }
    else {
        window.location.href = '/views/other_profile.php?id=' + anotherUserID;
    }
}

//setInterval(updateUserStatus, 3000);

function updateUserStatus()
{
    requestUsers = new XMLHttpRequest();
    var url = "/tools/getUserStatuses.php";
    requestUsers.open("GET", url, true);
    requestUsers.onreadystatechange = function() {

        if (requestUsers.readyState == 4) {
            var r = JSON.parse(requestUsers.responseText);

            r.forEach(user => {
                if(user.id != userID) {
                    var userDiv = document.getElementById(user.id);

                    var status;
                    var cor;

                    if (user.status == "Online") {
                        status = "Online";
                        cor = "#00FF00";
                    }
                    else {
                        status = user.status;
                        cor = "#FF0000";
                    }

                    userDiv = userDiv.querySelector("#status");
                    userDiv.innerHTML = status;
                    userDiv.style.color = cor;
                }
            });

        }
    };
    requestUsers.send();

    requestChangeMyStatus = new XMLHttpRequest();
    var url = "/tools/updateMyStatus.php";
    var formData = new FormData();
    formData.append("user", userID);
    requestChangeMyStatus.open("POST", url, true);
    requestChangeMyStatus.onreadystatechange = function() {

        if (requestChangeMyStatus.readyState == 4) {
            
        }
    };
    requestChangeMyStatus.send(formData);
}

setInterval(updateMessagesList, 500);

function updateMessagesList()
{
    if (document.getElementById("chat").style.display == "block") {
        requestMessages = new XMLHttpRequest();
        var url = "/tools/getMessages.php?main=" + userID + "&user=" + anotherUserID;
        requestMessages.open("GET", url, true);
        requestMessages.onreadystatechange = function () {

            if (requestMessages.readyState == 4) {
                var r = JSON.parse(requestMessages.responseText);
                
                var chat = document.getElementById("chat-body");

                r.forEach(msg => {

                    if (receivedMessages.indexOf(msg["id"]) == -1 && msg["text_content"] != null) {
                        
                        var element = document.createElement("div");

                        if (msg["sentby"] == userID) {
                            element.className = "msg";
                        }
                        else {
                            element.className = "msgAnother";
                        }

                        element.textContent = msg["text_content"];
                        
                        if (msg["blob_content"]) {
                            var blob = document.createElement("img");
                            blob.id = "blob-image";
                            blob.src = "data:image/jpg;charset=utf8;base64, " + btoa(msg["blob_content"]);
                            element.appendChild(blob);
                        }

                        chat.appendChild(element);

                        setMessageAsReceived(msg["id"]);
                    }
                });

            }
        };
        requestMessages.send();
    }
}

function setMessageAsReceived(id) {
    receivedMessages.push(id);
}

function sendMessage() {
    var message = document.getElementById("message").value;

    request = new XMLHttpRequest();
    var url = "/tools/sendMessage.php?main=" + userID + "&user=" + anotherUserID + "&msg=" + message;
    request.open("GET", url, true);
    request.onreadystatechange = function () {};
    request.send();

    document.getElementById("message").value = "";
}
