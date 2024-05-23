<?php

include '../../database/connection.php';

if ($query = $db->prepare('SELECT * FROM users WHERE email = ?')) {
    $query->bind_param('s', $_POST['email']);
    $query->execute();
    $query->store_result();
    if ($query->num_rows > 0) {
        // Bind the result to variables
        $query->bind_result($id_user, $email, $hashedPassword);
        $query->fetch();
        if (password_verify($_POST['password'], $hashedPassword)) {
            $response = ["login" => "true"];
            echo json_encode($response);
        } else{
            $response = ["login"=> "false"];
            echo json_encode($response);
        }
    } else {
        $response = ["login" => "false"];
        echo json_encode($response);
    }
    $query->close();
} else {
    exit();
}
$db->close();