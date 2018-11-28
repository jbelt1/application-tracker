<?php
    session_start();

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $avatar_img=addslashes(file_get_contents($_FILES['avatar-input']['tmp_name']));

        $host = "localhost";
	    $user = "root";
	    $password = "";
	    $database = "application_tracker";
        $users_table = "users";

        $db_connection = new mysqli($host, $user, $password, $database);
        $sqlQuery = sprintf("update users set avatar = '%s' where username = '%s'", $avatar_img, $username);
        $result = $db_connection->query($sqlQuery);
        header("Location: home.php");
    }
?>