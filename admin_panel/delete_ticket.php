<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $ticketID = $_GET["id"];

    include("../includes/db.php");
    include("../includes/functions.php");

    $success = deleteTicket($conn, $ticketID);

    if ($success) {
        header("Location: manage_tickets.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Удаление билета</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Удаление билета</h1>
    </header>

    <div class content>
        <h2>Вы уверены, что хотите удалить этот билет?</h2>
        <p>Это действие нельзя будет отменить.</p>

        <form method="POST">
            <button type="submit">Удалить билет</button>
        </form>
    </div>

    <div class="navigation">
        <p><a href="manage_tickets.php">Вернуться к управлению билетами</a></p>
        <p><a href="index.php">Вернуться в административную панель</a></p>
    </div>

    <footer>
        <p>&copy; 2023 Зоопарк</p>
    </footer>
</body>
</html>
