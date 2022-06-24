const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
const modal3 = new bootstrap.Modal($("#modalpdf"));

function cocherTous() {
    console.log("coucou checkbox");
    if ($(this).prop("checked")) {
        $("input[name=checkbox]").prop("checked", true);
    } else {
        $("input[name=checkbox]").prop("checked", false);
    }
}
function showModal3() {
    console.log("modal 3");
    modal3.toggle();
}

function verifqrCode() {
    var rowCount = $("#").length; // Table size
    var numberOfChecked = $('input:checkbox:checked').length; // checkbox selected
    if (rowCount === 1) { // test si le tableau est vide
        showModal3();
    } else {
        if (numberOfChecked === 0) { // test si rien est selectioné dans le tableau
            showModal3();
        } else {
            showModal1();
        }
    }
}

$(document).ready(function () {
    $(document).on("click", "#checkAll", cocherTous);
});
