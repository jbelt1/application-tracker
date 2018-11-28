<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "application_tracker";
    $users_table = "users";
    
    $db_connection = new mysqli($host, $user, $password, $database);
    $username = $_GET["username"];

    $sqlQuery = sprintf("select (avatar) from $users_table where username = '%s'", $username);
    $result = $db_connection->query($sqlQuery);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    header("Content-type: image/jpeg");
    echo $row['avatar'];
    
    $result->close();
    $db_connection->close();
?>