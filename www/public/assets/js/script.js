document.addEventListener('DOMContentLoaded', function () {
    // 1. On récupère tous les éléments HTML qui ont la classe .toast
    const toastElements = document.querySelectorAll('.toast');

    // 2. On boucle sur chaque élément pour le transformer en objet Bootstrap Toast
    toastElements.forEach(function (toastEl) {
        // Le paramètre 'delay' indique le temps en millisecondes avant disparition
        const toast = new bootstrap.Toast(toastEl, {
            delay: 3000
        });

        // 3. On déclenche l'affichage
        toast.show();
    });
});