<?php
    if(isset($_COOKIE["user"])){
        header("Location: player/player.php");
    }
    class loginer {
        public $url = "player/player.php";
        public $userMail;
        public $userPassword;
        public $link;
        public $stmt;
        public $passwordInDataBase;
        public $userMessage;

        public function __construct($email, $password) {

            $this->link = mysqli_connect("localhost", "root", "", "tests");
            
            $this->userMail = trim($email);

            $this->userPassword = htmlspecialchars($password);
            $this->userPassword = urldecode($this->userPassword);
            $this->userPassword = trim($this->userPassword);

            $this->stmt = $this->link->prepare("SELECT password FROM users WHERE email = ?");
            $this->stmt->bind_param("s", $this->userMail);
            $this->stmt->execute();
            $this->stmt->store_result();
            if ($this->stmt->num_rows > 0) {
                $this->stmt->bind_result($this->passwordInDataBase);
                $this->stmt->fetch();
                
                if (password_verify($this->userPassword, $this->passwordInDataBase)){
                    setcookie("user", $this->userMail, time() + 3600, "/");
                    header("Location: $this->url");
                }else {
                    $this->userMessage = '  <div class="unknown_password_and_email">
                                            Unknown password
                                            </div>';
                    echo $this->userMessage;
                }
            }if($this->stmt->num_rows == 0){
                $this->userMessage = '  <div class="unknown_password_and_email">
                                            Unknown email
                                            </div>';
                echo $this->userMessage;
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $log = new loginer($_POST['email'], $_POST['password']);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="login.php" method="post">
            <h2>Login</h2>
            <input type="email" placeholder="Enter e-mail" name="email" required>
            <input type="password" placeholder="Enter password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

<style>
    body, html {
        margin: 0;
        width: 100%;
        height: 100%;
    }

    form {
        border: 2px solid rgb(3, 148, 252);
        height: 50%;
        width: 30%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    input {
        display: block;
        font-family: "DM Sans";
        font-size: 20px;
        padding-left: 15px;
        display: block;
        margin-bottom: 20px;
        width: 80%;
        height: 40px;
        border-radius: 20px;
        border: none;
        outline: none;
        background-color: #c8c8c89b;
    }

    input:nth-child(4) {
        background-color: #7ca4fb;
        transition: 0.3s;
    }

    input:nth-child(4):hover {
        transform: scale(110%);
    }

    div {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        background-image: url(background_login.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    h2 {
        color: #7ca4fb;
        font-family: "DM Sans";
        font-weight: 400;
        margin-top: -30px;
    }

    
    .unknown_password_and_email{
        position: absolute;
        font-size: 20px;
        font-family: "DM Sans";
        width: 20%;
        left: 40%;
        top: 2%;
        height: 5%;
        color: white;
        background-image: none;
        background-color: rgb(235, 67, 67);
        border-radius: 20px;
        animation-name: slidein;
        animation-duration: 0.5s;
    }
    @keyframes slidein {
        from {
            top: 0;
        }
        to {
            top: 2%;
        }
    }
</style>

