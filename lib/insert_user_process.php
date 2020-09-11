<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $id = $_POST["user_id"];
    $pw = $_POST["user_pw"];
    $name = $_POST["user_name"];
    $relay = $_POST["relay"];

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    include('connect.php');

    $hash = password_hash($pw, PASSWORD_DEFAULT);

    $query = "SELECT * FROM users WHERE user_id = '$id'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);

    if ($count == 0) {
        $query = "INSERT INTO users (user_id, user_pw, user_name, date) VALUES ('$id', '$hash', '$name', NOW())";
        $result = mysqli_query($con, $query);

        echo "<script>alert('등록하였습니다.');</script>";
        echo "<script>location.href='../manage_users.php';</script>";
    } else {
        echo "<script>alert('이미 등록된 아이디입니다.'); history.back();</script>";
    }
?>