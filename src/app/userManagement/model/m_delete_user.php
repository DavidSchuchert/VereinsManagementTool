<?php 

if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM users WHERE id='$user_id'";
    $mysqli->query($sql);
    header("Refresh:0");
}