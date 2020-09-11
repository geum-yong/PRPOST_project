<?php
    session_start();
    if ($_SESSION['prpost_id'] != null || $_SESSION['prpost_name'] != null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }
    
    $id = $_POST['user_id'];
    $pw = $_POST['user_pw'];
    $relay = $_POST["relay"];

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    include('connect.php');

    $query = "SELECT * FROM users WHERE user_id = '$id'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if ($count == 0) {
        echo "<script>alert('등록된 회원이 아닙니다.'); history.back();</script>";
        return;
    } else if (($id == $row['user_id'] && password_verify($pw, $row['user_pw'])) || ($id == $row['user_id'] && $pw == $row['user_pw'])) {
        $_SESSION['prpost_id'] = $row['user_id'];
        $_SESSION['prpost_name'] = $row['user_name'];
        echo "<script>location.href='../manage_home.php';</script>";
    } else if (!password_verify($pw, $row['user_pw']) && $pw != $row['user_pw']) {
        echo "<script>alert('비밀번호가 다릅니다.'); history.back();</script>";
        return;
    }
?>