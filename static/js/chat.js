var receivedMessages = [];
var indexedBlobs = [];

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
        var url = "/tools/getMessages.php?user=" + anotherUserID;
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
    var blobs = indexedBlobs;
    var requests_forms = [];
    var url = "/tools/sendMessage.php";
    var message_form = new FormData();
    var request = new XMLHttpRequest();
    
    message_form.append("user", anotherUserID);
    message_form.append("msg_text", message);
    
    if(blobs.length > 0) {
        message_form.append("msg_blob", blobs[0]);
        
        blobs.shift()
    }
    else {
        if(message == "") {
            return;
        }
    }
    
    requests_forms.push(message_form);
    
    blobs.forEach(file => {
        message_form = new FormData();
        message_form.append("user", anotherUserID);
        message_form.append("msg_text", "");
        message_form.append("msg_blob", file);
        
        requests_forms.push(message_form);
    });
    
    (function send_msg_list(i) {
        if(i == requests_forms.length) {
            return;
        }
        
        request.open("POST", url, true);
        request.onreadystatechange = function () {
            if(request.readyState == XMLHttpRequest.DONE && request.status == 200) {
                send_msg_list(i + 1);
            }
        };
        request.send(requests_forms[i]);
    })(0);
    
    document.getElementById("message").value = "";
    document.getElementById("blobs-indexed").innerHTML = "";
    indexedBlobs = [];
}

function indexBlobs(fileInput) {
    var previews_div = document.querySelector("#blobs-indexed");
    var reader = new FileReader();
    
    Array.from(fileInput.files).forEach(file => {
        var preview = document.createElement("img");
        
        reader.onloadend = function () {
            preview.src = reader.result;
            previews_div.appendChild(preview);
            indexedBlobs.push(file);
        }
        
        reader.readAsDataURL(file);
    });
    fileInput.files = [];
}