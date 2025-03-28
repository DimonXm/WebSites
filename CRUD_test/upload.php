<?php
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["avatar"]["name"]);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $OK = 1;

    if(isset($_POST["submit"])) {
        $chek = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($chek !== false) {
            echo "Файл является изображением";
            $OK = 1;
        }else {
            echo "Файл не является изображением";
            $OK = 0;
        }
    }

    if(file_exists($targetFile)) {
        echo "Файл с таким именем уже существует";
        $OK = 0;
    }

    if($_FILES["avatar"]["size"] > 5000000) {
        echo "Файл слишком большой";
        $OK = 0;
    }

    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
        echo "Извините, только JPG, JPEG, PNG и GIF файлы разрешены.";
        $OK = 0;
    }

    if($OK == 0) {
        echo "Файл не был загружен";
    }else {
        $link = mysqli_connect("localhost", "root", "", "tests");
        
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile);
        $stmt = $link->prepare("UPDATE users SET avatar = ? WHERE email = ?");
        $stmt->bind_param("ss", $targetFile, $_COOKIE["user"]);
        if($stmt->execute()) {
            echo "Файл успешно отправлен, перейдите на предыдущую страницу и обновите ее чтобы просмотреть результат.";
        }else {
            echo "Файл не был отправлен(";
        }
    }
?>