<?php    
    require_once("loginSupport.php"); 
    $db_connection = new mysqli($host, $user, $password, $database);

    $username = $_POST["registerUsername"];
    $password = $_POST["registerPassword"];
    $verifyPassword = $_POST["verifyPassword"];

    $sqlQuery = sprintf("select * from %s where username='%s'", $table, $username);
    $result = $db_connection->query($sqlQuery);

    $numberOfRows = mysqli_num_rows($result);
    if ($numberOfRows > 0) {
        generateStartPage("", "Username already in use");
    } else if ($password != $verifyPassword) {
        generateStartPage("", "Passwords don't match");
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sqlQuery = sprintf("insert into $table values('%s', '%s')",
                    $username, $hashedPassword);
        $result = $db_connection->query($sqlQuery);

        setcookie("loggedIn", "true");
        $_SESSION["username"] = $username;
        header("Location: home.php");
    }

    $db_connection->close();
?>