<?php
    include_once 'header.php';
?>

<?php
    echo '<style>';
        echo '.upload-container {';
            echo 'max-width: 400px;';
            echo 'margin: 0 auto;';
            echo 'padding: 20px;';
            echo 'border: 1px solid #ccc;';
            echo 'border-radius: 5px;';
            echo 'box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);';
            echo '}';
    echo '</style>';

    echo '<div class="container mt-5">';        

        // <!-- Display some Welcome message, when a user is Logged into website. -->
        if (isset($_SESSION["useruid"])) {
            // if user is logged into website.
            echo "<h3 class='text-center'> Welcome, " . $_SESSION['useruid'] . "</p> </h3>";
        }

        echo '<ul class="list-group">';          

            // <!-- Upload Video -->
            echo '<div class="row justify-content-center">
                <div class="col-12 upload-container">
                    <h1 class="text-center mb-4">Upload Video</h1>
                    <form action="Videos/upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>
                                File Name:
                                <input type="text" name="title">
                            </label>
                            <input type="file" class="form-control" name="video" accept=".mp4">
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail:</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Upload</button>
                        </div>
                    </form>
                </div>
            </div>';
            echo '<br><br>';

            // -------------------
            // Database Connection
            // -------------------
            echo '<h1>Uploaded Videos</h1>';

            $serverName = "localhost";
            $dBUserName = "root";
            $dBPassword = "";
            $dBName = "user_records";

            $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

            if (!$conn) {
                die("Connection Failed: " . mysqli_connect_error());
            }

            // // Fetch video information from the database
            // $sql = "SELECT * FROM videos ";
            // $result = $conn->query($sql);

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
                    // Fetch video information from the database - based on the query filter
                    $sql = "SELECT * FROM videos where user_id =" . $usersId;
                    
                    $result = $conn->query($sql);
            
                    // Displaying video from database
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // echo "<div class='video'>";
                            echo '<li class="list-group-item">';
                                echo "<h4>" . $row["id"] . "</h4>";
                                echo "<source src='" . $row["id"] . "' type='video/mp4'>";
                                echo '<a href="view_video.php?video_id=' . $row['id'] . '">' . $row['title'] . '
                                    <a href="Videos/' . $row["file_path"] . '"> </a>
                                </a>';

                                // Add button to delete the video
                                echo '<a href="Videos/delete.php?fileID=' . $row["id"] . '"class="btn btn-danger btn-sm float-right"> Detete </a>';
                    
                            echo "</li>";
                            // echo "</div>";
                        }
                    } else {
                        echo "No videos found";
                    }
                } else {
                    echo 'User ID not found.';
                }
            } else {
                echo 'Invalid prepare statement';
            }
        echo '</ul>';

        // <!-- Pagination -->
        // <!-- <ul class="pagination mt-3">
        //     <?php
        //         // $totalVideos = count($videoFiles);
        //         // $totalPages = ceil($totalVideos / $perPage);
        //         // for ($i = 1; $i <= $totalPages; $i++) {
        //         //     echo '<li class="page-item ' . ($i === $page ? 'active' : '') . '">';
        //         //     echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
        //         //     echo '</li>';
        //         // }
        //     // 
        // </ul> -->

    echo '<p class="mt-4"><a href="home.php" class="btn btn-primary">Home Page</a> </p>';
?>

<?php 
    include_once 'footer.php';
?>