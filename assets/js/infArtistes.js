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
    function carregarArtista(artista) {
        $('.foto img').attr('src', "../musica/artistes/" + selectedArtist + ".jpg");


        $('.txt h2').text(artista.NomArtistic);

        // Limpiamos el contenido actual de la etiqueta '.artista' antes de agregar los nuevos artistas
        $('.artista h3').text(artista.Info);
        mostrarInformacionArtista(artista)
    }
    function mostrarInformacionArtista(artista) {
        // Mostrar los álbumes
        var tablaAlbums = document.getElementById("tablaAlbums");
        tablaAlbums.innerHTML = "";

        var albumsYaAgregados = new Set(); // Conjunto para rastrear álbumes

        Object.keys(artista.canciones).forEach(function (key) {
            var cancion = artista.canciones[key];
            cancion.Albums.forEach(function (album) {
                if (!albumsYaAgregados.has(album)) {
                    var listAlbumDiv = document.createElement("div");
                    listAlbumDiv.classList.add("listAlbum");
                    var divPortadaDiv = document.createElement("div");
                    divPortadaDiv.classList.add("divPortada");
                    var imgPortada = document.createElement("img");
                    imgPortada.classList.add("portadaList");
                    imgPortada.src = '../musica/portades/' + album + ".jpg";
                    divPortadaDiv.appendChild(imgPortada);
                    var albumParagraph = document.createElement("p");
                    albumParagraph.textContent = album;
                    listAlbumDiv.appendChild(divPortadaDiv);
                    listAlbumDiv.appendChild(albumParagraph);
                    tablaAlbums.appendChild(listAlbumDiv);
                    albumsYaAgregados.add(album);
                }
            });
        });


        // Mostrar las canciones
        var tablaCanciones = document.getElementById("tablaCanciones");
        tablaCanciones.innerHTML = "";

        Object.keys(artista.canciones).forEach(function (key) {
            var cancion = artista.canciones[key];

            var listSongsDiv = document.createElement("div");
            listSongsDiv.classList.add("listSongs");

            var divPortadaDiv = document.createElement("div");
            divPortadaDiv.classList.add("divPortada");
            var imgPortada = document.createElement("img");
            imgPortada.classList.add("portadaList");
            // Si hay un álbum asociado, usamos su nombre para buscar la imagen, de lo contrario, usamos el título de la canción
            imgPortada.src = '../musica/portades/' + (cancion.Albums.length > 0 ? cancion.Albums[0] : cancion.TitolCanco) + ".jpg";
            divPortadaDiv.appendChild(imgPortada);

            var divCancoDiv = document.createElement("div");
            divCancoDiv.classList.add("divCanco");
            var h4Element = document.createElement("h4");
            h4Element.textContent = cancion.TitolCanco;
            divCancoDiv.appendChild(h4Element);

            listSongsDiv.appendChild(divPortadaDiv);
            listSongsDiv.appendChild(divCancoDiv);
            tablaCanciones.appendChild(listSongsDiv);
        });
    }

});
