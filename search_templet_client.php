<?php
    header('Cache-Control: no cache');
    session_cache_limiter('private_no_expire');
    session_start();
    
    $page = $_GET['page'];
    $findTxt = $_GET['find'];

    if ($findTxt == null) {
        echo "<script>alert('잘못된 주소입니다.');</script>";
        echo "<script>history.back();</script>";
        return;
    }

    $menu = $_REQUEST['menu'];
    $bReceiptNo = $_REQUEST['bReceiptNo'];
    $r_url = $_REQUEST['r_url'];

    include('lib/connect.php');
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
    <link rel="stylesheet" href="assets/css/templet_list.css">
</head>
  <body>
    <div class="wrap">
        <div class="container">
            <div class="title">
                <h1>생활정보홍보우편 디자인 템플릿 샘플 조회</h1>
            </div>
            <div class="find">
                <form method="POST" id="find_form">
                    <input type="text" id="find" name="find" placeholder="<?=$findTxt?>">
                    <input type="hidden" name="menu" value="<?=$menu?>">
                    <input type="hidden" name="bReceiptNo" value="<?=$bReceiptNo?>">
                    <input type="hidden" name="r_url" value="<?=$r_url?>">
                    <input type="button" id="submit_btn" name="submit_btn" value="검색">
                </form>
            </div>
            <div class="cate">
                <form action="templet_list.php?page=1" id="for_main_value" method="POST">
                    <input type="hidden" name="menu" value="<?=$menu?>">
                    <input type="hidden" name="bReceiptNo" value="<?=$bReceiptNo?>">
                    <input type="hidden" name="r_url" value="<?=$r_url?>">
                </form>
                <p>'<span><?=$findTxt?></span>' 검색 결과입니다. <a href="#" id="main_link">메인으로 가기</a></p>
            </div>
            <div class="img_list_wrap">
                <?php
                    $query = "SELECT * FROM templet JOIN users ON templet_user = user_id JOIN templet_sub ON templet_code = templet_num JOIN category ON category_key = category_num WHERE view_check='view' and (templet_num like '%$findTxt%' OR user_name like '%$findTxt%' OR search_tag like '%$findTxt%' OR category_name like '%$findTxt%' OR file_name like '%$findTxt%') GROUP BY templet_num ORDER BY templet_num";
                    $result = mysqli_query($con, $query);

                    $total_article = mysqli_num_rows($result);
                    $view_article = 8;
                    if (!$page) {
                        $page = 1;
                    }
                    $start = ($page-1)*$view_article;
                
                    $query = "SELECT * FROM templet JOIN users ON templet_user = user_id JOIN templet_sub ON templet_code = templet_num JOIN category ON category_key = category_num WHERE view_check='view' and (templet_num like '%$findTxt%' OR user_name like '%$findTxt%' OR search_tag like '%$findTxt%' OR category_name like '%$findTxt%' OR file_name like '%$findTxt%') GROUP BY templet_num ORDER BY templet_num desc LIMIT $start, $view_article";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_array($result)) {
                ?>
                        <div class="img_box">
                            <div class="img" onclick="window.open('templet_description.php?templet_code=<?=$row['templet_num']?>', '템플릿 팝업', 'width=530, height=825, left=50%, top=50%'); return false">
                                <img src="imgUploads/<?=$row['img_path']?>" alt="전단지 이미지">
                            </div>
                            <div class="select_box">
                                <form action="<?=$r_url?>" name="imgCodeRequest" method="POST">
                                    <input type="hidden" name="menu" value="<?=$menu?>">
                                    <input type="hidden" name="bReceiptNo" value="<?=$bReceiptNo?>">
                                    <input type="hidden" name="bTemplateId" value="<?=$row['templet_num']?>">
                                    <input type="submit" id="submit_btn" value="이 디자인 선택">
                                </form>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        <div class = "page_nums">
            <?php
                $total_page = ceil($total_article/$view_article);

                if ($page == null || $page < 1 || $page > $total_page) {
                    echo "<script>alert('존재하는 템플릿이 없습니다.');</script>";
                } else {

                if ($page % 5) {
                    $start_page = $page-$page % 5 + 1;
                } else {
                    $start_page = $page - 4;
                }
                $end_page = $start_page + 5;

                // 이전 그룹 이동
                $prev_group = $start_page -1;
                if ($prev_group < 1) {
                    $prev_group = 1;
                }

                // 다음 그룹 이동
                $next_group = $end_page;
                if ($next_group > $total_page) {
                    $next_group = $total_page;
                }

                // 처음 페이지
                if ($page != 1) {
            ?>
                    <form action="<?=$_SERVER['PHP_SELF']?>?page=1&find=<?=$findTxt?>" method="POST" class="dp_ib">
                        <input type="hidden" name="menu" value="<?=$menu?>">
                        <input type="hidden" name="bReceiptNo" value="<?=$bReceiptNo?>">
                        <input type="hidden" name="r_url" value="<?=$r_url?>">
                        <input type="submit" value="처음" class="fz20_p5_10 outline_none cursor_pointer border0">
                    </form>
            <?php
                } else {
            ?>
                    <form action="#" method="POST" class="dp_ib">
                        <input type="submit" value="처음" class="fz20_p5_10 border0 no_link">
                    </form>
            <?php
                }
                
                // 이전 그룹 이동 표시
                if ($page != 1) {
            ?>
                    <form action="<?=$_SERVER['PHP_SELF']?>?page=<?=$prev_group?>&find=<?=$findTxt?>" method="POST" class="dp_ib">
                        <input type="hidden" name="menu" value="<?=$menu?>">
                        <input type="hidden" name="bReceiptNo" value="<?=$bReceiptNo?>">
                        <input type="hidden" name="r_url" value="<?=$r_url?>">
                        <input type="submit" value="&#9664;" class="fz20_p5_10 outline_none cursor_pointer border0">
                    </form>
            <?php
                } 

                for ($i=$start_page; $i < $end_page; $i++) { 
                    if ($i > $total_page) {
                        break;
                    }
                    if ($i == $page) {
            ?>
                        <form action="#" method="POST" class="dp_ib">
                            <input type="submit" value="<?=$i?>" class="fz20_p5_10 no_link current_num">
                        </form>
            <?php
                    } else {
            ?>
                        <form action="<?=$_SERVER['PHP_SELF']?>?page=<?=$i?>&find=<?=$findTxt?>" method="POST" class="dp_ib">
                            <input type="hidden" name="menu" value="<?=$menu?>">
                            <input type="hidden" name="bReceiptNo" value="<?=$bReceiptNo?>">
                            <input type="hidden" name="r_url" value="<?=$r_url?>">
                            <input type="submit" value="<?=$i?>" class="fz20_p5_10 outline_none cursor_pointer border0">
                        </form>
            <?php
                    }
                }

                // 다음 그룹 이동 표시
                if ($page < $total_page) {
            ?>
                    <form action="<?=$_SERVER['PHP_SELF']?>?page=<?=$next_group?>&find=<?=$findTxt?>" method="POST" class="dp_ib">
                        <input type="hidden" name="menu" value="<?=$menu?>">
                        <input type="hidden" name="bReceiptNo" value="<?=$bReceiptNo?>">
                        <input type="hidden" name="r_url" value="<?=$r_url?>">
                        <input type="submit" value="&#9654;" class="fz20_p5_10 outline_none cursor_pointer border0">
                    </form>
            <?php
                }

                // 마지막 페이지
                if ($page != $total_page) {
            ?>
                    <form action="<?=$_SERVER['PHP_SELF']?>?page=<?=$total_page?>&find=<?=$findTxt?>" method="POST" class="dp_ib">
                        <input type="hidden" name="menu" value="<?=$menu?>">
                        <input type="hidden" name="bReceiptNo" value="<?=$bReceiptNo?>">
                        <input type="hidden" name="r_url" value="<?=$r_url?>">
                        <input type="submit" value="마지막" class="fz20_p5_10 outline_none cursor_pointer border0">
                    </form>
            <?php
                } else {
            ?>
                    <form action="#" method="POST" class="dp_ib">
                        <input type="submit" value="마지막" class="fz20_p5_10 border0 no_link">
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <script src="assets/js/templet_list.js"></script>
  </body>
</html>
