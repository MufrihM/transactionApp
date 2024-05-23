<?php

include '../transactionApp/database/connection.php';

if (!isset($_POST['email'], $_POST['password'], $_POST['confirm-password'])) {
    exit('Please complete the registration form!');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email is not valid!');
}

if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    exit('Password must be between 5 and 20 characters long!');
}

if ($stmt = $con->prepare('SELECT email FROM users WHERE email = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo 'Email exists, please choose another!';
    } else {
        if ($stmt = $con->prepare('INSERT INTO users (id_user, email, password) VALUES (?, ?, ?)')) {
            // encrypt the password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('iss', $_POST['id_user'], $_POST['email'], $password);
            $stmt->execute();
            echo 'You have successfully registered! You can now login!';
        } else {
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}
$con->close();