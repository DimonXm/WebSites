<?php

    if(isset($_COOKIE["user"])) {
        setcookie("user", $userMail, time() - 3600, "/");
    }
    class user {
        public $defaultAvatar = "uploads/unnamed.jpg";
        public $userPassword;
        public $userEmail;
        public $link;
        public $chekingMail;
        public $insertMail;

        public function __construct($email, $password) {
            $this->userEmail = trim($email); // Почта, получаемая от пользователя

            $this->userPassword = htmlspecialchars($password); // Пароль, получаемый от пользователя
            $this->userPassword = urldecode($this->userPassword);
            $this->userPassword = trim($this->userPassword);
            $this->userPassword = password_hash($this->userPassword, PASSWORD_DEFAULT);

            $this->link = mysqli_connect("localhost", "root", "", "tests"); // Подключение к базе данных

            $this->chekingMail = $this->link->prepare("SELECT id FROM users WHERE email = ?"); // Проверка имеющейся почты
            $this->chekingMail->bind_param("s", $this->userEmail);
            $this->chekingMail->execute();
            $this->chekingMail->store_result();

            $this->insertMail = $this->link->prepare("INSERT INTO users (email, password, avatar) VALUES (?, ?, ?)"); // Добавление почты и пароля в базу данный
            $this->insertMail->bind_param("sss", $this->userEmail, $this->userPassword, $this->defaultAvatar);

            if ($this->chekingMail->num_rows == 0) { // Проверка имеющейся почты
                if ($this->insertMail->execute()) { // Добавление почты, пароля и пути к аватару в базу данный
                    echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
                </head>
                <body>
                    <div>
                        <form action="index.html" method="post">
                            <span>You have been successfully registered, <br> click on the button to go the back.</span>
                            <input type="submit" value="Go to the back">
                        </form>
                    </div>
                </body>
                </html>';
                }
                else {
                    echo "Ошибка, запрос не отправлен";
                }
            }
            else {
                echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
                </head>
                <body>
                    <div>
                        <form action="index.html" method="post">
                            <span>Such mail is already busy, please use <br> another one.</span>
                            <input type="submit" value="Go to the back">
                        </form>
                    </div>
                </body>
                </html>';
            }
        }
    }

    $registUser = new user($_POST["email"], $_POST["password"]); // Вызов класса (создание обьекта на основе класса)

    class email { // Класс для отправки админу письма о пользователях
        public $conn;
        public $sql = "SELECT * FROM users";
        public $result;
        public $to = 'dmensikov110@mail.ru';
        public $message;
        public $i;
        public $row;
        public $messageString;
         public $subject = "Зарегистрирован новый пользователь, список всех пользователей ниже.";
        public $headers = "Content-type: text/html; charset=utf-8";
        public function __construct($object) {
            $this->conn = $object->link; // Получаем ссылку на подключение к базе данных из класса user
            $this->result = mysqli_query($this->conn, $this->sql);

            $this->message = array();

            while($this->row = mysqli_fetch_array($this->result)) {
                $this->i = '
                        <html>
                            <body>
                                <center>
                                <table cellpadding="6" cellspacing="0" width="100%" height="100%" border="1" bordercolog="#7ca4fb">
                                    <tr>
                                        <th style="background: Gainsboro;"> ' . $this->row["id"] . '</th>
                                        <th style="background: Gainsboro;">Email: ' . $this->row["email"] . '</th>
                                        <th style="background: Gainsboro;">Date_reg: ' . $this->row["date_reg"] . '</th>
                                    </tr>
                                </table>
                            </body>
                        </html>';
                array_push($this->message, $this->i); // Добавление данных в конец массива
            }
            $this->messageString = implode("\n", $this->message);
            // mail($this->to, $this->subject, $this->messageString, $this->headers);
        }
    }

    // $Email = new email($registUser); // Вызов класса (создание обьекта на основе класса)
?>

<style>
    body, html {
        margin: 0;
        height: 100%;
        width: 100%;
    }

    div {
        height: 100%;
        width: 100%;
        background-image: url(background.jpg);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        border: 2px solid rgb(3, 148, 252);
        width: 40%;
        height: 30%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    span {
        font-family: "DM Sans";
        font-weight: 400;
        font-size: 24px;
        color: #04142d;
        display: block;
    }

    input {
        font-size: 16px;
        background-color: #f9db57;
        border: none;
        height: 45px;
        width: 30%;
        border-radius: 20px;
        margin-top: 25px;
        transition: 0.3s;
    }

    input:hover {
        transform: scale(110%);
    }

    @media (max-width:480px) {
        form {
            width: 90%;
            height: 40%;
            gap: 30px;
        }

        input {
            width: 60%;
        }

        span {
            font-size: 22px;
            padding-left: 20px;
        }
    }
</style>