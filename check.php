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

?>