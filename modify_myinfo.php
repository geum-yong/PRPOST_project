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
    <link rel="stylesheet" href="assets/css/modify_myinfo.css">
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
            <div class="bottom_wrap">
                <div class="left_wrap">
                    <ul>
                        <li><span class="select">&times;</span><a href="modify_myinfo.php" class="select">내 정보 수정</a></li>
                        <li><span>&times;</span><a href="manage_users.php">사용자 관리</a></li>
                        <li><span>&times;</span><a href="manage_category.php">카테고리 관리</a></li>
                        <li><span>&times;</span><a href="manage_templet.php">템플릿 관리</a></li>
                    </ul>
                </div>
                <div class="right_wrap">
                    <form action="lib/modify_myinfo_process.php" method="post" id="modify_form">
                        <div class="input">
                            <label for="user_id">아이디 (수정불가)</label>
                            <input type="text" id="user_id" value="<?=$_SESSION['prpost_id']?>" disabled>
                        </div>
                        <div class="input">
                            <label for="user_pw_pre">기존 비밀번호</label>
                            <input type="password" name="user_pw_pre" id="user_pw_pre">
                        </div>
                        <div class="input">
                            <label for="user_pw">변경할 비밀번호</label>
                            <input type="password" name="user_pw" id="user_pw" placeholder="변경 시 입력">
                            <p>* 6자리 이상 영문 대 소문자, 숫자 특수문자를 사용하세요.</p>
                        </div>
                        <div class="input">
                            <label for="user_pw_con">변경할 비밀번호 확인</label>
                            <input type="password" name="user_pw_con" id="user_pw_con" placeholder="변경 시 입력">
                        </div>
                        <div class="input">
                            <label for="user_name">이름</label>
                            <input type="text" name="user_name" id="user_name" value="<?=$_SESSION['prpost_name']?>">
                        </div>
                        <div class="input">
                            <input type="hidden" name="relay" value="relay">
                            <input type="hidden" name="user_id" value="<?=$_SESSION['prpost_id']?>">
                            <input type="button" id="modify_btn" value="수정">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/logout.js"></script>
    <script src="assets/js/modify_myinfo.js"></script>
</body>
</html>