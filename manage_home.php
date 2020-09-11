<?php
    session_start();

    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('로그인이 필요합니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prpost-관리자페이지</title>

    <!-- 폰트 -->
    <!-- 나눔고딕 -->
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic&display=swap" rel="stylesheet">

    <!-- style -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/manage_home.css">
</head>
<body>
    <div class="wrap">
        <div class="contents_box">
            <div class="top_wrap">
                <div class="txt_box">
                    <p class="welcome_txt"><?=$_SESSION['prpost_name']?>님 환영합니다.</p>
                    <button id="logout_btn">LogOut</button>
                </div>
            </div>
            <ul class="bottom_wrap">
                <li><span>&times;</span><a href="modify_myinfo.php" data-text="내 정보 수정">내 정보 수정</a></li>
                <li><span>&times;</span><a href="manage_users.php" data-text="사용자 관리">사용자 관리</a></li>
                <li><span>&times;</span><a href="manage_category.php" data-text="카테고리 관리">카테고리 관리</a></li>
                <li><span>&times;</span><a href="manage_templet.php" data-text="템플릿 관리">템플릿 관리</a></li>
            </ul>
        </div>
    </div>

    <script src="assets/js/logout.js"></script>
</body>
</html>