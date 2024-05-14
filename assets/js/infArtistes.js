// Obtenim el nom de l'artista seleccionat emmagatzemat a localStorage
var selectedArtist = localStorage.getItem('selectedArtist');
console.log(selectedArtist);

// Fem una crida AJAX per obtenir la informació de l'artista seleccionat
$.ajax({
    url: '../assets/php/obtainInfArtist.php',
    type: 'POST',
    data: { selectedArtist },
    success: function (response) {
        console.log(response);
        var artista = JSON.parse(response);
        console.log(artista);
        carregarArtista(artista); // Carreguem i mostrem la informació de l'artista
    },
    error: function (error) {
        console.log('Error en obtenir les dades de l\'artista:', error);
    }
});

// Funció per carregar i mostrar la informació de l'artista
function carregarArtista(artista) {
    // Mostrem la imatge, el nom artístic i la informació de l'artista a la interfície
    $('.foto img').attr('src', "../musica/artistes/" + selectedArtist + ".jpg");
    $('.txt h2').text(artista.NomArtistic);
    $('.artista h3').text(artista.Info);
    mostrarInformacionArtista(artista); // Mostrem més informació de l'artista
}

// Funció per mostrar més informació de l'artista, com ara àlbums i cançons
function mostrarInformacionArtista(artista) {
    // Mostrem els àlbums de l'artista a la taula d'àlbums
    var tablaAlbums = document.getElementById("tablaAlbums");
    tablaAlbums.innerHTML = "";
    var albumsYaAgregados = new Set(); // Conjunt per rastrejar àlbums

    // Iterem sobre les cançons de l'artista per obtenir els àlbums
    Object.keys(artista.canciones).forEach(function (key) {
        var cancion = artista.canciones[key];
        cancion.Albums.forEach(function (album) {
            if (album.ID_AlArtista === artista.Artista_ID) { // Comparem ID_AlArtista de l'àlbum amb l'ID de l'artista
                if (!albumsYaAgregados.has(album.TitolAlbum)) {
                    // Creem els elements HTML per a cada àlbum i els afegim a la taula d'àlbums
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

    // Amaguem la taula d'àlbums si no hi ha àlbums
    if (tablaAlbums.children.length === 0) {
        tablaAlbums.style.display = "none";
    } else {
        tablaAlbums.style.display = "block";
    }

    // Mostrem les cançons de l'artista a la taula de cançons
    var tablaCanciones = document.getElementById("tablaCanciones");
    tablaCanciones.innerHTML = "";

    Object.keys(artista.canciones).forEach(function (key) {
        var cancion = artista.canciones[key];

        // Creem els elements HTML per a cada cançó i els afegim a la taula de cançons
        var listSongsDiv = document.createElement("div");
        listSongsDiv.classList.add("listSongs");
        var divPortadaDiv = document.createElement("div");
        divPortadaDiv.classList.add("divPortada");
        var imgPortada = document.createElement("img");
        imgPortada.classList.add("portadaList");
        // Establim la font de la imatge de la portada de la cançó
        if (cancion.Albums.length > 0) {
            imgPortada.src = '../musica/portades/' + cancion.Albums[0].TitolAlbum + ".jpg";
        } else {
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