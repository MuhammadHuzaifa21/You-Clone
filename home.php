<?php 
        include_once 'header.php';
?>

<style>
    /* Add your CSS styles here */

    .img-thumbnail {
        margin-right: 15px;
        float: left;
    }

    .list-group-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .video-details {
        flex-grow: 1;
        padding-left: 15px;
    }

    .img-thumbnail {
        border: solid lightgrey;
    }
</style>

<?php
    // $useruid = $_SESSION['useruid'];
    // echo $useruid;
    // Connect to the database (replace with your actual database connection code)
    // $serverName = "localhost";
    // $dBUserName = "root";
    // $dBPassword = "";
    // $dBName = "user_records";

    // $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

    // if (!$conn) {
    //     die("Connection Failed: " . mysqli_connect_error());
    // }
    require_once "includes/dbh.inc.php";

    // checking either this query exists -> it consists an id (filter)
    if (isset($_GET['fav'])){
        $fav = $_GET['fav'];
    } else {
        $fav = 0;
    }

    // <!-- Content Container -->

    // if link has no query it will run this
    if ($fav){        
        echo '<h1 class="text-center mb-4">Favorites Tab</h1>';
    }

    echo '<div class="row">';
        // echo '<br>';
        // echo $useruid;
        // if (isset($_SESSION['$useruid'])) {  
        $useruid = $_SESSION['useruid'];

        if ($useruid) {
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
                    if ($fav){
                        $sql = "SELECT * FROM videos WHERE is_favourite=1 AND user_id <> $usersId";    
                    } else {
                        $sql = "SELECT * FROM videos where user_id <>" . $usersId;
                    }
                    
                    $result = $conn->query($sql);

                    // Display videos
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='video'>";
                                echo '<br>';
                                // Thumbnail of the videos
                                // <source src="videos/"' . $row["file_path"] . '" type="video/mp4">
                                echo '<a href="view_video.php?home_id=' . $row['id'] . '">
                                    <img src="videos/'. $row['thumbnail_path'].'" alt="Thumbnail Path" class="img-thumbnail" width="320" height="auto">
                                    <h2>' . $row["title"] . '</h2>
                                    </a>';
                            echo "</div>";
                            echo "&nbsp &nbsp";
                        }
                    } else {
                        echo "No videos found.";
                    }
                } else {
                    echo 'User ID not found.';
                } 
            } else {
                echo 'Unable to prepare query.';
            }
            $conn->close();
        
            // If no one is LOGGED IN
        } else {
            // Handle the case where the user is not logged in
            $useruid = null;
            // echo '<div class="alert alert-warning">You are not logged in. Please <a href="login.php">log in</a> to continue.</div>';
            $sql = "SELECT * FROM videos";
                
            $result = $conn->query($sql);

            // Display videos
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='video'>";
                        echo '<br>';
                        // Thumbnail of the videos
                        // <source src="videos/"' . $row["file_path"] . '" type="video/mp4">
                        echo '<a href="view_video.php?home_id=' . $row['id'] . '">
                            <img src="videos/'. $row['thumbnail_path'].'" alt="Thumbnail Path" class="img-thumbnail" width="320" height="auto">
                            <h2>' . $row["title"] . '</h2>
                            </a>';
                    echo "</div>";
                    echo "&nbsp &nbsp";
                }
            } else {
                echo "No videos found.";
            }
        }
    echo '</div>';
?>

<!-- <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.unmark-fav').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let form = this.parentElement;
                let formData = new FormData(form);
                let fileID = formData.get('fileID');

                fetch('toggle_favourite.php', {
                    method: 'POST',
                    body: formData
                }).then(response => response.text()).then(data => {
                    if (data === 'success') {
                        location.reload(); // Refresh the page upon success
                    } else {
                        alert('Failed to update favourite status');
                    }
                }).catch(error => console.error('Error:', error));
            });
        });
    });
</script> -->
    
<?php   
    include_once 'footer.php';
?>