<!-- Include header -->
<?php 
    include_once ("header.php");
?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">Log In</div>
                <div class="card-body">
                    <form action="includes/login.inc.php" method="post">
                        <!-- Email -->
                        <div class="form-group">
                            <label for="username">Username / Email:</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Log In</button>
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
                echo '<div class="alert alert-danger text-center">'; // Use Bootstrap's alert class for styling
            
                    if ($_GET["error"] == "empty-input") {
                        echo "Please fill in all Fields.";
                    } else if ($_GET["error"] == "wronglogin") {
                        echo "Incorrect: Username / Password.";
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