<?php
    session_start();

    if ($_SESSION['prpost_id'] != 'admin' && $_SESSION['prpost_id'] != 'developer') {
        echo "<script>alert('관리자 계정만 접근 가능합니다.');</script>";
        echo "<script>history.back();</script>";
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
    <link rel="stylesheet" href="assets/css/manage_users.css">
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
                        <li><span>&times;</span><a href="modify_myinfo.php">내 정보 수정</a></li>
                        <li><span class="select">&times;</span><a href="manage_users.php" class="select">사용자 관리</a></li>
                        <li><span>&times;</span><a href="manage_category.php">카테고리 관리</a></li>
                        <li><span>&times;</span><a href="manage_templet.php">템플릿 관리</a></li>
                    </ul>
                </div>
                <div class="right_wrap">
                    <form action="lib/insert_user_process.php" method="post" id="insert_user_form">
                        <h2>사용자 등록</h2>
                        <div class="input">
                            <label for="user_id">아이디</label>
                            <input type="text" name="user_id" id="user_id">
                        </div>
                        <div class="input">
                            <label for="user_pw">비밀번호</label>
                            <input type="password" name="user_pw" id="user_pw">
                            <p>* 6자리 이상 영문 대 소문자, 숫자 특수문자를 사용하세요.</p>
                        </div>
                        <div class="input">
                            <label for="user_pw_con">비밀번호 확인</label>
                            <input type="password" name="user_pw_con" id="user_pw_con">
                        </div>
                        <div class="input">
                            <label for="user_name">이름</label>
                            <input type="text" name="user_name" id="user_name">
                        </div>
                        <div class="input">
                            <input type="hidden" name="relay" value="relay">
                            <input type="button" id="insert_user_btn" value="등록">
                        </div>
                    </form>
                    <div class="user_list">
                        <h2>사용자 리스트</h2>
                            <div class="user_info_box user_info_title">
                                <p>아이디</p>
                                <p>이름</p>
                            </div>

                        <?php
                            include('lib/connect.php');
                            $query = "SELECT * FROM users WHERE num > 1";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                            
                            <div class="user_info_box">
                                <p><?=$row['user_id']?></p>
                                <p><?=$row['user_name']?></p>
                                <form action="lib/delete_user_process.php" method="post" class="delete_user_form">
                                    <input type="hidden" name="user_id" value="<?=$row['user_id']?>">
                                    <input type="hidden" name="relay" value="relay">
                                    <input type="button" class="button delete_user_btn" value="삭제">
                                </form>
                                <form action="lib/reset_pw_process.php" method="post" class="reset_pw_form">
                                    <input type="hidden" name="user_id" value="<?=$row['user_id']?>">
                                    <input type="hidden" name="relay2" value="relay2">
                                    <input type="button" class="button reset_pw_btn" value="PW초기화">
                                </form>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/logout.js"></script>
    <script src="assets/js/manage_users.js"></script>
</body>
</html>