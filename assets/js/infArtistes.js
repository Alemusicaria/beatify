document.addEventListener('DOMContentLoaded', function () {
    var selectedArtist = localStorage.getItem('selectedArtist');
    console.log(selectedArtist);

    $.ajax({
        url: '../assets/php/obtainInfArtist.php',
        type: 'POST',
        data: { selectedArtist },
        success: function (response) {
            console.log(response);
            var artista = JSON.parse(response);
            console.log(artista);
            mostrarInformacionArtista(artista);
        },
        error: function (error) {
            console.log('Error en obtener las canciones:', error);
        }
    });
    function mostrarInformacionArtista(artista) {
        // Mostrar los álbumes
        var tablaAlbums = document.getElementById("tablaAlbums");
        tablaAlbums.innerHTML = "";
        console.log("Álbumes:");
        console.log(artista.canciones); // Verifiquemos que artista.canciones es un objeto
    
        // Iterar sobre las claves del objeto artista.canciones
        Object.keys(artista.canciones).forEach(function(key) {
            var cancion = artista.canciones[key]; // Obtener la canción actual
            cancion.Albums.forEach(function(album) { // Iterar sobre los álbumes de la canción
                var albumElemento = document.createElement("div");
                albumElemento.textContent = album;
                tablaAlbums.appendChild(albumElemento);
            });
        });
    
        // Mostrar las canciones
        var tablaCanciones = document.getElementById("tablaCanciones");
        tablaCanciones.innerHTML = "";
        console.log("Canciones:");
        console.log(Object.keys(artista.canciones)); // Imprimimos las claves del objeto
        Object.keys(artista.canciones).forEach(function(key) {
            var cancion = artista.canciones[key];
            var cancionElemento = document.createElement("div");
            cancionElemento.textContent = cancion.TitolCanco;
            tablaCanciones.appendChild(cancionElemento);
        });
    }          
});
