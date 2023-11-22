<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dateTime = $_POST["date_time"];
    $maxTickets = $_POST["max_tickets"];
    $soldTickets = $_POST["sold_tickets"];

    $success = addSession($conn, $dateTime, $maxTickets, $soldTickets);

    if ($success) {
        header("Location: manage_sessions.php");
        exit();
    } else {
        $error_message = "Не удалось добавить сеанс.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить сеанс</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <style>
        body {
            background-color: #f2f2f2;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1em;
            width: 100%;
            position: fixed;
            top: 0;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-top: 60px; /* Отступ от хедера */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
        }

        input {
            margin-top: 5px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .navigation {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .navigation a {
            margin: 5px;
            text-decoration: none;
            color: white;
            padding: 15px 30px;
            border-radius: 5px;
            background-color: #45a049;
            transition: background-color 0.3s;
            width: 100%;
            box-sizing: border-box;
        }

        .navigation a:hover {
            background-color: #4CAF50;
        }

        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Добавить сеанс</h1>
    </header>

    <div class="content">
        <form method="POST">
            <label for="date_time">Дата и время:</label>
            <input type="datetime-local" id="date_time" name="date_time" required>
            <label for="max_tickets">Максимальное количество билетов:</label>
            <input type="number" id="max_tickets" name="max_tickets" required>
            <label for="sold_tickets">Количество проданных билетов:</label>
            <input type="number" id="sold_tickets" name="sold_tickets" required>
            <button type="submit">Добавить</button>
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
