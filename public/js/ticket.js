const modal = new bootstrap.Modal($("#modal"));
const modal2 = new bootstrap.Modal($("#modal2"));
const modal3 = new bootstrap.Modal($("#modal3"));
const modal4 = new bootstrap.Modal($("#modal4"));

function showModal1() {
    modal.toggle();
}

function showModal2() {
    modal2.toggle();
}

function showModal3() {
    modal3.toggle();
}
function showModal4(){
    modal4.toggle();
}

function verifEffacer() {
    var rowCount = $("#Table_id tr").length; // Table size
    var numberOfChecked = $('input:checkbox:checked').length; // checkbox selected
    if (rowCount === 1) { // test si le tableau est vide
        showModal2();
    } else {
        if (numberOfChecked === 0) { // test si rien est selectioné dans le tableau
            showModal3();
        } else {
            showModal1();
        }
    }
}

function effacer() {

    $("table.ticket_table").find('input[name="select"]').each(function () {
        if ($(this).is(":checked")) {
            $(this).parents("table.ticket_table tr").remove();
        }
    });
};


function verifPDF() {
    var rowCount = $("#Table_id tr").length; // Table size
    if (rowCount === 1) { // test si le tableau est vide
        showModal2();
    } else {
    // redirection vers la route de generation PDF
    }
}

