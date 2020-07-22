/* Demande de confirmation suppression */

var btnSuppr = document.querySelector('.btn_suppr');

if (btnSuppr) {
    btnSuppr.addEventListener("click", () => {
        if (confirm("Êtes-vous sûr de vouloir procéder à la suppression ?")) {
            return true;
        } else {
            event.preventDefault();
            event.stopPropagation();
        }
    })

}