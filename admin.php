<?php
session_start();
if (!$_SESSION['admin']){
    header('Location: login.php');
}
require_once('db.php'); // подключение бд
$item = $_POST['item'];
$price = $_POST['price'];
if (empty($price) || empty($item)){ // проверка на пустые поля
    $_SESSION['msg'] = "Заполните все поля";
} else {
    $sql = "INSERT INTO `catalog` (item,price) VALUES ('$item', '$price')";
    if ($conn -> query($sql) === TRUE){
        $_SESSION['msg'] = "Товар добавлен";        // Добавление товара
    } else {
        $_SESSION['msg'] = "Ошибка добавления товара";      //Ошибка добавление товара в случае какой-либо ошибки
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
<h3>Панель администратора</h3>
    <div class="nav">
        <a href="zakazi.php">Заказы</a>
        <a href="admin.php">Добавить товар</a>
        <a href="logout.php">Выйти из аккаунта - <?php echo $_SESSION['admin'];?></a>
    </div>
    <div class="main">
        <form action="" method="POST">
            <input type="text" placeholder="Название товара" name="item">
            <input type="text" placeholder="Цена" name="price">
            <button type="submit">Добавить товар</button>
            <p><?php echo $_SESSION['msg']; unset($_SESSION['msg']);?></p>
        </form>
    </div>
</body>
</html>