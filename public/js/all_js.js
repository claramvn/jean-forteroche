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

/* Modification comportement pour inputs date formulaire de modif d'un post */

var btnInput = document.querySelector('.btn_input');
var dateInput = document.querySelector('.date_input');
var timeInput = document.querySelector('.time_input');

if (btnInput) {
    btnInput.addEventListener("click", () => {
        dateInput.style.display = "block";
        dateInput.disabled = false;
        timeInput.style.display = "block";
        timeInput.disabled = false;
    })

}