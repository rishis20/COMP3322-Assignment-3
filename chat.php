<?php

include('check.php');
// Start the session
session_start();

    $_SESSION;
    $db = mysqli_connect("mydb", "dummy", "c3322b", "db3322") or die('Error connecting to MySQL server.'.mysqli_connect_error());

    $user_data= check_login($db);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['send'])) {
            $message = $_POST['message'];
            $person = strtok($user_data['useremail'], '@');
            $time= date("H:i:s");
            if (!empty($message)) {
                $query = "INSERT INTO message (time, message, person) VALUES ('$time', '$message', '$person')";
                mysqli_query($db, $query);
            }
        }

        else{
            echo "Please fill in the required information";
        }
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>A simple chatroom</title>
    <link rel="stylesheet" href="chat.css">
</head>
<body>

        <h1>Welcome to the chatroom</h1>
        <p> Hello <?php echo $user_data['useremail']; ?> </p>
        <div class="box">
            <div class="header">
                <button id="logout" onclick="location.href='login.php?action=signout';">Logout</button>
            </div>
            <div class="chat">
                <div id="sent-messages">
                    <p>Chat messages will appear here</p>
                </div>
                <div id="received-messages">
                    <p>Chat messages will appear here</p>
                </div>
            </div>

            <div class="send-message">
                <form method="post" class="send-message">
                    <input type="text" id="message" name="message" placeholder="Type your message here">
                    <button id="send" type="submit" name="send">Send</button>
                </form>
            </div>
        
        </div>
        <br>

</body>
</html>