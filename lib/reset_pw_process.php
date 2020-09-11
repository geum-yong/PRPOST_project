<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $id = $_POST['user_id'];
    $relay2 = $_POST['relay2'];

    if ($relay2 == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    include('connect.php');
    $pw = '1234';
    $hash = password_hash($pw, PASSWORD_DEFAULT);

    $query = "UPDATE users SET user_pw='$hash' WHERE user_id='$id'";
    $result = mysqli_query($con, $query);

    echo "<script>alert('초기화하였습니다.');</script>";
    echo "<script>location.href='../manage_users.php';</script>";
?>
