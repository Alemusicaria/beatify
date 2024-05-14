// Obtenim les dades de la cançó seleccionada emmagatzemades a localStorage
var selectedSong = JSON.parse(localStorage.getItem('selectedSong'));

// Separem els artistes en un array
var artistas = selectedSong.artistInfo;
var artistasArray = artistas.split(", ");

// Comprovem si s'ha seleccionat una cançó
if (selectedSong) {
    // Obtenim les dades de la cançó seleccionada
    var imgSrc = selectedSong.imgSrc;
    var songTitle = selectedSong.title;

    // Mostrem la imatge, el títol i els artistes de la cançó seleccionada a la interfície
    $('.foto img').attr('src', imgSrc);
    $('.txt h2').text(songTitle);

    // Eliminem el contingut anterior de la etiqueta '.artista' abans d'afegir els nous artistes
    $('.artista').empty();

    // Iterem sobre l'array d'artistes i els afegim al DOM
    for (var i = 0; i < artistasArray.length; i++) {
        var nombreArtista = artistasArray[i];
        var $nombreArtistaElement = $('<h3 class="nom-artista">').text(nombreArtista);
        $('.artista').append($nombreArtistaElement);
    }
}

// Afegim un esdeveniment de clic al botó de reproducció
$('.play').on('click', iniciar);

// Funció per iniciar la reproducció de la cançó seleccionada
function iniciar(event) {
    // Obtenim les dades de la cançó seleccionada
    var reproductorImg = $('#reproductor-img');
    var reproductorTitle = $('#reproductor-title');
    var reproductorAudio = $('#reproductor-audio');

    // Actualitzem la imatge, el títol i l'origen de l'àudio del reproductor
    reproductorImg.attr('src', imgSrc);
    reproductorTitle.text(songTitle);
    reproductorAudio.attr('src', "../musica/mp3/" + songTitle + ".mp3");

    // Iniciem la reproducció de l'àudio
    reproductorAudio[0].play();
}

// Enviem l'array d'artistes al servidor mitjançant una crida AJAX
$.ajax({
    url: '../assets/php/obtainSongs.php',
    type: 'POST',
    data: { artistas: artistasArray },
    success: function (response) {
        console.log(response);
        let tCancons = JSON.parse(response);
        carregarCancons(tCancons);
    },
    error: function (error) {
        console.log('Error en obtenir les cançons:', error);
    }
});

// Funció per carregar les cançons a la taula
function carregarCancons(canconsCarregades) {
    taulaCancons(canconsCarregades);
}

// Funció per generar la taula amb les cançons carregades
function taulaCancons(canconsCarregades) {
    var tabla = document.getElementById('tablaCanciones');
    tabla.innerHTML = '';
    let numero = 1;
    canconsCarregades.forEach(function (titulo) {
        // Creem els elements HTML per cada cançó
        var listSongsDiv = document.createElement("div");
        listSongsDiv.classList.add("listSongs");
        var numberPlayDiv = document.createElement("div");
        numberPlayDiv.classList.add("numberPlay");
        var numberParagraph = document.createElement("p");
        numberParagraph.id = "number";
        numberParagraph.textContent = numero;
        numero++;
        var playBlackImg = document.createElement("img");
        playBlackImg.src = "../img/playBlack.png";
        playBlackImg.alt = "icono";
        playBlackImg.classList.add("playBlack");
        numberPlayDiv.appendChild(numberParagraph);
        numberPlayDiv.appendChild(playBlackImg);
        var divPortadaDiv = document.createElement("div");
        divPortadaDiv.classList.add("divPortada");
        var imgPortada = document.createElement("img");
        imgPortada.classList.add("portadaList");
        // Establim la font de la imatge de la portada de la cançó
        if (titulo.TitolAlbum) {
            imgPortada.src = '../musica/portades/' + titulo.TitolAlbum + ".jpg";
        } else {
            imgPortada.src = '../musica/portades/' + titulo.TitolCanco + ".jpg";
        }
        divPortadaDiv.appendChild(imgPortada);
        var divCancoDiv = document.createElement("div");
        divCancoDiv.classList.add("divCanco");
        var h4Element = document.createElement("h4");
        h4Element.textContent = titulo.TitolCanco;
        divCancoDiv.appendChild(h4Element);
        listSongsDiv.appendChild(numberPlayDiv);
        listSongsDiv.appendChild(divPortadaDiv);
        listSongsDiv.appendChild(divCancoDiv);
        tabla.appendChild(listSongsDiv);
    });
    // Afegim un esdeveniment de clic als botons de reproducció de les cançons de la taula
    $('.playBlack').on('click', start);
}

// Funció per iniciar la reproducció d'una cançó de la taula
function start(event) {
    var cancoDiv = $(this).closest('.listSongs');
    var imgSrc = cancoDiv.find('img.portadaList').attr('src');
    var songTitle = cancoDiv.find('h4').text();

    var reproductorImg = $('#reproductor-img');
    var reproductorTitle = $('#reproductor-title');
    var reproductorAudio = $('#reproductor-audio');

    // Actualitzem la imatge, el títol i l'origen de l'àudio del reproductor amb les dades de la cançó seleccionada
    reproductorImg.attr('src', imgSrc);
    reproductorTitle.text(songTitle);
    reproductorAudio.attr('src', "../musica/mp3/" + songTitle + ".mp3");

    // Iniciem la reproducció de l'àudio
    reproductorAudio[0].play();
}
