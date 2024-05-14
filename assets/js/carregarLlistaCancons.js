var canconsCarregades = []; // Array per emmagatzemar les cançons ja carregades

$(document).ready(function () {
    // Funció per reproduir una cançó des d'un índex determinat
    window.reproducirCancionDesdeIndice = function (index) {
        // Detener la reproducción actual si hay una
        $('#reproductor-audio')[0].pause();

        // Verificar si l'índex està dins del rang de l'array
        if (index >= 0 && index < canconsCarregades.length) {
            currentIndex = index;

            // Obté la informació de la cançó seleccionada
            var selectedSong = canconsCarregades[currentIndex];

            var imgSrc;
            if (selectedSong.Titol_Album) {
                imgSrc = '../musica/portades/' + selectedSong.Titol_Album + '.jpg';
            } else {
                imgSrc = '../musica/portades/' + selectedSong.Titol + '.jpg';
            }
            var songTitle = selectedSong.Titol;

            // Actualitza la informació del reproductor de música
            $('#reproductor-img').attr('src', imgSrc);
            $('#reproductor-title').text(songTitle);
            $('#reproductor-artist').text(""); // Pots afegir informació de l'artista si és necessari
            $('#reproductor-audio').attr('src', "../musica/mp3/" + songTitle + ".mp3");

            // Reprodueix la cançó seleccionada
            $('#reproductor-audio')[0].play();
        } else {
            // Si l'índex està fora del rang, torna al principi de l'array
            reproducirCancionDesdeIndice(0);
        }
    }

    var randomImage = $('#random');
    // Afegeix un esdeveniment 'ended' a l'element d'àudio per detectar el final de la cançó
    $('#reproductor-audio').on('ended', function () {
        if (randomImage.hasClass('clicked')) {
            window.reproducirCancionAleatoria();
        } else {
            reproducirCancionDesdeIndice(currentIndex + 1);
        }
    });

    // Carrega les cançons i comença a reproduir la primera
    carregarCancons();
});

// Funció per carregar les cançons des del servidor
function carregarCancons() {
    $.ajax({
        url: '../assets/php/conexio.php',
        method: 'GET',
        success: function (data) {
            canconsCarregades = JSON.parse(data); // Emmagatzema les cançons a nivell local
            mostrarCancons(canconsCarregades); // Mostra totes les cançons inicials
        },
        error: function (error) {
            console.log('Error en carregar les cançons:', error);
        }
    });
}

// Funció per mostrar les cançons a la pàgina web
function mostrarCancons(cancons) {
    var taula = $('#taula');
    taula.empty(); // Netega la taula abans de mostrar les cançons

    $.each(cancons, function (index, canco) {
        var novaCancoDiv = $('<div class="songs"></div>');

        // Utilitza la Foto de l'Àlbum si està disponible
        var imgSrc;
        if (canco.Titol_Album) {
            imgSrc = '../musica/portades/' + canco.Titol_Album + ".jpg";
        } else {
            // Si no hi ha Titol_Album, utilitza Titol si està disponible, sinó, assigna una imatge genèrica per defecte
            imgSrc = '../musica/portades/' + canco.Titol + ".jpg";
        }
        novaCancoDiv.append('<img src="' + imgSrc + '" alt="' + canco.Titol + '" class="portada">');
        novaCancoDiv.append('<img src="../img/mas.png" alt="icon" class="icono">');
        novaCancoDiv.append('<h4>' + canco.Titol + '</h4>');
        novaCancoDiv.append('<h5 style="display: none;">' + canco.ID_Canco + '</h5>');

        // Afegeix els noms dels artistes
        var artistas = canco.artistas.map(function (artista) {
            return artista.Nom_Artista;
        }).join(', ');
        novaCancoDiv.append('<p>' + artistas + '</p>');

        taula.append(novaCancoDiv);
    });

    // Afegeix esdeveniment de clic a les imatges amb la classe 'icono'
    $('.icono').on('click', afegirCancoLlista);
}

// Funció per afegir una cançó a la llista seleccionada
function afegirCancoLlista(event) {
    // Obté l'ID de la cançó des de l'element clicat
    var cancoID = $(this).siblings('h5').text(); // Suposant que el títol de la cançó conté l'ID

    // Crea un objecte FormData per enviar les dades al servidor
    var formData = new FormData();
    formData.append('cancoID', cancoID);

    $.ajax({
        type: 'POST',
        url: '../assets/php/guardar_canco_llista.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            // Netega el contingut anterior en cas que hi hagi
            $('#llistaSeleccionades').empty();

            // Recorre totes les cançons i les mostra al div
            $.each(response, function (index, canco) {
                $('#llistaSeleccionades').append('<div class="songs">' + canco.Titol + '</div>');
                // Aquí pots afegir més informació si és necessari, com el nom de l'artista, etc.
            });
        },
        error: function (error) {
            console.log('Error en guardar la cançó a la llista:', error.responseText); // Imprimeix el text de resposta de l'error
        }
    });
}

$(document).ready(function () {
    // Obté la llista de cançons i el camp de cerca
    const songList = document.getElementById('taula');
    const searchInput = document.getElementById('searchInput');
    // Afegeix un esdeveniment d'escolta al camp de cerca
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();

        // Filtra les cançons basades en el terme de cerca
        Array.from(songList.children).forEach(function (song) {
            const songTitle = song.querySelector('h4').textContent.toLowerCase();
            const artistName = song.querySelector('p').textContent.toLowerCase();

            if (songTitle.includes(searchTerm) || artistName.includes(searchTerm)) {
                song.style.display = 'block'; // Mostra la cançó si coincideix
            } else {
                song.style.display = 'none'; // Oculta la cançó si no coincideix
            }
        });
    });
});
