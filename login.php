<?php

include('check.php');
// Start the session
session_start();

    $db = mysqli_connect("mydb", "dummy", "c3322b", "db3322") or die('Error connecting to MySQL server.'.mysqli_connect_error());
    

    if (isset($_GET['action']) && $_GET['action'] == 'signout') {
        $_SESSION = array();
        
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 120, '/');
        }
    
        // Destroy the session
        session_destroy();
    
        // Redirect to login.php
        header("Location: login.php");
        exit();
    }



    if (isset($_SESSION['id'])) {
        // The user is already logged in, redirect to chat.php
        header("Location: chat.php");
        exit();
    }

    if(isset($_POST['register'])){
        $useremail = $_POST['useremail'];
        $password=$_POST['password'];

        if(duplicate($useremail,$db)){
            echo "User already exists";
            exit();
        }

        if(!empty($useremail) && !empty($password)){
            $query = "INSERT INTO account (useremail, password) VALUES ('$useremail', '$password')";
            mysqli_query($db, $query);
            header("Location: chat.php");
            exit();
        }
            else{
                echo "Please fill in the required information";
            }
        }

        if (isset($_POST['login'])) {
            $useremail = $_POST['useremail']; // Notice the name attribute should match the one in the login form
            $password = $_POST['password'];
        
            if (!empty($useremail) && !empty($password)) {
                $query = "SELECT * FROM account WHERE useremail='$useremail'";
                $result = mysqli_query($db, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['password'] === $password) {
                        $_SESSION['id'] = $user_data['id'];
                        header("Location: chat.php");
                        exit();
                    } else {
                        echo "The password is incorrect";
                    }
                } else {
                    echo "User does not exist or wrong credentials";
                }
            } else {
                echo "Please fill in the required information";
            }
        }
    

 // Placeholder for database connection code
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>A simple chatroom</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<h1>Welcome to the chatroom</h1>

<div class="center-div">
    <div id="box">
        <form id="loginForm" method="post" style= "display:block;">
        <h2>Login</h2>
            <input class="textbox" type="email" name="useremail" placeholder="Email" required> <br>
            <input class="textbox" type="password" name="password" placeholder="Password" required> <br>
            <button type="submit" name="login">Login</button> <br>
            <p> Don't have a password? Click here to <a href="javascript:void(0);" id="showRegisterForm">Register</a> </p>
        </form>

        <form id="registerForm" method="post" style="display:none;">
        <h2>Register</h2>
            <input class="textbox" type="email" name="useremail" placeholder="Email" required><br>
            <input class="textbox" type="password" name="password" placeholder="Password" required><br>
            <input class="textbox" type="password" name="confirmPassword" placeholder="Password" required><br>
            <button type="submit" name="register">Register</button>
            <p> Already have an account? Click here to <a href="javascript:void(0);" id="showLoginForm">Login</a> </p>
        </form>
        

    </div>

</div>
    <script src="login.js"></script>
</body>
</html>