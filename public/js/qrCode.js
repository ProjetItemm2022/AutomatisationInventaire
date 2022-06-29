const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
const modal3 = new bootstrap.Modal($("#modalpdf"));
const modalPasSelect = new bootstrap.Modal($("#modalPasSelect"));

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
function showModal1() {
    console.log("modal pas de selection");
    modalPasSelect.toggle();
}

function verifqrCode() {
     // Table size
    var numberOfChecked = $('input:checkbox:checked').length; // checkbox selected

        if (numberOfChecked === 0) { // test si rien est selectionné dans le tableau
            showModal1();
        } else {
            showModal3();
        }
    }


$(document).ready(function () {
    $(document).on("click", "#checkAll", cocherTous);
});
