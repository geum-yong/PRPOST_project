const findBox = document.getElementById('find');
const findForm = document.getElementById('find_form');
const submitBtn = document.getElementById('submit_btn');

submitBtn.addEventListener('click', function () {
    let findBoxResult = findBox.value.replace(/(\s*)/g, "");
    if (findBoxResult == "") {
        alert('검색어를 입력해주세요.');
        findBox.focus();
        return;
    } else {
        findForm.action = "search_templet_client.php?page=1&find=" + findBox.value;
        findForm.submit();
    }
})

findBox.addEventListener('keypress', function (e) {
    if (e.keyCode == 13) {
        let findBoxResult = findBox.value.replace(/(\s*)/g, "");
        if (findBoxResult == "") {
            alert('검색어를 입력해주세요.');
            findBox.focus();
            return;
        } else {
            findForm.action = "search_templet_client.php?page=1&find=" + findBox.value;
            findForm.submit();
        }
    } else {
        return;
    }
})

const mainLink = document.getElementById('main_link');
const mainValueForm = document.getElementById('for_main_value');
mainLink.addEventListener('click', function (e) {
    e.preventDefault();
    mainValueForm.submit();
})