<?php

include '../../database/connection.php';

if (!isset($_POST['email'], $_POST['password'], $_POST['confirm-password'])) {
    exit('Please complete the registration form!');
}

if ($stmt = $db->prepare('SELECT email FROM users WHERE email = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $response = ["email_exists" => "true"];

        // Output the JSON data
        echo json_encode($response);
    } else {
        if ($stmt = $db->prepare('INSERT INTO users (id_user, email, password) VALUES (?, ?, ?)')) {
            // encrypt the password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('iss', $_POST['id_user'], $_POST['email'], $password);
            $stmt->execute();
            // registration successful
        } else {
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}
$db->close();