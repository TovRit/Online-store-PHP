<?php
session_start();
require_once('db.php');             //подключение бд
$login = $_POST['login'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$fio = $_POST['full_name'];
if (empty($login) || empty($pass) || empty($email) || empty($fio) || empty($phone)){    //проверка на пустые поля
    $_SESSION['msg'] = "Заполните все поля";
} else {
    $sql = "INSERT INTO `user` (id_role,login, password, full_name, phone, email) VALUES ('1','$login', '$pass', '$fio', '$phone', '$email')";
    if ($conn -> query($sql) === TRUE){                  //Регистрация
        $_SESSION['msg'] = "Успешная регистрация";
        header('Location: login.php');
    } else {
        $_SESSION['msg'] = "Ошибка регистрации";              //В случае ошибки, выдает "ошибка регистрации"
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav.css">
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
            <p>Регистрация</p>
            <input type="text" placeholder="Логин" name="login"><br>
            <input type="password" placeholder="Пароль" name="pass"><br>
            <input type="text" placeholder="ФИО" name="full_name"><br>
            <input type="phone" placeholder="Телефон" name="phone"><br>
            <input type="email" placeholder="Емаил" name="email"><br>
            <button type="submit">Зарегестрироватся</button>
            <p><?php echo $_SESSION['msg']; unset($_SESSION['msg']);?></p>
        </form>
    </div>
</body>
</html>