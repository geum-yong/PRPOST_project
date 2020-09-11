<?php
    $db_host = "#";
    $db_user = "#";
    $db_password = "#";
    $db_name = "#";

    $con = new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($con->connect_errno) { 
        die('Connection Error : '.$con->connect_error); 
    }

    mysqli_query($con, "set session character_set_connection=utf8;");
    mysqli_query($con, "set session character_set_results=utf8;");
    mysqli_query($con, "set session character_set_client=utf8;");
?>