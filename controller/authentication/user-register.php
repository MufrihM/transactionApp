<?php

include '../../database/connection.php';

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

            if ($insert_customer = $db->prepare('INSERT INTO customers (id_customer, id_user, name, phone, address) 
            VALUES (?, (select id_user from users where email = ?), ?, ?, ?)')) {

                $insert_customer->bind_param(
                    'issss',
                    $_POST['id_customer'],
                    $_POST['email'],
                    $_POST['name'],
                    $_POST['phone'],
                    $_POST['address']
                );

                $insert_customer->execute();

                // registration successful
                $response = ["email_exists" => "false"];
                echo json_encode($response);
            } else {
                echo 'Could not prepare statement!';
            }
        } else {
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}
$db->close();