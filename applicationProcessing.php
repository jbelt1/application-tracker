<?php
    require_once("loginSupport.php"); 
    $db_connection = new mysqli($host, $user, $password, $database);

    session_start();

    $username = $_SESSION["username"];
    $company = $_POST["company"];
    $position = $_POST["position"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $description = $_POST["description"];

    if ($startDate == "") {
        $startDate = "N/A";
    }

    if ($endDate == "") {
        $endDate = "N/A";
    }

    $sqlQuery = sprintf("insert into applications values(NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                    $username, $description, $company, $startDate, $endDate, $position, $email, $phone);

    $result = $db_connection->query($sqlQuery);

    header("Location: home.php");

    $db_connection->close();
?>