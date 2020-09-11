<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $categoryNum = $_POST['category_num'];
    $relay = $_POST['relay'];

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    include('connect.php');
    $query = "SELECT * FROM templet_sub WHERE category_key = '$categoryNum'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);

    if ($count != 0) {
        echo "<script>alert('템플릿이 존재합니다.');</script>";
        echo "<script>location.href='../manage_category.php';</script>";
        return;
    } else {
        $query = "DELETE FROM category WHERE category_num = '$categoryNum'";
        $result = mysqli_query($con, $query);
    
        echo "<script>alert('삭제하였습니다.');</script>";
        echo "<script>location.href='../manage_category.php';</script>";
    }
?>
