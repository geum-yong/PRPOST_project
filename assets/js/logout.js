// 로그아웃 버튼 클릭
const logoutBtn = document.getElementById('logout_btn');
logoutBtn.addEventListener('click', function () {
    if (confirm("로그아웃 하시겠습니까?")) {
        location.href = "lib/logout_process.php";
    } else {
        return;
    }
})