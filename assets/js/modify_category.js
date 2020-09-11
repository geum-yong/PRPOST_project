const categoryNum = document.getElementById('category_num');
const categoryName = document.getElementById('category_name');
const categoryUser = document.getElementById('category_user');

const updateCategoryBtn = document.getElementById('update_category_btn');
const updateCategoryForm = document.getElementById('update_category_form');

updateCategoryBtn.addEventListener('click', function () {
    if (confirm("수정하시겠습니까?")) {
        const categoryNumResult = categoryNum.value.replace(/(\s*)/g, "");
        if (categoryNumResult == "") {
            alert('정렬순서를 입력해주세요.');
            categoryNum.focus();
            return;
        }

        const orderNum = Math.round(categoryNum.value);
        if (orderNum <= 0 || orderNum > 8) {
            alert('1~8의 숫자만 사용가능합니다.');
            categoryNum.focus();
            return;
        }

        const categoryNameResult = categoryName.value.replace(/(\s*)/g, "");
        if (categoryNameResult == "") {
            alert('카테고리 명을 입력해주세요.');
            categoryName.focus();
            return;
        }

        updateCategoryForm.submit();
    } else {
        return;
    }
})

const deleteCategoryBtn = document.getElementsByClassName('delete_category_btn');
const deleteCategoryForm = document.getElementsByClassName('delete_category_form');
for (let i = 0; i < deleteCategoryBtn.length; i++) {
    deleteCategoryBtn[i].addEventListener('click', function () {
        if (confirm("삭제하시겠습니까?")) {
            deleteCategoryForm[i].submit();
        } else {
            return;
        }
    })
}