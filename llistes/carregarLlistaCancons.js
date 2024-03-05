var canconsCarregades = []; // Array per emmagatzemar les cançons ja carregades
// Reproducción de Canciones Automática
$(document).ready(function () {

    window.reproducirCancionDesdeIndice = function(index) {
        // Verificar si el índice está dentro del rango del array
        if (index >= 0 && index < canconsCarregades.length) {
            currentIndex = index;

            // Obtener la información de la canción seleccionada
            var selectedSong = canconsCarregades[currentIndex];
            
            var imgSrc;
            if(selectedSong.Foto_Album){
                imgSrc='../musica/portades/' + selectedSong.Foto_Album;
            }else{
                imgSrc='../musica/portades/' + selectedSong.Img;
            }
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
    }

    // Agregar un evento 'ended' al elemento de audio para detectar el final de la canción
    $('#reproductor-audio').on('ended', function () {
        // Reproducir automáticamente la siguiente canción cuando la actual ha terminado
        reproducirCancionDesdeIndice(currentIndex + 1);
    });

    // Cargar las canciones y comenzar a reproducir la primera
    carregarCancons();
});

function carregarCancons() {
    $.ajax({
        url: 'conexio.php',
        method: 'GET',
        success: function (data) {
            canconsCarregades = JSON.parse(data); // Emmagatzemar les cançons a nivel local
            mostrarCancons(canconsCarregades); // Mostrar totes les cançons inicials
        },
        error: function (error) {
            console.log('Error en carregar les cançons:', error);
        }
    });
}

function mostrarCancons(cancons) {
    var taula = $('#taula');
    taula.empty(); // Netegem la taula abans de mostrar les cançons

    $.each(cancons, function (index, canco) {
        var novaCancoDiv = $('<div class="songs"></div>');
        
        // Utilizar la Foto del Álbum si está disponible
        var imgSrc;
        if (canco.Foto_Album) {
            imgSrc = '../musica/portades/' + canco.Foto_Album;
        } else {
            // Si no hay Foto_Album, utiliza Img si está disponible, de lo contrario, asigna una imagen genérica por defecto
            imgSrc = '../musica/portades/' + canco.Img;
        }        
        novaCancoDiv.append('<img src="' + imgSrc + '" alt="' + canco.Titol + '" class="portada">');
        novaCancoDiv.append('<img src="./img/playImg.png" alt="icon" class="icono">');
        novaCancoDiv.append('<h4>' + canco.Titol + '</h4>');
        novaCancoDiv.append('<p>'+canco.Nom_Artista+'</p>');

        taula.append(novaCancoDiv);
    });

    // Agregar evento de clic a les imatges amb la classe 'icono'
    $('.icono').on('click', transferirInformacion);
}

// Función para transferir información al reproductor de música
function transferirInformacion(event) {
    var cancoDiv = $(this).closest('.songs');
    var imgSrc = cancoDiv.find('img.portada').attr('src');
    var songTitle = cancoDiv.find('h4').text();
    var artistInfo = cancoDiv.find('p').text();

    // Obtener el índice de la canción seleccionada
    var index = $('.songs').index(cancoDiv);

    

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

document.addEventListener('DOMContentLoaded', function () {
    // Obtén la lista de canciones y el campo de búsqueda
    const songList = document.getElementById('taula');
    const searchInput = document.getElementById('searchInput');

    // Agrega un evento de escucha al campo de búsqueda
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();

        // Filtra las canciones basadas en el término de búsqueda
        Array.from(songList.children).forEach(function (song) {
            const songName = song.textContent.toLowerCase();

            if (songName.includes(searchTerm)) {
                song.style.display = 'block'; // Muestra la canción si coincide
            } else {
                song.style.display = 'none'; // Oculta la canción si no coincide
            }
        });
    });
});

