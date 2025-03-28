<?php
    if(!isset($_COOKIE["user"])) {
        header("Location: ../login.php");
    }else {
        echo "<span class='user_cookie'>User: " . $_COOKIE["user"] . "</span>";
    }

    $path;
    $link = mysqli_connect("localhost", "root", "", "tests");
    $stmt = $link->prepare("SELECT avatar FROM users WHERE email = ?");
    $stmt->bind_param('s', $_COOKIE['user']);
    $stmt->execute();
    $stmt->bind_result($path);
    $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Duru+Sans&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
    <link rel="stylesheet" href="style-player.css">
    <style>.content-list div .ASPIRE {
            width: 40px;
            height: 40px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border: none;
            background-image: url(images/imagesoftracks/ASPIRE.jpg);
    }
        .user_cookie {
            position: absolute;
            bottom: 10px;
            border-radius: 5px;
            right: 30px;
            z-index: 10;
            font-family: "DM Sans";
            color: aqua;
            font-size: 24px;
    }
        .avatar-img {
        position: absolute;
        width: 50px;
        height: 50px;
        bottom: 50px;
        right: 30px;
        border-radius: 10px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url("../<?php echo $path; ?>");
    }

        .form-Avatar {
            position: absolute;
            bottom: 25px;
            right: 110px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .file {
            color: aqua;
            font-size: 14px;
        }

        .submit {
            border-radius: 10px;
            background-color: rgba(249, 82, 110, 0.9254901961);
            border: none;
            height: 20px;
            width: 100%;
            font-size: 14px;
            font-family: "DM Sans";
        }

    </style>
</head>
<body>
    <div class="player">
        <audio id="audio" preload="metadata"></audio>
        <div class="controls">
            <div class="track-info">
                <span id="trackTitle" class="span">Loneliness</span>
            </div>
            <div class="buttons">
                <button id="prevBtn"><span></span><span></span><span></span><span></span></button>
                <button id="stopBtn" class="stopBtn"><span></span><span></span><span></span></button>
                <button id="nextBtn"><span></span><span></span><span></span><span></span></button>
            </div>
            <input type="range" value="0" id="seekBar">
        </div>
        <div class="content-list">
            <div onclick="clickTrack(0)"><h4>1.</h4><div class="BREATHING"></div><span>BREATHING - Sxtreen, IDLAYN, HXRI!ZON</span></div>
            <div onclick="clickTrack(1)"><h4>2.</h4><div class="Loneliness"></div><span>Loneliness - LXRY PXNK, CHMCL SØUP</span></div>
            <div onclick="clickTrack(2)"><h4>3.</h4><div class="TIME"></div><span>Time - LXRY PXNK, XTOM</span></div>
            <div onclick="clickTrack(3)"><h4>4.</h4><div class="XCELLA"></div><span>STEREO WAVE - XCELLA, maaayheem</span></div>
            <div onclick="clickTrack(4)"><h4>5.</h4><div class="Frozen"></div><span>Frozen - LXRY PXNK, KHXXMU</span></div>
            <div onclick="clickTrack(5)"><h4>6.</h4><div class="Rain"></div><span>Rain - LXRY PXNK, CHMCL SØUP</span></div>
            <div onclick="clickTrack(6)"><h4>7.</h4><div class="ASPIRE"></div><span>ASPIRE - FLONEX, Autxmn Love</span></div>
        </div>
        <div class="track-photo"></div>
    </div>
    <div class="avatar">
        <form class="form-Avatar" action="../upload.php" method="post" enctype="multipart/form-data">
            <input class="file" type="file" name="avatar" id="avatar">
            <input class="submit" type="submit" value="Submit">
        </form>
    </div>
    <div class="avatar-img"></div>
    <script src="script.js"></script>
</body>
</html>