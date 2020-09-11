<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $id = $_POST['user_id'];
    $relay = $_POST['relay'];

    if ($id == 'admin') {
        echo "<script>alert('최고 관리자 계정은 삭제할 수 없습니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../index.php';</script>";
        return;
    }

    include('connect.php');
    $query = "DELETE FROM users WHERE user_id = '$id'";
    $result = mysqli_query($con, $query);

    echo "<script>alert('삭제하였습니다.');</script>";
    echo "<script>location.href='../manage_users.php';</script>";
?>
