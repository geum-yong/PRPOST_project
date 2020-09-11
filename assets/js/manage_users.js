const id = document.getElementById('user_id');
const pw = document.getElementById('user_pw');
const pwCon = document.getElementById('user_pw_con');
const name = document.getElementById('user_name');

const insertUserBtn = document.getElementById('insert_user_btn');
const insertUserForm = document.getElementById('insert_user_form');

insertUserBtn.addEventListener('click', function () {
    if (confirm("등록하시겠습니까?")) {
        const regType1 = /^[A-Za-z0-9]{5,20}$/;
        if (!regType1.test(id.value) || id.value == "") {
            alert('아이디는 영문과 숫자만 사용가능합니다.');
            id.focus();
            return;
        }

        const regType2 = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{6,}$/;
        if (!regType2.test(pw.value) || pw.value == "") {
            alert('비밀번호는 6자리 이상 영문 대 소문자, 숫자 특수문자를 사용하세요.');
            pw.focus();
            return;
        }

        if (pw.value != pwCon.value) {
            alert('비밀번호가 일치하지 않습니다.');
            pw.focus();
            return;
        }

        const regType4 = /^[가-힣]{2,20}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;
        if (!regType4.test(name.value) || name == "") {
            alert('잘못된 이름 형식입니다.');
            name.focus();
            return;
        }

        insertUserForm.submit();
    } else {
        return;
    }
})

const deleteUserBtn = document.getElementsByClassName('delete_user_btn');
const deleteUserForm = document.getElementsByClassName('delete_user_form');
for (let i = 0; i < deleteUserBtn.length; i++) {
    deleteUserBtn[i].addEventListener('click', function () {
        if (confirm("삭제하시겠습니까?")) {
            deleteUserForm[i].submit();
        } else {
            return;
        }
    })
}

const resetPwBtn = document.getElementsByClassName('reset_pw_btn');
const resetPwForm = document.getElementsByClassName('reset_pw_form');
for (let i = 0; i < resetPwBtn.length; i++) {
    resetPwBtn[i].addEventListener('click', function () {
        if (confirm("초기화하시겠습니까?")) {
            resetPwForm[i].submit();
        } else {
            return;
        }
    })
}