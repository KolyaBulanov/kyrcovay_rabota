<?php
// Подключение к базе данных
include("db.php");

// Функции для работы с билетами
function getTickets($conn) {
    $query = "SELECT * FROM Tickets";
    $result = mysqli_query($conn, $query);
    $tickets = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tickets[] = $row;
        }
    }

    return $tickets;
}

function getTicketByID($conn, $ID) {
    $ticketID = intval($ID);
    $query = "SELECT * FROM Tickets WHERE ID = $ID";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

function addTicket($conn, $TicketType, $Price, $PurchaseDate, $Status, $ClientID, $Sessions_ID) {
    $ticketType = mysqli_real_escape_string($conn, $TicketType);
    $price = floatval($Price);
    $purchaseDate = mysqli_real_escape_string($conn, $PurchaseDate);
    $status = mysqli_real_escape_string($conn, $Status);
    $clientID = intval($ClientID);
    $sessionsID = intval($Sessions_ID);

    $query = "INSERT INTO Tickets (TicketType, Price, PurchaseDate, Status, ClientID, Sessions_ID) VALUES ('$ticketType', $price, '$purchaseDate', '$status', $clientID, $sessionsID)";
    return mysqli_query($conn, $query);
}

function updateTicket($conn, $ID, $TicketType, $Price, $PurchaseDate, $Status, $ClientID, $Sessions_ID) {
    $ticketID = intval($ID);
    $ticketType = mysqli_real_escape_string($conn, $TicketType);
    $price = floatval($Price);
    $purchaseDate = mysqli_real_escape_string($conn, $PurchaseDate);
    $status = mysqli_real_escape_string($conn, $Status);
    $clientID = intval($ClientID);
    $sessionsID = intval($Sessions_ID);

    $query = "UPDATE Tickets SET TicketType = '$ticketType', Price = $price, PurchaseDate = '$purchaseDate', Status = '$status', ClientID = $clientID, Sessions_ID = $sessionsID WHERE ID = $ticketID";
    return mysqli_query($conn, $query);
}

function deleteTicket($conn, $ID) {
    $ticketID = intval($ID);
    $query = "DELETE FROM Tickets WHERE ID = $ticketID";
    return mysqli_query($conn, $query);
}

// Функции для работы с клиентами
function getClients($conn) {
    $query = "SELECT * FROM Clients";
    $result = mysqli_query($conn, $query);
    $clients = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $clients[] = $row;
        }
    }

    return $clients;
}

function getClientByID($conn, $clientID) {
    $clientID = intval($clientID);
    $query = "SELECT * FROM Clients WHERE ID = $clientID";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

function addClient($conn, $firstName, $lastName, $email, $phoneNumber) {
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $email = mysqli_real_escape_string($conn, $email);
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);

    $query = "INSERT INTO Clients (FirstName, LastName, Email, PhoneNumber) VALUES ('$firstName', '$lastName', '$email', '$phoneNumber')";
    return mysqli_query($conn, $query);
}

function updateClient($conn, $clientID, $firstName, $lastName, $email, $phoneNumber) {
    $clientID = intval($clientID);
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $email = mysqli_real_escape_string($conn, $email);
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);

    $query = "UPDATE Clients SET FirstName = '$firstName', LastName = '$lastName', Email = '$email', PhoneNumber = '$phoneNumber' WHERE ID = $clientID";
    return mysqli_query($conn, $query);
}

function deleteClient($conn, $clientID) {
    $clientID = intval($clientID);
    $query = "DELETE FROM Clients WHERE ID = $clientID";
    return mysqli_query($conn, $query);
}

// Функции для работы с сеансами
function getSessions($conn) {
    $query = "SELECT * FROM Sessions";
    $result = mysqli_query($conn, $query);
    $sessions = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sessions[] = $row;
        }
    }

    return $sessions;
}

function getSessionByID($conn, $sessionID) {
    $sessionID = intval($sessionID);
    $query = "SELECT * FROM Sessions WHERE ID = $sessionID";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

function addSession($conn, $DateTime, $MaxTickets, $SoldTickets) {
    $dateTime = mysqli_real_escape_string($conn, $DateTime);
    $maxTickets = intval($MaxTickets);
    $soldTickets = intval($SoldTickets);

    $query = "INSERT INTO Sessions (DateTime, MaxTickets, SoldTickets) VALUES ('$DateTime', $MaxTickets, $SoldTickets)";
    return mysqli_query($conn, $query);
}

function updateSession($conn, $sessionID, $DateTime, $MaxTickets, $SoldTickets) {
    $sessionID = intval($sessionID);
    $dateTime = mysqli_real_escape_string($conn, $DateTime);
    $maxTickets = intval($MaxTickets);
    $soldTickets = intval($SoldTickets);

    $query = "UPDATE Sessions SET DateTime = '$DateTime', MaxTickets = $MaxTickets, SoldTickets = $SoldTickets WHERE ID = $sessionID";
    return mysqli_query($conn, $query);
}

function deleteSession($conn, $sessionID) {
    $sessionID = intval($sessionID);
    $query = "DELETE FROM Sessions WHERE ID = $sessionID";
    return mysqli_query($conn, $query);
}

// Функции для работы с отзывами
function getReviews($conn) {
    $query = "SELECT * FROM Reviews";
    $result = mysqli_query($conn, $query);
    $reviews = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }
    }

    return $reviews;
}

function getReviewByID($conn, $reviewID) {
    $reviewID = intval($reviewID);
    $query = "SELECT * FROM Reviews WHERE ID = $reviewID";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

function addReview($conn, $clientID, $comment) {
    $clientID = intval($clientID);
    $comment = mysqli_real_escape_string($conn, $comment);

    $query = "INSERT INTO Reviews (ClientID, Comment) VALUES ($clientID, '$comment')";
    return mysqli_query($conn, $query);
}

function updateReview($conn, $reviewID, $clientID, $comment) {
    $reviewID = intval($reviewID);
    $clientID = intval($clientID);
    $comment = mysqli_real_escape_string($conn, $comment);

    $query = "UPDATE Reviews SET ClientID = $clientID, Comment = '$comment' WHERE ID = $reviewID";
    return mysqli_query($conn, $query);
}

function deleteReview($conn, $reviewID) {
    $reviewID = intval($reviewID);
    $query = "DELETE FROM Reviews WHERE ID = $reviewID";
    return mysqli_query($conn, $query);
}
?>
