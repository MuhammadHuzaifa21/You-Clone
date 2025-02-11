<?php
    include_once 'header.php';

    // Connect to the database (replace with your actual database connection code)
    $serverName = "localhost";
    $dBUserName = "root";
    $dBPassword = "";
    $dBName = "user_records";

    $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // $userId = $_SESSION['usersId'];
    // echo $userId;


    // Fetch video information based on video_id
    if (isset($_GET["video_id"])) {
        $video_id = $_GET["video_id"];   

        $sql = "SELECT * FROM videos WHERE id = " . $video_id;
        $result = $conn->query($sql);        

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<video width='820' height='auto' controls>";
                // echo "<source src='" . $row["file_path"] . "' type='video/mp4'>";
                echo "<source src='Videos/" . $row["file_path"] . "' type='video/mp4'>";
            echo "</video>";
            echo "<h2> &nbsp &nbsp " . $row["title"] . "</h2>";
            // echo "<p> &nbsp &nbsp &nbsp  Description ..... </p>";
            // echo "<p>" . $row["description"] . "</p>";
            // echo "<p>" . $row["upload_date"] . "</p>";
        } else {
            echo "Video not found.";
        }

    // View videos of Home Page
    } else if (isset($_GET["home_id"])) {
        $home_id = $_GET["home_id"];

        // Access the home page videos, through directory or somehow
        $sql = "SELECT * FROM videos WHERE id =" . $home_id;
        $result = $conn->query($sql); 

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<video width='820' height='auto' controls>";
                // echo "<source src='" . $row["file_path"] . "' type='video/mp4'>";
                echo "<source src='videos/" . $row["file_path"] . "' type='video/mp4'>";
            echo "</video>";
            echo "<h2> &nbsp &nbsp " . $row["title"] . "</h2>";

            // Check if the video is marked as favourite and display the appropriate button
            if ($row['is_favourite']) {
                echo '<form action="videos.php" method="post" enctype="multipart/form-data" class="float-right">';
                    echo '<input type="hidden" name="fileID" value="' . $row["id"] . '">';
                    echo '<button type="submit" name="submit" class="btn btn-sm unmark-fav">
                        <i class="fas fa-lg fa-heart" style="color: red;"></i>
                    </button>';
                echo '</form>';
            } else {
                echo '<form action="videos.php" method="post" enctype="multipart/form-data" class="float-right">';
                    echo '<input type="hidden" name="fileID" value="' . $row["id"] . '">';
                    echo '<button type="submit" name="submit" class="btn btn-sm mark-fav">
                        <i class="far fa-lg fa-heart"></i>
                    </button>';
                echo '</form>';
            }
            // echo "<p> &nbsp &nbsp &nbsp  Description ..... </p>";
            // echo "<p>" . $row["description"] . "</p>";
            // echo "<p>" . $row["upload_date"] . "</p>";
        } else {
            echo "Video not found.";
        }
    } else {
        echo "ID not specified.";
    }

    echo '<p class="mt-4"><a href="videos.php" class="btn btn-primary">Videos Page</a> </p>';

    $conn->close();
?>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.mark-fav, .unmark-fav').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let form = this.parentElement;
                let formData = new FormData(form);
                let fileID = formData.get('fileID');
                let isFavourite = this.classList.contains('mark-fav');

                fetch('toggle_favourite.php', {
                    method: 'POST',
                    body: formData
                }).then(response => response.text()).then(data => {
                    if (data === 'success') {
                        if (isFavourite) {
                            form.innerHTML = '<button type="submit" name="submit" class="btn btn-sm unmark-fav"> <i class="fas fa-lg fa-heart" style="color: red;"></i> </button>';
                        } else {
                            form.innerHTML = '<button type="submit" name="submit" class="btn btn-sm mark-fav"> <i class="far fa-lg fa-heart"></i> </button>';
                        }
                    } else {
                        alert('Failed to update favourite status');
                    }
                }).catch(error => console.error('Error:', error));
            });
        });
    });
</script>