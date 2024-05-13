document.addEventListener('DOMContentLoaded', function () {
    // Agrega un evento de escucha al documento para capturar los eventos de input en cualquier parte del documento
    document.addEventListener('input', function (event) {
        // Verifica si el elemento que activó el evento de input es el campo de búsqueda
        if (event.target.id === 'searchInput') {
            const searchTerm = event.target.value.toLowerCase();
            const taula = document.getElementById('taula');

            // Verifica si los elementos se han encontrado correctamente
            if (taula) {
                // Filtra las canciones basadas en el término de búsqueda
                Array.from(taula.children).forEach(function (song) {
                    const songTitle = song.querySelector('h4').textContent.toLowerCase();
                    const artistName = song.querySelector('p').textContent.toLowerCase();

                    // Verifica si el título de la canción o el nombre del artista coinciden con el término de búsqueda
                    if (songTitle.includes(searchTerm) || artistName.includes(searchTerm)) {
                        song.style.display = 'block'; // Muestra la canción si coincide
                    } else {
                        song.style.display = 'none'; // Oculta la canción si no coincide
                    }
                });
            }
        }
    });
});
