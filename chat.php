<html>

<head>
    <title>Chat</title>
    <meta charset="UTF-8">
    <script src="Tools/Session.js"></script>
    <script src="Tools/Chat.js"></script>
    <script src="Tools/Profile.js"></script>
    <script src="ComponentsCtrl/popup.js"></script>
    <link rel="stylesheet" href="styleChat.css">
</head>

<body onload="getSession(); setPhotoProfile();">

    <div id="sidebar">
        <div id="searchBar">
            <input type="text" placeholder="Pesquisar">
        </div>
        <div id="profilePhoto">
            <img id="photoMenu" src="Images/UserIcon.png">
        </div>
        <div id="options">
            <div>
                <a href="http://localhost/mychat/otherPages/MyProfile.php"><label>Meu Perfil</label></a>
            </div>
            <div>
                <label>Configurações</label>
            </div>
        </div>
        <button id="logout" onclick="finishSession()"><img src="Images/logoutIcon.png"></button>
    </div>
    <div id="bodyPage">
        <div id="usersPanel">
            <?php
                require_once dirname(__FILE__) . "/Models/User.php";
                require_once dirname(__FILE__) . "/Controllers/UserControl.php";

                session_start();

                $userProfileModel = "
                                        <div id='UserID' class='profile' onclick='openForm(this.id);'>
                                            <img src='profilePhoto' alt='UserIcon' width='100' height='100'>
                                            <h5 style='text-align: center'>UserName</h5>
                                            <h5 id='status' style='text-align: center; color: #000000'>UserStatus</h5>
                                        </div>
                                    ";

                $ctrl = new UserControl();

                $users = $ctrl->findAll();

                foreach ($users as $user) {

                    if ($user->getId() != $_SESSION['id']) {

                        $profile = $userProfileModel;

                        $profilePhoto = $user->getImagem();

                        if (!is_null($profilePhoto)) {
                            $profile = str_replace("profilePhoto", "data:image/jpg;charset=utf8;base64," . base64_encode($profilePhoto), $userProfileModel);
                        } else {
                            $profile = str_replace("profilePhoto", "Images/UserIcon.png", $userProfileModel);
                        }

                        $profile = str_replace("UserName", $user->getNick(), $profile);
                        $profile = str_replace("UserID", $user->getId(), $profile);

                        if ($user->getStatus() == 1) {
                            $status = "Online";
                            $color = "#0ed200";
                        } else {
                            $status = "Offline";
                            $color = "#dd0c00";
                        }

                        $profile = str_replace("UserStatus", $status, $profile);
                        $profile = str_replace("#000000", $color, $profile);

                        echo $profile;
                    }
                }
            ?>
        </div>
        <div class="form-popup" id="chat">
            <form class="form-container">

                <div id="chat-body">

                </div>

                <div id="chat-footer">
                    <input type="text" id="message" placeholder="Type here" name="message" required>

                    <button type="button" id="send" onclick="sendMessage();">Send</button>

                    <button type="button" id="info" onclick="showProfile('Other');">Info</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>