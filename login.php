<?php

include('check.php');
// Start the session
session_start();
if(isset($_SESSION['passworderror'])) {
    unset($_SESSION['passworderror']);
}

    $db = mysqli_connect("mydb", "dummy", "c3322b", "db3322") or die('Error connecting to MySQL server.'.mysqli_connect_error());
    
    // At the top of your script
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        unset($_SESSION['duplicate']);
    }


    if (isset($_GET['action']) && $_GET['action'] == 'signout') {
        $_SESSION = array();
        
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 120, '/');
        }
    
        unset($_SESSION['id']);
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
            $_SESSION['duplicate'] = "User already exists";
            }

        else if(!empty($useremail) && !empty($password)){
            $query = "INSERT INTO account (useremail, password) VALUES ('$useremail', '$password')";
            mysqli_query($db, $query);
            $_SESSION['id'] = mysqli_insert_id($db);
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
                        $_SESSION['passworderror'] = "The password is incorrect";
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
            <input class="textbox" name="useremail" id="useremail" placeholder="Email"> <br>
            <input class="textbox" type="password" id="password" name="password" placeholder="Password"> <br>
            <button type="submit" name="login">Login</button> <br>
            <p> Don't have a password? Click here to <a href="javascript:void(0);" id="showRegisterForm">Register</a> </p>
            <p  class="error-message"><?php echo isset($_SESSION['passworderror']) ? $_SESSION['passworderror'] : null ?></p>
            <?php if (isset($_SESSION['duplicate'])): ?>
                <p class="error-message">The account already exists.</p>
            <?php unset($_SESSION['duplicate']); ?>
            <?php endif; ?>
        </form>

        <form id="registerForm" method="post" style="display:none;">
        <h2>Register</h2>
            <input class="textbox"  name="useremail" id="r-useremail" placeholder="Email"><br>
            <input class="textbox" type="password" name="password" id="r-password" placeholder="Password"><br>
            <input class="textbox" type="password" name="confirmPassword" id="r-confirmPassword" placeholder="Password"><br>
            <button type="submit" name="register">Register</button>
            <p> Already have an account? Click here to <a href="javascript:void(0);" id="showLoginForm">Login</a> </p>
        </form>
        

    </div>

</div>
    <script src="login.js"></script>
</body>
</html>