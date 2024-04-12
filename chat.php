<?php

session_start();
include('check.php');
// Start the session
if(!isset($_SESSION['id'])) {
    header('location: login.php');
}
$db = mysqli_connect("mydb", "dummy", "c3322b", "db3322") or die('Error connecting to MySQL server.'.mysqli_connect_error());
$user_data= check_login($db);  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>A simple chatroom</title>
    <link rel="stylesheet" href="chat.css">
</head>
<body onload="loadMessages()">

        <h1>Welcome to the chatroom</h1>
        <p> Hello <?php echo $user_data['useremail']; ?> </p>
        <div style="display: none" id="username"><?php echo explode('@', check_login($db)['useremail'])[0]; ?></div>
        <div class="box">
            <div class="header">
                <button id="logout" onclick="location.href='login.php?action=signout';">Logout</button>
            </div>
            <div class="chat" id="container">
            </div>

            <div class="send-message">
                <form method="post" class="send-message send-message-form">
                    <input type="text" id="message" name="message" placeholder="Type your message here">
                    <button id="send" type="submit" name="send">Send</button>
                </form>
            </div>
        
        </div>
        <br>
    <script src="chat.js"></script>
</body>
</html>