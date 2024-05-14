document.addEventListener('DOMContentLoaded', function () {
    // Afegir un esdeveniment d'escolta al document per capturar els esdeveniments d'entrada en qualsevol part del document
    document.addEventListener('input', function (event) {
        // Comprovar si l'element que ha activat l'esdeveniment d'entrada és el camp de cerca
        if (event.target.id === 'searchInput') {
            const termeCerca = event.target.value.toLowerCase();
            const taula = document.getElementById('taula');

            // Comprovar si els elements s'han trobat correctament
            if (taula) {
                // Filtrar les cançons basades en el terme de cerca
                Array.from(taula.children).forEach(function (canco) {
                    const titolCanco = canco.querySelector('h4').textContent.toLowerCase();
                    const nomArtista = canco.querySelector('p').textContent.toLowerCase();

                    // Comprovar si el títol de la cançó o el nom de l'artista coincideixen amb el terme de cerca
                    if (titolCanco.includes(termeCerca) || nomArtista.includes(termeCerca)) {
                        canco.style.display = 'block'; // Mostra la cançó si coincideix
                    } else {
                        canco.style.display = 'none'; // Amaga la cançó si no coincideix
                    }
                });
            }
        }
    });
});
