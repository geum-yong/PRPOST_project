const prePw = document.getElementById('user_pw_pre');
const afterPw = document.getElementById('user_pw');
const afterPwCon = document.getElementById('user_pw_con');
const name = document.getElementById('user_name');

const modifyBtn = document.getElementById('modify_btn');
const modifyForm = document.getElementById('modify_form');

modifyBtn.addEventListener('click', function () {
    if (confirm("수정하시겠습니까?")) {
        let prePwResult = prePw.value.replace(/(\s*)/g, "");
        if (prePwResult == "") {
            alert('기존 비밀번호를 입력하세요.');
            prePw.focus();
            return;
        }

        let nameResult = name.value.replace(/(\s*)/g, "");
        if (nameResult == "") {
            alert('이름을 입력하세요.');
            name.focus();
            return;
        }

        let afterPwResult = afterPw.value.replace(/(\s*)/g, "");
        let afterPwConResult = afterPwCon.value.replace(/(\s*)/g, "");

        if (afterPwResult != "" || afterPwConResult != "") {
            if (afterPwResult == "") {
                alert('변경할 비밀번호를 입력하세요.');
                afterPw.focus();
                return;
            }

            if (afterPwConResult == "") {
                alert('변경할 비밀번호 확인을 입력하세요.');
                afterPwCon.focus();
                return;
            }

            const regType = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{6,50}$/;
            if (!regType.test(afterPw.value)) {
                alert('6자리 이상 영문 대 소문자, 숫자 특수문자를 사용하세요.');
                afterPw.focus();
                return;
            }

            if (afterPw.value != afterPwCon.value) {
                alert('변경할 비밀번호가 일치하지 않습니다.');
                afterPw.focus();
                return;
            }
        }

        modifyForm.submit();
    } else {
        return;
    }
})