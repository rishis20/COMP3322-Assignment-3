<?php

function check_login($db){
    if(isset($_SESSION['id'])){ 
        $id = $_SESSION['id'];
        $query = "SELECT * FROM account WHERE id='$id'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1){
            $user_data= mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $user_data;
        }

        header("Location: login.php");
        die;
    }
}

function duplicate($useremail,$db){
    $query = "SELECT * FROM account WHERE useremail='$useremail'";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) > 0){
        return true;
    }
    return false;
}

?>