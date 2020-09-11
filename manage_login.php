<?php
    session_start();

    if ($_SESSION['prpost_id'] != null || $_SESSION['prpost_name'] != null) {
        echo "<script>alert('이미 로그인을 했습니다.');</script>";
        echo "<script>location.href='../manage_home.php';</script>";
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
    <link rel="stylesheet" href="assets/css/manage_login.css">
</head>
<body>
    <div class="wrap">
        <div class="contents_box">
            <form action="lib/login_process.php" method="post">
                <h2 class="title">Login</h2>
                <div class="input">
                    <div class="input_box">
                        <label for="user_id">Username</label>
                        <input type="text" name="user_id" id="user_id" placeholder="아이디 입력">
                    </div>
                    <div class="input_box">
                        <label for="user_pw">Password</label>
                        <input type="password" name="user_pw" id="user_pw" placeholder="비밀번호 입력">
                    </div>
                    <div class="input_box">
                        <input type="hidden" name="relay" value="relay">
                        <input type="submit" value="Sign In">
                    </div>
                    <p>비밀번호를 잊어버렸다면 관리자에게 문의해주세요.</p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>