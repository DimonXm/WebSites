<?php
    $to = 'dmensikov110@mail.ru';
    $from = trim($_POST['email']);

    $text = htmlspecialchars($_POST['message']); // получаем текст от пользователя
    $text = urldecode($text);
    $text = trim($text); 

    $message = '
    <html>
        <body>
            <center>
            <h3>Вам пришло сообщение!</h3>
            <table cellpadding="6" cellspacing="0" width="90%" height="100%" border="2" bordercolog="#DBDBDB">
                <colgroup>
                </colgroup>
                <tr>
                    <th style="background:Khaki;">Почта</th>
                    <th style="background:Khaki;">Сообщение</th>
                </tr>
                <tr>
                    <td style="background-color:LightCyan;" align="center">' . $from . '</td>
                    <td style="background-color:LightCyan;" align="center">' . $text . '</td>
                </tr>
            </table>
        </body>
    </html>';

    $headers = "From: $from\r\n" .
           "Reply-To: $from\r\n" . 
           "X-Mailer: PHP/" . phpversion() . "\r\n" .
           "Content-type: text/html; charset=utf-8\r\n";

    if (mail($to, $from, $message, $headers)) { // Исправлен заголовок письма
        echo 
        '<html>
            <h1>The email has been sent</h1>
            <form action="index.html">
                <input type="submit" value="Go Back" class="submit">
            </form>
        </html>';
    }
    else {
        echo "The email has not been sent";
    }
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: black;
    }

    h1 {
        font-weight: 400;
        font-family: "DM Sans";
        color: #C8C8C8;
        margin-left: 20px;
        margin-top: 15px;
        font-size: 60px;
    }

    input {
        background-color: #F06805;
        color: black;
        border: none;
        font-family: "DM Sans";
        width: 300px;
        height: 60px;
        font-size: 18px;
        border-radius: 15px;
        margin-left: 20px;
        margin-top: -20px;
        font-size: 35px;
        transition: 0.3s;
    }

    input:hover {
        box-shadow: 0 0 0 2px #F06805;
    }

    input:active {
        box-shadow: 0 0 0 2px #F06805;
    }
</style>