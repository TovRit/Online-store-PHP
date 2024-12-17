<?php
session_start();
require_once('db.php');

$email = $_SESSION['user'];
$adres = $_POST['adres'];

$sql = "SELECT item, price FROM catalog";
$result = $conn->query($sql);
$result2 = $conn->query($sql);
$fio = $_SESSION['fio'];
$email2 = $_SESSION['email'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product2 = $_POST['product2']; // Получаем выбранный товар из формы
    $number = $_POST['number'];

    if (empty($number) || empty($email) || empty($product2)) {
        $_SESSION['msg'] = "Заполните все поля";
    } else {
 
        $product2 = $conn->real_escape_string($product2); // Очищаем название товара
        $number = $conn->real_escape_string($number); // Очищаем количество
        $email = $conn->real_escape_string($email); // Очищаем email

        $sql2 = "INSERT INTO zakaz (number, status, user, product, adres, fio, email) VALUES ('$number', 'Новое', '$email', '$product2', '$adres', '$fio', '$email2')";

        if ($conn->query($sql2) === TRUE) {
            $_SESSION['msg'] = 'Заявка успешно отправлена';
        } else {
            $_SESSION['msg'] = 'Ошибка отправления заявки: ' . $conn->error; // Выводим ошибку базы данных!
        }
    }
}


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
        <a href="logout.php">Выйти из аккаунта - <?php echo $_SESSION['user']; ?></a>
    </div>
    <div class="main">
        <span><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></span>
        <h1>Товары</h1>
        <p><?php while ($row = $result->fetch_assoc()) {
                echo "| Товар: " . $row['item'] . "   |   Цена: " . $row['price'] . "<br>";
            } ?></p>
    </div>
    <div class="product">
        <form action="" method="POST">
            <h2>Покупка товара</h2>
            <select name="product2">
                <option value="">Выберете товар</option>
                <?php while ($row = $result2->fetch_assoc()) {
                    echo "<option value='" . $row['item'] . "'>" . $row['item'] . "</option>";
                } ?>
            </select>
            <input type='number' min='1' name='number' placeholder='Введите кол-во товара' required>
            <input type='text' name='adres' placeholder='Адрес доставки' required>
            <button type="submit">Купить</button>
        </form>
    </div>
</body>
</html>
