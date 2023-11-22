<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketType = $_POST["ticket_type"];
    $price = $_POST["price"];
    $purchaseDate = $_POST["purchase_date"];
    $status = $_POST["status"];
    $clientID = $_POST["client_id"];
    $sessionID = $_POST["session_id"];

    $success = addTicket($conn, $ticketType, $price, $purchaseDate, $status, $clientID, $sessionID);

    if ($success) {
        header("Location: manage_tickets.php");
        exit();
    } else {
        $error_message = "Не удалось добавить билет.";
    }
}

// Получаем список клиентов
$clients = getClients($conn);

// Получаем список сеансов
$sessions = getSessions($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить билет</title>
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
            margin-top: 60px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
            overflow-x: auto;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Добавить билет</h1>
    </header>

    <div class="content">
        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>

        <form method="POST">
            <label for="ticket_type">Тип билета:</label>
            <select id="ticket_type" name="ticket_type" required>
                <option value="Взрослый">Взрослый</option>
                <option value="Пенсионный">Пенсионный</option>
                <option value="Детский">Детский</option>
            </select>

            <label for="price">Цена:</label>
            <select id="price" name="price" required>
                <option value="450.00">450.00</option>
                <option value="350.00">350.00</option>
                <option value="250.00">250.00</option>
            </select>

            <label for="purchase_date">Дата покупки:</label>
            <input type="date" id="purchase_date" name="purchase_date" required>

            <label for="status">Статус:</label>
            <select id="status" name="status" required>
                <option value="оплачен">Оплачен</option>
                <option value="неоплачен">Неоплачен</option>
            </select>

            <label for="client_id">Клиент ID:</label>
            <select id="client_id" name="client_id" required>
                <?php
                foreach ($clients as $client) {
                    echo '<option value="' . $client["ID"] . '">' . $client["FirstName"] . ' ' . $client["LastName"] . '</option>';
                }
                ?>
            </select>

            <label for="session_id">Сеанс ID:</label>
            <select id="session_id" name="session_id" required>
                <?php
                foreach ($sessions as $session) {
                    echo '<option value="' . $session["ID"] . '">' . $session["DateTime"] . '</option>';
                }
                ?>
            </select>

            <button type="submit">Добавить</button>
        </form>
    </div>
</body>
</html>
