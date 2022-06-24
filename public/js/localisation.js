const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

const modal = new bootstrap.Modal($("#modal"));

function showModal() {
    modal.toggle();
}
var chec = 0

function verifSelection() {
    if (chec = 0) {
        console.log(chec);
        showModal();
    }
}
function salles()
{
    let idz = obj.id;
        fetch(`../localisationSalle${idz}`, {
            method: "get",
            headers: {
                "X-CSRF-Token": csrfToken,
            },
        });

}
function salle(id) {
    /*$.ajax({
        type: "GET",
        url: "{{ url('getSalle') }}?id=" + id,
        success: function(res) {

            if (res) {

                console.log(res);




            } else {

                console.log("vide");
            }
        }
    });*/
}
