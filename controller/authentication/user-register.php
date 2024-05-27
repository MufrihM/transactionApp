<?php

include '../../database/connection.php';

$lname = '';
if (isset($_POST['lname'])) {
    $lname = $_POST['lname'];
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
        // insert user data
        if ($stmt = $db->prepare('INSERT INTO users (id_user, email, password) VALUES (NULL, ?, ?)')) {
            // encrypt the password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ss', $_POST['email'], $password);
            $stmt->execute();

            // insert customer data
            if ($insert_customer = $db->prepare('INSERT INTO customers (id_customer, id_user, name) 
            VALUES (NULL, (select id_user from users where email = ?), ?)')) {

                $fullname = $_POST['fname'] . ' ' . $lname;

                $insert_customer->bind_param(
                    'ss',
                    $_POST['email'],
                    $fullname
                );
                $insert_customer->execute();
                $insert_customer->close();

                // registration successful
                $response = ["email_exists" => "false"];
                echo json_encode($response);
            } else {
                echo 'Could not prepare statement!';
            }

            // insert wallet data
            if ($create_wallet = $db->prepare(
                'INSERT INTO cash (id_cash, id_customer, total_cash) 
                VALUES (NULL, LAST_INSERT_ID(), 0)'
            )) {
                $create_wallet->execute();
                $create_wallet->close();
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