<?php
    session_start();

    if ($_SESSION['prpost_id'] == null || $_SESSION['prpost_name'] == null) {
        echo "<script>alert('로그인이 필요합니다.');</script>";
        echo "<script>location.href='../manage_login.php';</script>";
        return;
    }

    $findTxt = $_GET['find'];
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
    <link rel="stylesheet" href="assets/css/manage_templet.css">
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
                        <li><span>&times;</span><a href="manage_category.php">카테고리 관리</a></li>
                        <li><span class="select">&times;</span><a href="manage_templet.php" class="select">템플릿 관리</a></li>
                    </ul>
                </div>
                <div class="right_wrap">
                    <div class="input_wrap">
                        <form action="lib/insert_templet_process.php" method="post" id="insert_templet_form" enctype="multipart/form-data">
                            <div class="input_box">
                                <label for="img_file">이미지 업로드 : </label>
                                <input type="file" id="img_file" name="img_file" accept=".jpg, .jpeg, .png">
                            </div>
                            <div class="input_box">
                                <label for="search_tag">검색 태그 : </label>
                                <input type="text" name="search_tag" id="search_tag" placeholder="예시) 병원 학원 우체국">
                            </div>
                            <div class="input_box">
                                <label for="category_check">카테고리 선택 : </label>
                                <?php
                                    include('lib/connect.php');
                                    $query = "SELECT category_num, category_name FROM category ORDER BY order_num";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>
                                        <input type="checkbox" name="category_check[]" class="category_check" value="<?=$row['category_num']?>"><?=$row['category_name']?>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="input_box">
                                <label for="check_view">게시 여부 : </label>
                                <input type="radio" name="check_view" class="search_tag" value="view" checked>게시
                                <input type="radio" name="check_view" class="search_tag" value="noView">숨김
                            </div>
                            <input type="hidden" name="relay" value="relay">
                            <input type="button" name="insert_templet_btn" value="등록" id="insert_templet_btn">
                        </form>
                        <div class="find">
                            <form action="search_templet.php" method="get" id="find_form">
                                <input type="text" id="find" name="find" value="<?=$findTxt?>" placeholder="검색어 입력">
                                <input type="button" id="submit_btn" name="submit_btn" value="검색">
                            </form>
                        </div>
                        <p>* 등록: 이미지 업로드, 태그입력, 노출 카테고리 선택, 게시여부 선택=> 등록</p>
                        <p>* 수정: 대상을 확인후 수정 클릭. 이미지 교체 및 태그, 노출 카테고리, 게시 여부를 수정=> 수정.</p>
                    </div>
                    <div class="templet_list_wrap">
                        <div class="templet_list_box templet_list_box_title">
                            <p class="code text">코드</p>
                            <p class="img text">이미지</p>
                            <p class="category text">카테고리</p>
                            <p class="tag text">검색태그</p>
                            <p class="user text">등록자</p>
                        </div>
                        <?php
                            $query = "SELECT * FROM templet JOIN users ON templet_user = user_id JOIN templet_sub ON templet_code = templet_num JOIN category ON category_key = category_num WHERE templet_num like '%$findTxt%' OR user_name like '%$findTxt%' OR search_tag like '%$findTxt%' OR category_name like '%$findTxt%' OR file_name like '%$findTxt%' GROUP BY templet_num ORDER BY templet_num";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $templetCode = $row['templet_num'];
                        ?>
                                <div class="templet_list_box">
                                    <p class="code text"><?=$row['templet_num']?></p>
                                    <p class="img text"><img src="imgUploads/<?=$row['img_path']?>" alt="포스터 이미지"></p>
                                    <?php
                                        $query2 = "SELECT * FROM templet_sub JOIN category ON category_key = category_num WHERE templet_code = '$templetCode' ORDER BY order_num";
                                        $result2 = mysqli_query($con, $query2);
                                    ?>
                                    <div class="category text">
                                        <?php
                                            while ($row2 = mysqli_fetch_array($result2)) {
                                        ?>
                                                <p><?=$row2['category_name']?></p>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <p class="tag text"><?=$row['search_tag']?></p>
                                    <p class="user text"><?=$row['user_name']?></p>
                                    <div class="text">
                                        <?php
                                            if ($row['view_check'] == 'view') {
                                        ?>
                                            <form action="lib/change_to_no_view_process.php" method="post" class="change_view_form">
                                                <input type="hidden" name="templet_num" value="<?=$row['templet_num']?>">
                                                <input type="hidden" name="relay" value="relay">
                                                <input type="button" class="view_btn" value="게시">
                                            </form>
                                        <?php
                                            } else {
                                        ?>
                                            <form action="lib/change_to_view_process.php" method="post" class="change_no_view_form">
                                                <input type="hidden" name="templet_num" value="<?=$row['templet_num']?>">
                                                <input type="hidden" name="relay" value="relay">
                                                <input type="button" class="no_view_btn" value="숨김">
                                            </form>
                                        <?php
                                            }
                                        ?>
                                        <a href="modify_templet.php?templet_code=<?=$row['templet_num']?>"><input type="button" class="modify_btn" value="수정"></a>                                    
                                        <form action="lib/delete_templet_process.php" method="post" class="delete_templet_form">
                                            <input type="hidden" name="templet_num" value="<?=$row['templet_num']?>">
                                            <input type="hidden" name="relay" value="relay">
                                            <input type="button" class="delete_templet_btn" value="삭제">
                                        </form>
                                    </div>
                                    
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
    <script src="assets/js/manage_templet.js"></script>
</body>
</html>