<!-- Now, on every single page
    the session will be started. -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Link to FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <style>
        .fas {
            color: red;
        }

        .nav-item:active {
            background-color: lightgray;
        }
    </style>
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >

        <!-- ICON -->
        <a class="nav-link" href="home.php">
            <i class="fas fa-play"></i> <!-- Video Icon -->
        </a>

        <a class="navbar-brand" href="home.php">You Clone</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse header-main" id="navbarNav">
            <ul class="navbar-nav flex-fill">            
                <li class="nav-item active ml-5">
                    <a class="nav-link " href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active ml-5">
                    <a class="nav-link " href="videos.php">Videos </a>
                </li>

                <li class="nav-item active ml-5">
                    <a class="nav-link " href="home.php?fav=1">Favourites </a>
                </li>

                <!-- Search Area -->
                <div class="collapse navbar-collapse ml-5" id="navbarNav">
                    <form class="form-inline ml-auto">
                        <input class="form-control custom-search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

                <!-- Microphone button -->
                <li class="nav-item ml-2">
                    <button class="nav-link btn btn-white" id="microphoneButton">
                        <i class="fas fa-microphone"></i> <!-- Microphone Icon -->
                    </button>
                </li>

                <!-- Conditions to Check if the user's Logged in -->
                <!-- by this we can change the content for Logged in users -->
                <?php
                    if (isset($_SESSION["useruid"])) {
                        // if user is logged into website.
                        echo "<li class='nav-item ml-5'>
                                <a href='profile.php' class='nav-link' alt='Profile Page'>Profile</a>
                            </li>";
    
                        echo "<li class='nav-item ml-3 mr-3 '>
                                <a href='includes/logout.inc.php' class='nav-link' alt='Logout'>Logout</a>
                            </li>";
                    }
                    else {
                        // user is not logged into website.
                        echo "<li class='nav-item ml-5'>
                                <a href='new_login.php' class='nav-link' alt='Login'>Log in</a>
                            </li>";
    
                        echo "<li class='nav-item ml-3 mr-3'>
                                <a href='new_signup.php' class='nav-link' alt='SignUp'>Sign Up</a>
                            </li>";
                    }
                ?>
                <!-- Profile Image Icon (Top-Right Corner) -->
                <li class="nav-item ml-auto">
                    <img src="profile.png" alt="Profile Image" class="" style="width: 40px; height: 40px; border-radius: 50%;" onclick="profile.php">
                </li>                

            </ul>
        </div>
    </nav> 

    <!--  -->
                
    <!-- Alert Message -->
    <div class="alert alert-danger alert-dismissible text-center" role="alert" id="microphoneAlert" style="display: none;">
        Microphone is not available.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    // JavaScript to show the alert message when the microphone button is clicked
        document.getElementById("microphoneButton").addEventListener("click", function() {
            // Show the alert message
            document.getElementById("microphoneAlert").style.display = "block";

            // Hide the alert message after a few seconds (optional)
            setTimeout(function() {
                document.getElementById("microphoneAlert").style.display = "none";
            }, 3000); // Adjust the time (in milliseconds) as needed
        });
    </script>

    <!-- Main content -->
    <div class="container">