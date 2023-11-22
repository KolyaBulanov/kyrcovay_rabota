<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зоопарк</title>
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
            height: 100vh;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1em;
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
            padding: 15px 30px; /* Увеличил отступы для кнопок */
            border-radius: 5px;
            background-color: #45a049;
            transition: background-color 0.3s;
            width: 100%; /* Добавил ширину 100% для одинаковой ширины кнопок */
            box-sizing: border-box; /* Учел отступы и границы в общей ширине элемента */
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
        <h1>Добро пожаловать в зоопарк</h1>
    </header>

    <div class="navigation">
        <a href="admin_panel/index.php">Административная панель</a>
        <a href="user_sessions.php">Сеансы</a>
        <a href="user_tickets.php">Билеты</a>
        <a href="user_reviews.php">Отзывы</a>
    </div>

    <footer>
        <p>&copy; 2023 Зоопарк</p>
    </footer>
</body>
</html>
