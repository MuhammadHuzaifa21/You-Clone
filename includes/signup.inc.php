<?php
    if (isset($_POST["submit"])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST['confirmPassword'];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        // Creating user defined functions
        // Empty Input
        if (emptyInputSignup($fullname, $email, $username, $password, $confirmPassword) !== false) {
            header("location: ../new_signup.php?error=empty-input");
            exit();
        }

        // Invalid Username
        if (invalidUid($username) !== false) {
            header("location: ../new_signup.php?error=invalid-uid");
            exit();
        }

        // Invalid Email
        if (invalidEmail($email) !== false) {
            header("location: ../new_signup.php?error=invalid-email");
            exit();
        }

        // Password length check
        if (isPasswordValid($password) == false) {
            header("location: ../new_signup.php?error=passwordisshort(must-be-greater-than-5)");
            exit();            
        } 
        // else {
        //     echo "Valid Password";
        //     exit();
        // }
        
        // Password Match
        if (pwdMatch($password, $confirmPassword) !== false) {
            header("location: ../new_signup.php?error=passwords-does-not-match");
            exit();
        }

        // Username OR Email already exist
        if (uidExists($conn, $username, $email) !== false) {
            header("location: ../new_signup.php?error=username/email-taken");
            exit();
        }
        
        // To createuser in database.
        createUser($conn, $fullname, $email, $username, $password);

    } 
    // else return to signup page
    else {
        header("location: ../new_signup.php");
        exit();
    }