Для того чтобы расширить блок вывода таблицы, вы можете установить фиксированную ширину, например, 100% от ширины экрана. Вот обновленный код:

```php
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/functions.php");

// Получаем список билетов
$tickets = getTickets($conn);

// Получаем список сеансов
$sessions = getSessions($conn);

// Получаем список клиентов
$clients = getClients($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление билетами</title>
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
            width: 100%; /* Расширение блока до 100% от ширины экрана */
            box-sizing: border-box;
            overflow-x: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap; /* Предотвращает перенос строк */
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .add-button, .edit-button, .delete-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .add-button:hover, .edit-button:hover, .delete-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Управление билетами</h1>
    </header>

    <div class="content">
        <h2>Билеты:</h2>

        <?php
        if (!empty($tickets)) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Тип билета</th><th>Цена</th><th>Дата покупки</th><th>Статус</th><th>Клиент</th><th>Сеанс</th><th>Действия</th></tr>';

            foreach ($tickets as $ticket) {
                echo '<tr>';
                echo '<td>' . $ticket["ID"] . '</td>';
                echo '<td>' . $ticket["TicketType"] . '</td>';
                echo '<td>' . $ticket["Price"] . '</td>';
                echo '<td>' . $ticket["PurchaseDate"] . '</td>';
                echo '<td>' . $ticket["Status"] . '</td>';

                // Отображаем имя клиента
                $client = getClientByID($conn, $ticket["ClientID"]);
                $clientName = $client ? $client["FirstName"] . ' ' . $client["LastName"] : 'Неизвестный клиент';
                echo '<td>' . $clientName . '</td>';

                // Отображаем информацию о сеансе
                $session = getSessionByID($conn, $ticket["Sessions_ID"]);
                $sessionInfo = $session ? $session["DateTime"] : 'Неизвестный сеанс';
                echo '<td>' . $sessionInfo . '</td>';

                // Добавляем кнопки редактирования и удаления
                echo '<td>';
                echo '<a href="update_ticket.php?id=' . $ticket["ID"] . '" class="edit-button">Редактировать</a>';
                echo '<a href="delete_ticket.php?id=' . $ticket["ID"] . '" class="delete-button">Удалить</a>';
                echo '</td>';

                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "Нет доступных билетов.";
        }
        ?>

        <div class="button-container">
            <a href="add_ticket.php" class="add-button">Добавить билет</a>
        </div>
    </div>

    <div class="navigation">
        <p><a href="index.php">Вернуться в административную панель</a></p>
    </div>
</body>
</html>
