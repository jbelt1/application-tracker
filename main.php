<?php
require_once("loginSupport.php");

if (isset($_COOKIE["loggedIn"])){
    header("Location: home.php");
} else {
    generateStartPage("", "");
}

?>