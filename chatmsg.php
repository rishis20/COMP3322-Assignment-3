<?php
session_start();
include 'check.php';
$db = mysqli_connect("mydb", "dummy", "c3322b", "db3322") or die('Error connecting to MySQL server.'.mysqli_connect_error());
$user_data = check_login($db);  

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $time= date("H:i:s", strtotime(date("H:i:s") . "-1 hour"));
  $query = "SELECT * FROM message WHERE time > '$time'";
  $result = mysqli_query($db, $query);
  $arrayOfMessages = [];
  while($user_data = mysqli_fetch_assoc($result)) {
    array_push($arrayOfMessages, $user_data);
  }
  echo json_encode($arrayOfMessages);
  
} else {
  $checklatest = json_decode(file_get_contents('php://input'), true);
  if(isset($checklatest['latest'])) {
    $time = $checklatest['time'];
    $person = strtok($user_data['useremail'], '@');
    $query = "SELECT * FROM message WHERE time > '$time' AND person != '$person'";
    $result = mysqli_query($db, $query);
    $arrayOfMessages = [];
    while($user_data = mysqli_fetch_assoc($result)) {
      array_push($arrayOfMessages, $user_data);
    }
    echo json_encode($arrayOfMessages);
  } else {
    $user_data= check_login($db);
    $message = json_decode(file_get_contents('php://input'), true)['message'];
    $person = strtok($user_data['useremail'], '@');
    $time= date("H:i:s");
    if (!empty($message)) {
        $query = "INSERT INTO message (time, message, person) VALUES ('$time', '$message', '$person')";
        mysqli_query($db, $query);
    }
  }
}
?>