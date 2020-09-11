<?php
    session_start();
    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    include('connect.php');

    $id = $_SESSION['prpost_id'];
    $searchTag = $_POST["search_tag"];
    $categoryCheck = $_POST["category_check"];
    $viewCheck = $_POST["check_view"];
    $relay = $_POST["relay"];

    if ($relay == "") {
        echo "<script>alert('비정상적인 접근입니다.');</script>";
        echo "<script>location.href='../index.php';</script>";
        return;
    }

    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
    $str = str_shuffle($str);
    $str = substr($str, 0, 10);
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/imgUploads/";
    $target_file_temp = $target_dir . basename($_FILES["img_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file_temp,PATHINFO_EXTENSION));
    $target_file = $target_dir . $str . "." . $imageFileType;
    $fileName = $str . "." . $imageFileType;
    $realFileName = basename($_FILES["img_file"]["name"]);

    // 이미지 파일인지 아닌지 확인
    if(isset($_POST["insert_templet_btn"])) {
        $check = getimagesize($_FILES["img_file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('이미지 파일이 아닙니다.');</script>";
            $uploadOk = 0;
        }
    }

    // 이미지 파일명 중복 확인
    if (file_exists($target_file)) {
        echo "<script>alert('이미 존재하는 이미지 파일명입니다.');</script>";
        $uploadOk = 0;
    }

    // 이미지 사이즈 체크
    if ($_FILES["img_file"]["size"] > 5000000) { // 5메가바이트
        echo "<script>alert('5MB 미만의 이미지만 업로드 가능합니다.');</script>";
        $uploadOk = 0;
    }

    // 이미지 파일인지 확인
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('jpg, png, jpeg 파일만 업로드 가능합니다.');</script>";
        $uploadOk = 0;
    }

    // 업로드 가능한지 불가능한지 확인
    if ($uploadOk == 0) {
        echo "<script>alert('다시 작성해주시기 바랍니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    // 업로드가 가능할 때 밑의 작업 수행
    } else {
        if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO templet (img_path, search_tag, view_check, templet_user, file_name, date) VALUES ('$fileName', '$searchTag', '$viewCheck', '$id', '$realFileName', NOW())";
            $result = mysqli_query($con, $query);

            $query = "SELECT templet_num FROM templet WHERE img_path = '$fileName'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_array($result);

            $templet_code = $row['templet_num'];

            foreach ($categoryCheck as $value) {
                $query = "INSERT INTO templet_sub (templet_code, category_key) VALUES ('$templet_code', '$value')";
                $result = mysqli_query($con, $query);
            }

            // $query1 = "ALTER TABLE templet AUTO_INCREMENT=1";
            // mysqli_query($con, $query1);
            // $query2 = "SET @CNT = 0";
            // mysqli_query($con, $query2);
            // $query3 = "UPDATE templet SET templet.templet_num = @CNT:=@CNT+1";
            // mysqli_query($con, $query3);

            echo "<script>alert('템플릿을 저장했습니다.');</script>";
            echo "<script>location.href='../manage_templet.php';</script>";

        } else {
            echo "<script>alert('오류가 났습니다. 다시 작성해주세요.');</script>";
            echo "<script>history.back();</script>";
        }
    }



    
?>