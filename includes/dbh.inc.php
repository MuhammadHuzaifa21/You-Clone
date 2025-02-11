<?php 
    $serverName = "localhost";
    $dBUserName = "root";
    $dBPassword = null;
    $dBName = "user_records";

    $conn = mysqli_connect($serverName, username: $dBUserName, password: $dBPassword, database: $dBName);

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }