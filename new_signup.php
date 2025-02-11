<!-- Include header -->
<?php 
    include_once ("header.php");
?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">Sign Up</div>
                <div class="card-body">
                    <form action="includes/signup.inc.php" method="post">
                        <!-- First Name -->
                        <div class="form-group">
                            <label for="fullname">Full Name:</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" >
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" >
                        </div>
                        <!-- User Name -->
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" >
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div>
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" >
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Including some error messages. in order to let users understand. OR get notified. -->
        <?php
            // $_POST - is used to check data inside the URL - which we can't see.
            // $_GET - is used to check data inside the URL - which we can see.
                // if we see something = something in url - it means it is a ($_GET) method. ||else|| ($_POST). 
            if (isset($_GET["error"])) {
                // using Bootstrap for Styling.
                echo '<div class="container">';
                echo '<div class="row justify-content-center">';
                echo '<div class="col-md-6">';
                echo '<div class="alert alert-primary text-center">'; // Use Bootstrap's alert class for styling
            
                if ($_GET["error"] == "empty-input") {
                    echo "Please fill in all Fields.";
                } else if ($_GET["error"] == "invalid-uid") {
                    echo "Choose a proper Username.";
                } else if ($_GET["error"] == "invalid-email") {
                    echo "Choose a proper Email.";
                } else if ($_GET["error"] == "passwords-does-not-match") {
                    echo "Passwords does not match.";
                } else if ($_GET["error"] == "passwordisshort(must-be-greater-than-5)") {
                    echo "Password must be greater than 6.";
                } else if ($_GET["error"] == "stmtfailed") {
                    echo "Something went wrong. Try again!";
                } else if ($_GET["error"] == "username/email-taken") {
                    echo "Username / Email already taken.";
                } else if ($_GET["error"] == "none") {
                    echo "YOU HAVE SIGNED UP.";
                }
            
                echo '</div>'; // Close the Bootstrap alert
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        ?>
    </div>
    
<?php
    include_once ("footer.php");
?>