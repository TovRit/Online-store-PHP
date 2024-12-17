<?php
session_start();
require_once('db.php');          //подключение бд
$login = $_POST['login'];
$pass = $_POST['pass'];
$email = $_POST['email'];
if (empty($login) || empty($pass)) {                 //проверка на пустые поля
    $_SESSION['msg'] = "Заполните все поля";
} else {
    if ($login == 'sklad' and $pass == '123qwe') {
        $_SESSION['admin'] = 'admin';
        header('location: zakazi.php');
    } else {
        $sql = "SELECT * FROM user WHERE login = '$login' AND password = '$pass'";
        $result = $conn -> query($sql);
        $row = $result -> fetch_assoc();
        if ($result -> num_rows > 0){             //проверка на логин и пароль
            $_SESSION['msg'] = "Успешный вход";
            $_SESSION['user'] = $login;
            $_SESSION['fio'] = $row['full_name'];
            $_SESSION['email'] = $row['email'];
            header('Location: catalog.php');
        } else {
            $_SESSION['msg'] = "Неверный логин или пароль";              
        }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="">
    <title>Document</title>
</head>
<body>
<h2>Авоська</h2>
    <div class="nav">
        <a href="login.php">Вход</a>
        <a href="register.php">Регистрация</a>
    </div>
    <div class="main">
        <form action="" method="POST">
            <p>Вход</p>
            <input type="text" placeholder="Логин" name="login"><br>
            <input type="text" placeholder="Пароль" name="pass"><br>
            <button type="submit">Войти</button>
            <p><?php echo $_SESSION['msg']; unset($_SESSION['msg']);?></p>
        </form>
    </div>
</body>
</html>