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

    <div class="container mt-5">
        <?php
            // Connect to the database (replace with your actual database connection code)
            $serverName = "localhost";
            $dBUserName = "root";
            $dBPassword = "";
            $dBName = "user_records";

            $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

            if (!$conn) {
                die("Connection Failed: " . mysqli_connect_error());
            }


            // $file_id
            // sql connection
            // get video where id = fileid
            // filepath = video['filepath']
            // delete from video where id = fileid
            // unlink(filepath)
                
            if (isset($_GET['fileID'])) {
                $file_id = $_GET['fileID']; // Get the file ID from the URL and ensure it is an integer
                // Proceed with the deletion process
                
                // Fetch video information from the database
                $sql = "SELECT * FROM videos WHERE id=$file_id";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $file_path = $row['file_path'];
                        $thumb_path = $row['thumbnail_path'];
                        
                        // Fetch video information from the database
                        $sql = "DELETE FROM videos WHERE id=$file_id";
                        $results = $conn->query($sql);

                        // Check if a file path was retrieved
                        if ($file_path && $thumb_path) {
                            // Check if the file & thumbnail exists in the file system
                            if (file_exists($file_path) && file_exists($thumb_path)) {
                                // Delete the video file from the file system
                                unlink($file_path);
                                unlink($thumb_path);
                                // Output a success message
                                // echo "File deleted successfully.";
                                echo '<div class="text-center alert alert-success mt-3" role="alert">Video deleted successfully..</div>';
                                echo '<p class="text-center"> <a href="../videos.php">Return to Video page.</a></p>';
                            } else {
                                // Output a message if the file does not exist
                                echo '<div class="text-center alert alert-danger mt-3" role="alert">Video not found!</div>';
                                echo '<p class="text-center"> <a href="../videos.php">Return to Video page.</a></p>';
                            }
                        } else {
                            // Output a message if no video path was found for the specified ID
                            echo "No file path found for the specified ID.";
                        }
                    }
                } else {
                    echo "No videos found";
                }                
            } else {
                // Output a message if the 'video_id' parameter is not set in the URL
                echo "No file ID specified.";
            }
            
            // Close the connection to the database
            $conn->close();
        ?>
    </div>
</body>
</html>