<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Upload</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

<!-- // insert user_id in videos table, while uploading video.
// GET - user_id videos.php to display only that specific user videos
// home.php all video apart from user_id uploaded videos. -->

    <?php
        session_start();
        // Connect to DB
        require_once '../includes/dbh.inc.php';

        if (isset($_SESSION['useruid']) == true) {
            echo '<div class="container mt-5">';
                
                if (isset($_FILES['video']) && isset($_POST['submit'])) {

                    // Fetch the user_id using the username
                    // $sql = "SELECT usersId FROM users WHERE usersUid = $useruid";

                    $title = $_POST['title'];
                    // $useruid = $_POST['usersUid'];
                    $video = $_FILES['video'];
                    $thumbnail = $_FILES['thumbnail'];
                    $useruid = $_SESSION['useruid'];

                     // Fetch the user_id using the username (useruid)
                    $userSql = "SELECT usersId FROM users WHERE usersUid = ?";
                    $userStmt = mysqli_stmt_init($conn);

                    if (mysqli_stmt_prepare($userStmt, $userSql)) {
                        mysqli_stmt_bind_param($userStmt, "s", $useruid);
                        mysqli_stmt_execute($userStmt);
                        mysqli_stmt_bind_result($userStmt, $usersId);
                        mysqli_stmt_fetch($userStmt);
                        mysqli_stmt_close($userStmt);

                        if ($usersId) {
                            
                            // For video uploading            
                            $videoName = $video['name'];
                            $videoTmpName = $video['tmp_name'];
                            $videoSize = $video['size'];
                            $videoError = $video['error'];
                            $videoType = $video['type'];

                            $videoExt = explode('.', $videoName);
                            $videoActualExt = strtolower(end($videoExt));            
                            $videoAllowed = array('mp4');

                            // For thumbnail uploading
                            $thumbName = $thumbnail['name'];
                            $thumbTmpName = $thumbnail['tmp_name'];
                            $thumbSize = $thumbnail['size'];
                            $thumbError = $thumbnail['error'];
                            $thumbType = $thumbnail['type'];

                            $thumbExt = explode('.', $thumbName);
                            $thumbActualExt = strtolower(end($thumbExt));
                            $thumbAllowed = array('jpeg', 'jpg', 'png');

                            if (in_array($videoActualExt, $videoAllowed) && in_array($thumbActualExt, $thumbAllowed)) {
                                if ($videoError === 0 && $thumbError === 0) {
                                    if ($videoSize < 50000000 && $thumbSize < 50000000) { // Limit file size to 50MB
                                        $videoNameNew = uniqid('', true) . "." . $videoActualExt;
                                        $thumbNameNew = uniqid('', true) . "." . $thumbActualExt;
                                        $videoDestination = 'uploads/' . $videoNameNew;
                                        $thumbDestination = 'uploads/thumbnails/' . $thumbNameNew;
                                        
                                        if (move_uploaded_file($videoTmpName, $videoDestination) && move_uploaded_file($thumbTmpName, $thumbDestination)) {
                        
                                            $sql = "INSERT INTO videos (title, file_path, thumbnail_path, user_id) VALUES (?, ?, ?, ?)";
                                            $stmt = mysqli_stmt_init($conn);

                                            // $new_sql = "UPDATE videos
                                            //             SET user_id = ?
                                            //             WHERE file_path = ?";
                                            // $new_stmt = mysqli_stmt_init($conn);
                        
                                            if (mysqli_stmt_prepare($stmt, $sql)) {
                                                mysqli_stmt_bind_param($stmt, "sssi", $title, $videoDestination, $thumbDestination, $usersId);
                                                
                                                if (mysqli_stmt_execute($stmt)) {
                                                    // mysqli_stmt_bind_param($new_stmt, "ss", $userid, $videoDestination);
                                                    // mysqli_stmt_execute($new_stmt);
                                                    
                                                    echo '<div class="text-center alert alert-success mt-3" role="alert">File uploaded successfully.</div>';
                                                    echo '<p class="text-center"> <a href="../videos.php">Go to Video page.</a></p>';
                                                    echo '<p class="text-center"> <a href="../home.php">Go to Home page.</a></p>';
                                                } else {
                                                    echo 'Failed to execute statement: ' . mysqli_stmt_error($stmt); // Print the error
                                                }                                    
                                            } else {
                                                echo "SQL error";
                                            }
                                            // } else {
                                            //     echo "Failed to generate thumbnail";
                                            // }
                                        } else {
                                            echo "Failed to move uploaded file";
                                        }
                                    } else {
                                        echo "Your file is too big!";
                                    }
                                } else {
                                    echo "There was an error uploading your file!";
                                }
                            } else {
                                echo "You cannot upload files of this type!";
                            }
                        } else {
                            echo 'User ID not found!';
                        }                        
                    } else {
                        echo "Failed to prepare user query.";
                    }
                } 
            echo "</div>";
        } else {
            echo '<div class="text-center alert alert-danger mt-3" role="alert">NOTE: For uploading video you need to LOG IN or SIGN UP first.</div>';
            echo '<p class="text-center"> <a href="../new_signup.php">Go to Sign Up page.</a></p>';
            echo '<p class="text-center"> <a href="../new_login.php">Go to Login page.</a></p>';
            echo '<p class="text-center"> <a href="../home.php">Go to Home page.</a></p>';
        }
    ?>
</body>
</html>