const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

const modal = new bootstrap.Modal($("#modal"));
const modal2 = new bootstrap.Modal($("#modal2"));
const modal3 = new bootstrap.Modal($("#modalpdf"));

function cocherTous() {
    console.log("coucou checkbox");
    if ($(this).prop("checked")) {
        $("input[name=checkbox]").prop("checked", true);
    } else {
        $("input[name=checkbox]").prop("checked", false);
    }
}

function restore(){
    let userid = [];
    $("input[type=checkbox]:checked").each(function () {
        userid.push($(this).val());
    });
    userid.forEach((val) => {
        fetch(`../menu/user/${val}`, {
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

function showModal() {
    modal.toggle();
}

function showModal2() {
    modal2.toggle();
}

function showModal3() {
    console.log("modal 3");
    modal3.toggle();
}

function supprimerUtilisateur() {
    let userid = [];
    $("input[type=checkbox]:checked").each(function () {
        userid.push($(this).val());
    });

    userid.forEach((val) => {
        fetch(`../menu/user/${val}`, {
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

$(document).ready(function () {
    console.log("coucou readyfonction");
    $(document).on("click", "#checkAll", cocherTous);
    $(document).on("click", "#supprimerUtilisateur", supprimerUtilisateur);
});



