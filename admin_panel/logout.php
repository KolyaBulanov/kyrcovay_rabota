<?php
// Начинаем сессию
session_start();

// Уничтожаем сессию
session_destroy();

// Перенаправляем пользователя на страницу входа
header("Location: login.php");
exit();
?>
