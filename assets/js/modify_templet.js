const modifyTempletBtn = document.getElementById('modify_templet_btn');
const searchTag = document.getElementById('search_tag');
const modifyTempletform = document.getElementById('modify_templet_form');

modifyTempletBtn.addEventListener('click', function () {
    if (confirm("수정하시겠습니까?")) {
        let searchTagResult = searchTag.value.replace(/(\s*)/g, "");
        if (searchTagResult == "") {
            alert('검색 태그를 입력해주세요.');
            searchTag.focus();
            return;
        }

        var arr_form = document.getElementsByClassName('category_check');
        var num = 0;
        for (let i = 0; i < arr_form.length; i++) {
            if (arr_form[i].checked) {
                num++;
            }
        }
        if (!num) {
            alert('카테고리를 하나 이상 선택해주세요.');
            return;
        }

        modifyTempletform.submit();
    } else {
        return;
    }
})

const changeViewBtn = document.getElementsByClassName('view_btn');
const changeViewForm = document.getElementsByClassName('change_view_form');

for (let i = 0; i < changeViewBtn.length; i++) {
    changeViewBtn[i].addEventListener('click', function () {
        if (confirm('템플릿을 숨기시겠습니까?')) {
            changeViewForm[i].submit();
        } else {
            return;
        }
    })
}

const changeNoViewBtn = document.getElementsByClassName('no_view_btn');
const changeNoViewForm = document.getElementsByClassName('change_no_view_form');

for (let i = 0; i < changeNoViewBtn.length; i++) {
    changeNoViewBtn[i].addEventListener('click', function () {
        if (confirm('템플릿을 게시하겠습니까?')) {
            changeNoViewForm[i].submit();
        } else {
            return;
        }
    })
}

const deleteTempletBtn = document.getElementsByClassName('delete_templet_btn');
const deleteTempletForm = document.getElementsByClassName('delete_templet_form');

for (let i = 0; i < deleteTempletBtn.length; i++) {
    deleteTempletBtn[i].addEventListener('click', function () {
        if (confirm('템플릿을 삭제하겠습니까?')) {
            deleteTempletForm[i].submit();
        } else {
            return;
        }
    })
}

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
            findForm.submit();
        }
    } else {
        return;
    }
})