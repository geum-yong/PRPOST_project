<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }
    
    $id = $_POST['user_id'];
    $pw_pre = $_POST['user_pw_pre'];
    $pw_after = $_POST['user_pw'];
    $name = $_POST['user_name'];
    $relay = $_POST["relay"];

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    include('connect.php');
    
    $query = "SELECT * FROM users WHERE user_id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    if (password_verify($pw_pre, $row['user_pw']) || $pw_pre == $row['user_pw']) {
        if ($pw_after != null) {
            $hash = password_hash($pw_after, PASSWORD_DEFAULT);
            $query = "UPDATE users SET user_pw='$hash', user_name='$name' WHERE user_id='$id'";
            $result = mysqli_query($con, $query);
            $_SESSION['prpost_name'] = $name;
            echo "<script>alert('정보가 수정됐습니다.');</script>";
            echo "<script>location.href='../manage_home.php';</script>";
        } else {
            $query = "UPDATE users SET user_name='$name' WHERE user_id='$id'";
            $result = mysqli_query($con, $query);
            $_SESSION['prpost_name'] = $name;
            echo "<script>alert('정보가 수정됐습니다.');</script>";
            echo "<script>location.href='../manage_home.php';</script>";
        }
    } else {
        echo "<script>alert('이전 비밀번호가 다릅니다.');</script>";
        echo "<script>history.back();</script>";
    }

?>