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
            console.log(artista); // Agregar este console.log para depurar
            mostrarInformacionArtista(artista);
        },
        error: function (error) {
            console.log('Error en obtener las canciones:', error);
        }
    });
    function mostrarInformacionArtista(artista) {
        var tablaAlbums = document.getElementById("tablaAlbums");
        tablaAlbums.innerHTML = "";
        artista.canciones.forEach(function(cancion) {
            cancion.Albums.forEach(function(album) {
                var albumElemento = document.createElement("div");
                albumElemento.textContent = album;
                tablaAlbums.appendChild(albumElemento);
            });
        });
    
        
        var tablaCanciones = document.getElementById("tablaCanciones");
        tablaCanciones.innerHTML = "";
        artista.canciones.forEach(function(cancion) {
            var cancionElemento = document.createElement("div");
            cancionElemento.textContent = cancion.TitolCanco;
            tablaCanciones.appendChild(cancionElemento);
        });
    }
});
