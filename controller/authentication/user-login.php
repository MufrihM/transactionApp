<?php
session_start();

include '../../database/connection.php';

if ($query = $db->prepare('SELECT * FROM users WHERE email = ?')) {
    $query->bind_param('s', $_POST['email']);
    $query->execute();
    $query->store_result();
    if ($query->num_rows > 0) {
        $query->bind_result($id_user, $email, $hashedPassword);
        $query->fetch();
        if (password_verify($_POST['password'], $hashedPassword)) {
            // set session
            $_SESSION['login']= true; 

            // set cookie
            if (isset($_POST['remember'])) {
                // create new cookie
                setcookie('id_user', $id_user, time() + 60, "/");
                setcookie('token', hash('sha256', $email), time() + 60,'/');
            }

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