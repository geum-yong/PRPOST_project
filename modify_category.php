<?php
    session_start();

    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('로그인이 필요합니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $categoryNum = $_GET['category_num'];

    include('lib/connect.php');
    $query = "SELECT * FROM category WHERE category_num = '$categoryNum'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo "<script>alert('존재하지 않는 카테고리입니다.');</script>";
        echo "<script>location.href='../manage_category.php';</script>";
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
    <link rel="stylesheet" href="assets/css/manage_category.css">
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
                        <li><span>&times;</span><a href="manage_users.php">사용자 관리</a></li>
                        <li><span class="select">&times;</span><a href="manage_category.php" class="select">카테고리 관리</a></li>
                        <li><span>&times;</span><a href="manage_templet.php">템플릿 관리</a></li>
                    </ul>
                </div>
                <div class="right_wrap">
                    <form action="lib/modify_category_process.php" method="post" id="update_category_form">
                        <h2>카테고리 등록</h2>
                        <div class="input">
                            <label for="category_num">정렬순서</label>
                            <input type="number" name="category_num" id="category_num" value="<?=$row['order_num']?>">
                        </div>
                        <div class="input">
                            <label for="category_name">카테고리 명</label>
                            <input type="text" name="category_name" id="category_name" value="<?=$row['category_name']?>">
                        </div>
                        <div class="input">
                            <label for="category_user">등록자</label>
                            <input type="text" id="category_user" value="<?=$_SESSION['prpost_name']?>" disabled>
                        </div>
                        <div class="input">
                            <input type="hidden" name="relay" value="relay">
                            <input type="hidden" name="category_key" value="<?=$row['category_num']?>">
                            <input type="hidden" name="category_user" value="<?=$_SESSION['prpost_id']?>">
                            <input type="button" id="update_category_btn" value="수정">
                        </div>
                    </form>
                    <div class="user_list">
                        <h2>카테고리 리스트</h2>
                            <div class="user_info_box user_info_title">
                                <p>순서</p>
                                <p>카테고리 명</p>
                                <p>등록자</p>
                                <p>등록일</p>
                            </div>

                        <?php
                            $query = "SELECT * FROM category LEFT JOIN users ON user_key = user_id ORDER BY order_num";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <div class="user_info_box">
                                <p><?=$row['order_num']?></p>
                                <p><?=$row['category_name']?></p>
                                <p><?
                                    if ($row['user_name'] == null) {
                                        echo "삭제된 사용자";
                                    } else {
                                        echo $row['user_name'];
                                    }
                                ?></p>
                                <p><?=$row['category_date']?></p>
                                <form action="lib/delete_category_process.php" method="post" class="delete_category_form">
                                    <input type="hidden" name="category_num" value="<?=$row['category_num']?>">
                                    <input type="hidden" name="relay" value="relay">
                                    <input type="button" class="button delete_category_btn" value="삭제">
                                </form>
                                <a href="modify_category.php?category_num=<?=$row['category_num']?>">
                                    <input type="button" class="button modify_category_btn" value="수정">
                                </a>
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
    <script src="assets/js/modify_category.js"></script>
</body>
</html>