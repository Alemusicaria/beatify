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
            carregarArtista(artista);
        },
        error: function (error) {
            console.log('Error en obtener las canciones:', error);
        }
    });
    function carregarArtista(artista){
        $('.foto img').attr('src', "../musica/artista/" + selectedArtist + ".jpg");
    
        
        $('.txt h2').text(artista.NomArtistic);
        
        // Limpiamos el contenido actual de la etiqueta '.artista' antes de agregar los nuevos artistas
        $('.artista').empty(artista.Info);
        mostrarInformacionArtista(artista)
    }
    function mostrarInformacionArtista(artista) {
        // Mostrar los álbumes
        var tablaAlbums = document.getElementById("tablaAlbums");
        tablaAlbums.innerHTML = "";
        console.log("Álbumes:");
        console.log(artista.canciones); // Verifiquemos que artista.canciones es un objeto
    
        // Iterar sobre las claves del objeto artista.canciones
        Object.keys(artista.canciones).forEach(function(key) {
            var cancion = artista.canciones[key]; 
            cancion.Albums.forEach(function(album) { 
                var albumElemento = document.createElement("div");
                albumElemento.textContent = album;
                tablaAlbums.appendChild(albumElemento);
            });
        });
    
        // Mostrar las canciones
        var tablaCanciones = document.getElementById("tablaCanciones");
        tablaCanciones.innerHTML = "";
        Object.keys(artista.canciones).forEach(function(key) {
            var cancion = artista.canciones[key];
            var cancionElemento = document.createElement("div");
            cancionElemento.textContent = cancion.TitolCanco;
            tablaCanciones.appendChild(cancionElemento);
        });
    }          
});
