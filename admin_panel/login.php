<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Проверка логина и пароля (замените на вашу логику аутентификации)
    if ($username === "admin" && $password === "password") {
        $_SESSION['admin'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Неправильный логин или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в административную панель</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <style>
        body {
            background-color: #f2f2f2;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 10vh 0; /* Одинаковые отступы сверху и снизу */
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh; /* Уменьшил высоту контейнера, чтобы влезало на экран */
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
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
        <h1>Вход в административную панель</h1>
    </header>

    <div class="login-container">
        <h2>Войти:</h2>

        <form method="POST">
            <div class="form-group">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit">Войти</button>
            </div>
        </form>

        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2023 Зоопарк</p>
    </footer>
</body>
</html>
