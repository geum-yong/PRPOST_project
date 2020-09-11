<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $templetNum = $_POST["templet_num"];
    $relay = $_POST["relay"];

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    include('connect.php');

    $query = "UPDATE templet SET view_check='noView' WHERE templet_num='$templetNum'";
    $result = mysqli_query($con, $query);

    echo "<script>alert('템플릿을 숨겼습니다.');</script>";
    echo "<script>location.href='../manage_templet.php';</script>";
?>