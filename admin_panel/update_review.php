<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reviewID = $_POST["review_id"];
    $clientID = $_POST["client_id"];
    $reviewText = $_POST["review_text"];

    $success = updateReview($conn, $reviewID, $clientID, $reviewText);

    if ($success) {
        header("Location: manage_reviews.php");
        exit();
    } else {
        $error_message = "Не удалось обновить отзыв.";
    }
}


if (isset($_GET["id"])) {
    $reviewID = $_GET["id"];
    $review = getReviewByID($conn, $reviewID);

    if (!$review) {
        header("Location: manage_reviews.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование отзыва</title>
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
            z-index: 1000;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-top: 80px;
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
            font-weight: bold;
        }

        input, textarea {
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
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
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
        <h1>Редактирование отзыва</h1>
    </header>

    <div class="content">
        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
        <form method="POST">
            <input type="hidden" name="review_id" value="<?php echo $review['ID']; ?>">
            <label for="client_id">ID пользователя:</label>
            <input type="text" id="client_id" name="client_id" value="<?php echo $review['ClientID']; ?>" required>

            <label for="review_text">Отзыв:</label>
            <textarea id="review_text" name="review_text" rows="4" required><?php echo $review['Comment']; ?></textarea>
            
            <button type="submit">Сохранить</button>
        </form>
    </div>
    
    <div class="navigation">
        <p><a href="manage_reviews.php">Вернуться к управлению отзывами</a></p>
        <p><a href="index.php">Вернуться в административную панель</a></p>
    </div>

    <footer>
        <p>&copy; 2023 Зоопарк</p>
    </footer>
</body>
</html>
