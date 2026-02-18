document.addEventListener("DOMContentLoaded", function() {

    //Initialisation des la localisation sur Deauville par exemple
    const defautLat = 49.3600;
    const defautLong = 0.0688;

    const inputNom = document.getElementById('nomEvent');
    //Si la map n'existe pas on return, petite sécurité
    const mapElement = document.getElementById('map');
    if(!mapElement) return;

    // Initialisation de la carte centrée sur l'événement pa defaut
    const map = L.map('map').setView([defautLat, defautLong], 15);

    // Ajout du fond de carte OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Ajout d'un marqueur (le "pin") sur les coordonnées
    const marker = L.marker([defautLat, defautLong]).addTo(map)
        .bindPopup("Nouvel événement");

    if(inputNom){
        inputNom.addEventListener('input', function() {
            // On met à jour le contenu de la bulle avec la valeur de l'input
            marker.setPopupContent(this.value || "Nouvel événement");
        });
    }

    const latInput = document.getElementById('lat-input');
    const lngInput = document.getElementById('lng-input');

    //Cette fonction remplie les input avec la longitude et la latitude de la carte en limitant le nombre de chiffre à 6
    function updateInputs(lat, lng) {
        latInput.value = lat.toFixed(6);
        lngInput.value = lng.toFixed(6);
    }

    //Fonction inverse de la précédente
    //Elle permet de mettre à jour la carte en fonction de la long et de la lat qu'on entre dans les inputs
    function updateMarkerFromInputs() {
        // On récupère les valeurs des inputs
        const lat = parseFloat(latInput.value);
        const lng = parseFloat(lngInput.value);

        // On vérifie que ce sont bien des nombres valides
        if (!isNaN(lat) && !isNaN(lng)) {
            // On crée un objet de coordonnées
            const newLatLng = new L.LatLng(lat, lng);

            // On déplace le marqueur
            marker.setLatLng(newLatLng);

            // On recentre la carte sur la nouvelle position
            map.panTo(newLatLng);
        }
    }

    map.on('click', function (e){
        marker.setLatLng(e.latlng);
        updateInputs(e.latlng.lat, e.latlng.lng);
    });

    latInput.addEventListener('input', updateMarkerFromInputs);
    lngInput.addEventListener('input', updateMarkerFromInputs);
});