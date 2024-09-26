<?php

if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    $_SESSION['new_user'] = [
        'username' => $username,
        'email' => $email,
        'password' => $_POST['password']
    ];
    $sql = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$password')";
    $mysqli->query($sql);
    header("Location: index.php?page=user&action=create_success");
}