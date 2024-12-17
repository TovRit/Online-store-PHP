<?php
session_start();
unset ($_SESSION['user']);           //Выход из сессии
unset ($_SESSION['admin']);             //Выход из сессии
unset ($_SESSION['fio']);               //Выход из сессии
unset ($_SESSION['email']);
header('Location: login.php');
?>