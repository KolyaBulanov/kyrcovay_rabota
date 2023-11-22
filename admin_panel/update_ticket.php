<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/functions.php");

// Проверяем, передан ли ID билета для обновления
if (isset($_GET['id'])) {
    $ticketID = intval($_GET['id']);

    // Получаем информацию о билете по его ID
    $ticket = getTicketByID($conn, $ticketID);

    // Если билет существует
    if ($ticket) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Получаем данные из формы
            $ticketType = mysqli_real_escape_string($conn, $_POST["ticket_type"]);
            $price = floatval($_POST["price"]);
            $purchaseDate = mysqli_real_escape_string($conn, $_POST["purchase_date"]);
            $status = mysqli_real_escape_string($conn, $_POST["status"]);
            $clientID = intval($_POST["client_id"]);
            $sessionsID = intval($_POST["sessions_id"]);

            // Обновляем билет
            $success = updateTicket($conn, $ticketID, $ticketType, $price, $purchaseDate, $status, $clientID, $sessionsID);

            if ($success) {
                header("Location: manage_tickets.php");
                exit();
            } else {
                $error_message = "Не удалось обновить билет.";
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
    <title>Обновить билет</title>
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
        <h1>Обновить билет</h1>
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
                <option value="Взрослый" <?php if ($ticket["TicketType"] === "Взрослый") echo "selected"; ?>>Взрослый</option>
                <option value="Пенсионный" <?php if ($ticket["TicketType"] === "Пенсионный") echo "selected"; ?>>Пенсионный</option>
               <option value="Детский" <?php if ($ticket["TicketType"] === "Детский") echo "selected"; ?>>Детский</option>
            </select>

            <label for="price">Цена:</label>
            <select id="price" name="price" required>
                <option value="450.00" <?php if ($ticket["Price"] === 450.00) echo "selected"; ?>>450.00</option>
                <option value="350.00" <?php if ($ticket["Price"] === 350.00) echo "selected"; ?>>350.00</option>
                <option value="250.00" <?php if ($ticket["Price"] === 250.00) echo "selected"; ?>>250.00</option>
            </select>

            <label for="purchase_date">Дата покупки:</label>
            <input type="date" id="purchase_date" name="purchase_date" value="<?php echo $ticket["PurchaseDate"]; ?>" required>

            <label for="status">Статус:</label>
            <select id="status" name="status" required>
                <option value="оплачен" <?php if ($ticket["Status"] === "оплачен") echo "selected"; ?>>Оплачен</option>
                <option value="неоплачен" <?php if ($ticket["Status"] === "неоплачен") echo "selected"; ?>>Неоплачен</option>
            </select>

            <label for="client_id">Клиент:</label>
            <select id="client_id" name="client_id" required>
                <?php
                foreach ($clients as $client) {
                    $selected = ($client["ID"] === $ticket["ClientID"]) ? "selected" : "";
                    echo "<option value='{$client["ID"]}' $selected>{$client["FirstName"]} {$client["LastName"]}</option>";
                }
                ?>
            </select>

            <label for="sessions_id">Сеанс:</label>
            <select id="sessions_id" name="sessions_id" required>
                <?php
                foreach ($sessions as $session) {
                    $selected = ($session["ID"] === $ticket["Sessions_ID"]) ? "selected" : "";
                    echo "<option value='{$session["ID"]}' $selected>{$session["DateTime"]}</option>";
                }
                ?>
            </select>

            <button type="submit">Обновить</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "Билет не найден.";
    }
} else {
    echo "Не указан ID билета.";
}
?>
