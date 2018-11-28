<?php
    session_start();
    unset($_SESSION["username"]);
    setcookie("loggedIn");
    header("Location: main.php");
?>