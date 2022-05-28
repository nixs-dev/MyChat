function openForm(userID) {
    var component = document.getElementById("chat");
    
    anotherUserID = userID;
    receivedMessages = [];
    component.style.display = "block";

    document.getElementById("chat-body").innerHTML = "";

}