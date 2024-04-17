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
        $('.artista h3').text(artista.Info);
        mostrarInformacionArtista(artista)
    }
    function mostrarInformacionArtista(artista) {
        var tablaAlbums = document.getElementById("tablaAlbums");
        tablaAlbums.innerHTML = "";
        var albumsYaAgregados = new Set(); // Conjunto para rastrear álbumes

        Object.keys(artista.canciones).forEach(function (key) {
            var cancion = artista.canciones[key];
            cancion.Albums.forEach(function (album) {
                if (album.ID_AlArtista === artista.Artista_ID) { // Comparar ID_AlArtista del álbum con ID del artista
                    if (!albumsYaAgregados.has(album.TitolAlbum)) {
                        var listAlbumDiv = document.createElement("div");
                        listAlbumDiv.classList.add("listAlbum");
                        var divPortadaDiv = document.createElement("div");
                        divPortadaDiv.classList.add("divPortada");
                        var imgPortada = document.createElement("img");
                        imgPortada.classList.add("portadaList");
                        imgPortada.src = '../musica/portades/' + album.TitolAlbum + ".jpg";
                        divPortadaDiv.appendChild(imgPortada);
                        var albumParagraph = document.createElement("p");
                        albumParagraph.textContent = album.TitolAlbum;
                        listAlbumDiv.appendChild(divPortadaDiv);
                        listAlbumDiv.appendChild(albumParagraph);
                        tablaAlbums.appendChild(listAlbumDiv);
                        albumsYaAgregados.add(album.TitolAlbum);
                    }
                }
            });
        });
        
        if (tablaAlbums.children.length === 0) {
            tablaAlbums.style.display = "none";
        } else {
        }



        
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
            if(cancion.Albums.length > 0){
                imgPortada.src = '../musica/portades/' + cancion.Albums[0].TitolAlbum + ".jpg";
            }else{
                imgPortada.src = '../musica/portades/' + cancion.TitolCanco + ".jpg";
            }
            
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
