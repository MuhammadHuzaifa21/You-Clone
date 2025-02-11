<?php 
    //  ------------------------------ 
    //  Functions for - Sign Up - Page
    //  ------------------------------
    function emptyInputSignup($fullname, $email, $username, $password, $confirmPassword) {
        $result = false;
        if (empty($fullname) || empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function invalidUid($username) {
        $result = false;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email) {
        $result = false;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function isPasswordValid($password) {
        $result = false;

        // if length of pwd is >= 6 - return true - else false.
        $result = (strlen($password) >= 6) ? true : false;
        return $result;
    }

    function pwdMatch($password, $confirmPassword) {
        $result = false;

        // Check if password are not equal then return True.
        if ($password !== $confirmPassword) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    
    function uidExists($conn, $username, $email) {
        $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
        /* Creating a prepare statement so that 
         * users can't enter some suspicious code
         * as input that might destroy our database. */
        $stmt = mysqli_stmt_init($conn);

        /* Now, checking that 
         * if this prepared statement will succeed 
         * when we try to run this SQL statement. */
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../new_signup.php?error=stmtfailed");
            exit();
        }
        // ss - means input will be string (two strings - ss)
        mysqli_stmt_bind_param($stmt, "ss", $username, $email); 
        mysqli_stmt_execute($stmt);

        // to grab records from database
        $resultData = mysqli_stmt_get_result($stmt);

        /* fetching data as an associative array
         * columns set to their names 
         * --------------------------
         * if we get some data from out database
         * it will return true - else false. */
        if ($row = mysqli_fetch_assoc($resultData)) { // returns True or False
            return $row; /* returning all the data, 
                          * if the user exists inside database */
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $fullname, $email, $username, $password) {
        $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
        /* Creating a prepare statement so that 
         * users can't enter some suspicious code
         * as input that might destroy our database. */
        $stmt = mysqli_stmt_init($conn);

        /* Now, checking that 
         * if this prepared statement will succeed 
         * when we try to run this SQL statement. */
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../new_signup.php?error=stmtfailed");
            exit();
        }

        /* Using hashing to make sure that password is encoded 
         * like mixed up string that not anyone can understand it,
         *  if a hacker got into out database. */
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        
        // ssss - means input will be string (Four strings - ssss)
        mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $username, $hashedPwd); 
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        // redirect user to a page if there are no errors.
        header("location: ../new_signup.php?error=none");
        exit();
    }

    // -------------------------------------------------------------------------------
    //  ------------------------------ 
    //  Functions for - Login - Page
    //  ------------------------------
    function emptyInputLogin($username, $password) {
        $result = false;
        if (empty($username) || empty($password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $username, $password) {
        // either email or username, so we named it both username, whatever the user enters
        // it will check where to fit it.
        $uidExists = uidExists($conn, $username, $username);

        if ($uidExists === false) {
            header("location: ../new_login.php?error=wronglogin");
            exit();
        }

        // Now, checking the password that it matches,
        // b/c it is Hashed in database.
        $pwdHashed = $uidExists["usersPwd"]; // calling database data, to check the values

        // Now confirming that the password provided by user
        // Password stored in database is "Same".
        // if same return "True"
        $checkPwd = password_verify($password, $pwdHashed);

        if ($checkPwd === false) {
            header("location: ../new_login.php?error=wronglogin");
            exit();
        } 
        // login the user into the website
        else if ($checkPwd === true) {
            // Sessions //
            // in order to store data inside sessions
            // means - the info you can grab onto
            //      from anywhere inside the website 
            //      as long as we have a session running.

            session_start(); // starting Session
            $_SESSION["userid"] = $uidExists["usersId"];
            $_SESSION["useruid"] = $uidExists["usersUid"];
            header("location: ../home.php?error=wronglogin");
            exit();
        }
    }