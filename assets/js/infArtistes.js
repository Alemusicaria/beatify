document.addEventListener('DOMContentLoaded', function () {
    var selectedArtist = localStorage.getItem('selectedArtist');
    console.log(selectedArtist);

    $.ajax({
        url: '../assets/php/obtainInfArtist.php',
        type: 'POST',
        data: { selectedArtist },
        success: function (response) {
            console.log(response);
            let artista = JSON.parse(response);
            carregarArtista(artista);
        },
        error: function (error) {
            console.log('Error en obtener las canciones:', error);
        }
    });
    function carregarArtista(artista) {
        if (selectedArtist) {
            $('.foto img').attr('src', "../musica/artistes/" + selectedArtist + ".jpg");

            $('.txt h2').text(selectedArtist);

            $('.artista h3').text(artista.Info);
        }
        crearTaules(artista);
    }
    function crearTaules(artista) {
        var tablaAlbums = document.getElementById("tablaAlbums");
        tablaAlbums.innerHTML = "";
        artista.canciones.forEach(function (cancion) {
            cancion.Albums.forEach(function (album) {
                var albumElemento = document.createElement("div");
                albumElemento.textContent = album;
                tablaAlbums.appendChild(albumElemento);
            });
        });

        var tablaCanciones = document.getElementById("tablaCanciones");
        tablaCanciones.innerHTML = "";
        artista.canciones.forEach(function (cancion) {
            var cancionElemento = document.createElement("div");
            cancionElemento.textContent = cancion.TitolCanco;
            tablaCanciones.appendChild(cancionElemento);
        });
    }
});
