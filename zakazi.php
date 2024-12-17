<?php
session_start();
if (!$_SESSION['admin']){
    header('Location: login.php');
}
require_once('db.php');           //подключение бд
$sql = "SELECT * FROM zakaz";
$result = $conn -> query($sql);
$id = $_POST['id'];
$status = $_POST['status'];
$sql2 = "UPDATE zakaz SET status = '$status' WHERE id = '$id'";
$conn -> query($sql2);
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
        <a href="zakazi.php">Заказы</a>
        <a href="admin.php">Добавить товар</a>
        <a href="logout.php">Выйти из аккаунта - <?php echo $_SESSION['admin'];?></a>
    </div>
    <h3>Панель администратора</h3>
    <div class="main">
        <h1>Заказы</h1>
        <table>
            <thead>
                <tr>
                    <th>№ </th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>ПРОДУКТ </th>
                    <th>КОЛИЧЕСТВО </th>
                    <th>СТАТУС </th>
                    <th>ИЗМЕНИТЬ СТАТУС</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $i = 1; while($row = $result -> fetch_assoc()): //Начало цикла ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['fio']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['product']?></td>
                            <td><?php echo $row['number']?></td>
                            <td><?php echo $row['status']?></td>
                            <td>
                                <form action="zakazi.php" method="POST">
                                    <select name="status">
                                        <option value="Подтверждено" <?php if ($row['status'] === 'Подтверждено') echo 'selected';?>>Подтвердить</option>
                                        <option value="Отменено" <?php if ($row['status'] === 'Отмено') echo 'selected';?>>Отменить</option>
                                    </select>
                                    <input type="hidden" name ="id" value="<?php echo $row['id'];?>">
                                    <button type="submit">Изменить</button>
                                </form>
                            </td>
                        </tr>
                    <?php $i++;?>
                    <?php endwhile; //Окончание цикла   ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Заявлений нет</td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</body>
</html>