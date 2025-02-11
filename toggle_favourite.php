<?php
$serverName = "localhost";
$dBUserName = "root";
$dBPassword = "";
$dBName = "user_records";

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (isset($_POST['fileID'])) {
    $fileID = intval($_POST['fileID']);

    // Check current favourite status
    $sql = "SELECT is_favourite FROM videos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $fileID);
    $stmt->execute();
    $stmt->bind_result($is_favourite);
    $stmt->fetch();
    $stmt->close();

    // Toggle favourite status
    $new_status = !$is_favourite;
    $sql = "UPDATE videos SET is_favourite = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $new_status, $fileID);
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
    $stmt->close();
}

$conn->close();
?>