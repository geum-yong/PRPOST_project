<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $orderNum = $_POST["category_num"];
    $categoryName = $_POST["category_name"];
    $categoryUserId = $_POST["category_user"];
    $relay = $_POST["relay"];

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    include('connect.php');

    $query = "SELECT * FROM category WHERE order_num = '$orderNum'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);

    if ($count == 0) {
        $query = "SELECT * FROM category WHERE category_name = '$categoryName'";
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            $query = "INSERT INTO category (category_name, user_key, category_date, order_num) VALUES ('$categoryName', '$categoryUserId', NOW(), '$orderNum')";
            $result = mysqli_query($con, $query);
            
            echo "<script>alert('등록하였습니다.');</script>";
            echo "<script>location.href='../manage_category.php';</script>";
        } else {
            echo "<script>alert('이미 있는 카테고리 명입니다.'); history.back();</script>";
            return;
        }
    } else {
        echo "<script>alert('이미 카테고리가 있는 순번입니다.'); history.back();</script>";
        return;
    }
?>