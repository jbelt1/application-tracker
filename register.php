<?php    
    require_once("loginSupport.php"); 
    session_start();
    $db_connection = new mysqli($host, $user, $password, $database);

    session_start();

    $username = $_POST["registerUsername"];
    $password = $_POST["registerPassword"];
    $verifyPassword = $_POST["verifyPassword"];
    echo $username;
    echo $table;
    $sqlQuery = sprintf("select * from $table where username='%s'", $username);
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