<!-- in this we'll completely destroy our session
    in order to completely logout the user.
    ~ b/c session is the one that's making it sure that user is logged in. -->
<?php

// we need to start a session here.
// b/c without starting a session we can't delete it. make sense.
session_start();
session_unset();
session_destroy();

header("location: ../home.php");
exit();