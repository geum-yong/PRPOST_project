<?php
    $templetCode = $_GET['templet_code'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>생활정보홍보우편</title>

    <!-- 폰트 -->
    <!-- 나눔고딕 -->
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic&display=swap" rel="stylesheet">

    <!-- style -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/templet_description.css">
</head>
<body>
    <?php
        include('lib/connect.php');
        $query = "SELECT * FROM templet WHERE templet_num = '$templetCode'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result)
    ?>
    <div class="wrap">
        <p class="txt1">해당 샘플 번호는 <span><?=$row['templet_num']?></span>입니다.</p>
        <p class="txt2">신청서에 기재해 주시면 시안 작업 후 연락 드리겠습니다.</p>
        <img src="imgUploads/<?=$row['img_path']?>" alt="전단지 이미지">
        <div class="btn">
            <a href="" onclick="self.close();">닫기</a>
        </div>
    </div>

</body>
</html>