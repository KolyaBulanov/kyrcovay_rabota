<?php
include("includes/db.php");
include("includes/functions.php");

$tickets = getTickets($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Билеты</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
            z-index: 1000;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-top: 80px;
            margin-bottom: 80px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
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
            z-index: 1000;
        }
    </style>
</head>
<body>
    <header>
        <h1>Билеты</h1>
    </header>

    <div class="content">
        <h2>Список билетов:</h2>

        <?php if (!empty($tickets)) { ?>
            <table>
                <tr>
                    <th>Тип билета</th>
                    <th>Цена</th>
                    <th>Дата покупки</th>
                    <th>Статус</th>
                </tr>
                <?php foreach ($tickets as $ticket) { ?>
                    <tr>
                        <td><?php echo $ticket['TicketType']; ?></td>
                        <td><?php echo $ticket['Price']; ?></td>
                        <td><?php echo $ticket['PurchaseDate']; ?></td>
                        <td><?php echo $ticket['Status']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>Нет доступных билетов.</p>
        <?php } ?>
    </div>

    <div class="navigation">
        <p><a href="index.php">На главную</a></p>
    </div>

    <footer>
        <p>&copy; 2023 Зоопарк</p>
    </footer>
</body>
</html>
