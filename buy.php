<?php
session_start();
require_once('db.php');   // Подключение бд
$email = $_SESSION['user'];
$sql = "SELECT * FROM zakaz WHERE user = '$email'"; //запрос к бд
$result = $conn -> query($sql);     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <title>Document</title>
</head>
<body>
    <div class="nav">
        <a href="catalog.php">Товары | заказать товар</a>
        <a href="buy.php">Мои заказы</a>
        <a href="logout.php">Выйти из аккаунта - <?php echo $_SESSION['user'];?></a>
    </div>
    <div class="main">
        <h2>Мои заказы</h3>
        <?php while($row = $result -> fetch_assoc()) {echo "<p>"."Продукт: ".$row['product']." | Количество: ".$row['number']." | Статус: ".$row['status']."</p>";}   //Заказы  ?>  
    </div>
</body>
</html>