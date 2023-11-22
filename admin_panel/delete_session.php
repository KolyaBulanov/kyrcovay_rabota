<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $sessionID = $_GET["id"];

    include("../includes/db.php");
    include("../includes/functions.php");

    $success = deleteSession($conn, $sessionID);

    if ($success) {
        header("Location: manage_sessions.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Удаление сеанса</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Удаление сеанса</h1>
    </header>

    <div class="content">
        <h2>Вы уверены, что хотите удалить этот сеанс?</h2>
        <p>Это действие нельзя будет отменить.</p>

        <form method="POST">
            <button type="submit">Удалить сеанс</button>
        </form>
    </div>

    <div class="navigation">
        <p><a href="manage_sessions.php">Вернуться к управлению сеансами</a></p>
        <p><a href="index.php">Вернуться в административную панель</a></p>
    </div>

    <footer>
        <p>&copy; 2023 Зоопарк</p>
    </footer>
</body>
</html>
