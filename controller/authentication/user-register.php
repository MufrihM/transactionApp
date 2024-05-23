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
        echo 'Email exists, please choose another!';
    } else {
        if ($stmt = $db->prepare('INSERT INTO users (id_user, email, password) VALUES (?, ?, ?)')) {
            // encrypt the password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('iss', $_POST['id_user'], $_POST['email'], $password);
            $stmt->execute();
            // register the user is successful
            echo "<script>";

            // echo "alert('You have successfully registered, you can now login!');";
            
            // echo "location.href = '../../view/test/register.php';";
            echo "</script>";
        } else {
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}
$db->close();