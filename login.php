<?php
    require_once("loginSupport.php");
    $db_connection = new mysqli($host, $user, $password, $database);

    session_start();

    $username = $_POST["loginUsername"];
    $password = $_POST["loginPassword"];

    $sqlQuery = sprintf("select * from %s where username='%s'", $table, $username);
    $result = $db_connection->query($sqlQuery);
    $recordArray = $result->fetch_array(MYSQLI_ASSOC);
    $dbPassword = $recordArray["password"];

    $numberOfRows = mysqli_num_rows($result);
    if ($numberOfRows == 0 || !password_verify($password, $dbPassword)) {
        generateStartPage("Invalid username and password", "");
    } else {
        setcookie("loggedIn", "true");
        $_SESSION["username"] = $username;
        header("Location: home.php");
    }
    
    $result->close();
    $db_connection->close();
?>