const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
const modal = new bootstrap.Modal($("#modal"));
const modal2 = new bootstrap.Modal($("#modal2"));
const modal4 = new bootstrap.Modal($("#modal4"));


function cocherTous() {
    console.log("coucou checkbox");
    if ($(this).prop("checked")) {
        $("input[name=checkbox]").prop("checked", true);
    } else {
        $("input[name=checkbox]").prop("checked", false);
    }
}

function restore(){
    let produitid = [];
    $("input[type=checkbox]:checked").each(function () {
        produitid.push($(this).val());
    });
    produitid.forEach((val) => {
        fetch(`../gestionStocks/index/${val}`, {
            method: "patch",
            headers: {
                "X-CSRF-Token": csrfToken,
            },
        });

    });
    setTimeout(() => {
        location.reload();
    }, 200);
}

function supprimerProduits() {
    let produitid = [];
    $("input[type=checkbox]:checked").each(function () {
        produitid.push($(this).val());
    });

    produitid.forEach((val) => {
        fetch(`../gestionStocks/index/${val}`, {
            method: "delete",
            headers: {
                "X-CSRF-Token": csrfToken,
            },
        });
    });
    setTimeout(() => {
        location.reload();
    }, 200);
}

function editProduits() {
    let produitid = [];
    $("input[type=checkbox]:checked").each(function () {
        produitid.push($(this).val());
    });
}

function showModal(){
    modal.toggle();
}

function showModal2() {
    modal2.toggle();
}

function showModal4() {
    modal4.toggle();
}

$(document).ready(function () {
    console.log("coucou readyfonction");
    $(document).on("click", "#checkAll", cocherTous);
    $(document).on("click", "#supprimerProduits", supprimerProduits);
});
