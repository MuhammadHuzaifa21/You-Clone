<?php
    include_once("header.php");
?>

    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <img src="profile.png" class="card-img-top" alt="User Profile Image">
                <div class="card-body">
                    <h5 class="card-title">
                    <?php
                        if (isset($_SESSION["useruid"])) {
                            // if user is logged into website.
                            echo "Username: ". $_SESSION['useruid'];
                        }
                    ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>