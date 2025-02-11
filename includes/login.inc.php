<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once "dbh.inc.php";;
    require_once "functions.inc.php";

    // Creating user defined functions
    // Empty Input
    if (emptyInputLogin($username, $password) !== false) {
        header("location: ../new_login.php?error=empty-input");
        exit();
    }

    loginUser($conn, $username, $password);
} else {
    header("location: ../new_login.php");
    exit();
}