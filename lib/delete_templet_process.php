<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $templetNum = $_POST["templet_num"];
    $relay = $_POST['relay'];

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../index.php';</script>";
        return;
    }

    include('connect.php');

    $query = "SELECT img_path FROM templet WHERE templet_num='$templetNum'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    unlink($_SERVER['DOCUMENT_ROOT'] . "/imgUploads/" . $row['img_path']);

    $query = "DELETE FROM templet_sub WHERE templet_code='$templetNum'";
    $result = mysqli_query($con, $query);

    $query = "DELETE FROM templet WHERE templet_num='$templetNum'";
    $result = mysqli_query($con, $query);

    echo "<script>alert('템플릿을 삭제하였습니다.');</script>";
    echo "<script>location.href='../manage_templet.php';</script>";
?>
