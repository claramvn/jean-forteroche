/* Demande de confirmation suppression */

var btnSuppr = document.querySelector('.btn_suppr');

function confirmDelete(e) {
    if (!confirm("Êtes-vous sûr de vouloir procéder à la suppression ?")) {
        event.preventDefault();
        event.stopPropagation();
    }
}