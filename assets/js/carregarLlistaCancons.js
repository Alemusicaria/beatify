var canconsCarregades = []; // Array para almacenar las canciones ya cargadas

// Reproducción de Canciones Automática
$(document).ready(function () {
    window.reproducirCancionDesdeIndice = function (index) {
        // Verificar si el índice está dentro del rango del array
        if (index >= 0 && index < canconsCarregades.length) {
            var selectedSong = canconsCarregades[index];
            var imgSrc = obtenerRutaImagen(selectedSong);
            var songTitle = selectedSong.Titol;

            // Actualizar la información del reproductor de música
            $('#reproductor-img').attr('src', imgSrc);
            $('#reproductor-title').text(songTitle);
            $('#reproductor-artist').text(""); // Puedes agregar información del artista si es necesario
            $('#reproductor-audio').attr('src', "../musica/mp3/" + songTitle + ".mp3");

            // Reproducir la canción seleccionada
            $('#reproductor-audio')[0].play();
        } else {
            // Si el índice está fuera del rango, volver al principio del array
            reproducirCancionDesdeIndice(0);
        }
    };

    // Agregar un evento 'ended' al elemento de audio para detectar el final de la canción
    $('#reproductor-audio').on('ended', function () {
        var nextIndex = currentIndex + 1;
        if (nextIndex < canconsCarregades.length) {
            reproducirCancionDesdeIndice(nextIndex);
        } else {
            // Si no hay más canciones, detener la reproducción o realizar otra acción según sea necesario
        }
    });

    // Cargar las canciones y comenzar a reproducir la primera
    carregarCancons();
});

// Función para cargar las canciones
function carregarCancons() {
    $.ajax({
        url: '../assets/php/conexio.php',
        method: 'GET',
        success: function (data) {
            canconsCarregades = JSON.parse(data); // Almacenar las canciones localmente
            mostrarCancons(canconsCarregades); // Mostrar todas las canciones iniciales
        },
        error: function (error) {
            console.error('Error al cargar las canciones:', error);
            // Manejar el error de manera apropiada, como mostrar un mensaje al usuario
        }
    });
}

// Función para mostrar las canciones en la página
function mostrarCancons(cancons) {
    var taula = $('#taula');
    taula.empty(); // Limpiar la tabla antes de mostrar las canciones

    $.each(cancons, function (index, canco) {
        var novaCancoDiv = $('<div class="songs"></div>');
        var imgSrc = obtenerRutaImagen(canco);

        novaCancoDiv.append('<img src="' + imgSrc + '" alt="' + canco.Titol + '" class="portada">');
        novaCancoDiv.append('<img src="../img/mas.png" alt="icon" class="icono">');
        novaCancoDiv.append('<h4>' + canco.Titol + '</h4>');
        novaCancoDiv.append('<p>' + (canco.Nom_Artista || '') + '</p>');

        taula.append(novaCancoDiv);
    });
    
    // Agregar evento de clic a les imatges amb la classe 'icono'

    // Agregar evento de clic a las imágenes con la clase 'icono'
    $('.icono').on('click', transferirInformacion);
}

// Función para transferir información al reproductor de música
function transferirInformacion(event) {
    var cancoDiv = $(this).closest('.songs');
    var index = $('.songs').index(cancoDiv);
    var selectedSong = canconsCarregades[index];
    var imgSrc = obtenerRutaImagen(selectedSong);
    var songTitle = selectedSong.Titol;
    var artistInfo = selectedSong.Nom_Artista || '';

    var reproductorImg = $('#reproductor-img');
    var reproductorTitle = $('#reproductor-title');
    var reproductorArtist = $('#reproductor-artist');
    var reproductorAudio = $('#reproductor-audio');

    reproductorImg.attr('src', imgSrc);
    reproductorTitle.text(songTitle);
    reproductorArtist.text(artistInfo);
    reproductorAudio.attr('src', "../musica/mp3/" + songTitle + ".mp3");
    reproductorAudio[0].play(); // Iniciar la reproducción

    // Llamar a la función para reproducir desde el índice seleccionado
    window.reproducirCancionDesdeIndice(index);
}

// Función para obtener la ruta de la imagen de una canción
function obtenerRutaImagen(song) {
    return song.Foto_Album ? '../musica/portades/' + song.Foto_Album : '../musica/portades/' + song.Img;
}
