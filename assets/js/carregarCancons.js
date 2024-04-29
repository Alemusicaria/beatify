var canconsCarregades = []; // Array per emmagatzemar les cançons ja carregades
var cookieValue = obtenerCookie('Premium');
var premiumUser =false;
if (cookieValue === "true") {
   premiumUser = true;
}
// Reproducción de Canciones Automática
function saltarCancons(index) {
    var currentIndex = index;
    var randomImage = $('#random');

    var nextSong = document.getElementById('NextSong');
    var afterSong = document.getElementById('AfterSong');
    var limiteSaltarCancons = 0;
    nextSong.addEventListener('click', function () {
        currentIndex += 1;
        if (premiumUser || currentIndex && limiteSaltarCancons<3) {
            limiteSaltarCancons +=1;
            if (randomImage.hasClass('clicked')) {
                window.reproducirCancionAleatoria();
            } else {
                reproducirCancionDesdeIndice(currentIndex);
            }
        } else {
            //alert("¡Debes ser usuario premium para saltar más canciones!");
        }
    });

    afterSong.addEventListener('click', function () {
        currentIndex -= 1;
        if (currentIndex < 0) {
            currentIndex = canconsCarregades.length - 1;
        }
        if (premiumUser || currentIndex ) {
            if (randomImage.hasClass('clicked')) {
                window.reproducirCancionAleatoria();
            } else {
                reproducirCancionDesdeIndice(currentIndex);
            }
        }
    });
}

// Llamada a la función de inicialización cuando la página está lista
document.addEventListener('DOMContentLoaded', function () {
    saltarCancons();
});
$(document).ready(function () {

    window.reproducirCancionDesdeIndice = function (index) {
        // Detener la reproducción actual si hay una
        $('#reproductor-audio')[0].pause();
        // Verificar si el índice está dentro del rango del array
        if (index >= 0 && index < canconsCarregades.length) {
            currentIndex = index;

            // Obtener la información de la canción seleccionada
            var selectedSong = canconsCarregades[currentIndex];


            var imgSrc;
            if (selectedSong.Titol_Album) {
                imgSrc = '../musica/portades/' + selectedSong.Titol_Album + '.jpg';
            } else {
                imgSrc = '../musica/portades/' + selectedSong.Titol + '.jpg';
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

    var randomImage = $('#random');
    // Agregar un evento 'ended' al elemento de audio para detectar el final de la canción
    $('#reproductor-audio').on('ended', function () {
        if (randomImage.hasClass('clicked')) {
            window.reproducirCancionAleatoria();
        } else {
            reproducirCancionDesdeIndice(currentIndex + 1);
        }
    });

    // Cargar las canciones y comenzar a reproducir la primera
    carregarCancons();
});

function carregarCancons() {
    $.ajax({
        url: '../assets/php/conexio.php',
        method: 'GET',
        success: function (data) {
            try {  
                canconsCarregades = JSON.parse(data); // Emmagatzemar les cançons a nivel local
                mostrarCancons(canconsCarregades); // Mostrar totes les cançons inicials
            } catch (error) {
                console.error('Error al analizar los datos JSON:', error);
            }
            
        },
        error: function (error) {
            console.log('Error en carregar les cançons:', error);
        }
    });
}

function mostrarCancons(cancons) {
    var taula = $('#taula');
    taula.empty(); // Limpiar la tabla antes de mostrar las canciones

    $.each(cancons, function (index, canco) {
        var novaCancoDiv = $('<div class="songs"></div>');

        // Utilizar la Foto del Álbum si está disponible
        var imgSrc;
        if (canco.Titol_Album) {
            imgSrc = '../musica/portades/' + canco.Titol_Album +".jpg";
        } else {
            // Si no hay Titol_Album, utilizar Titol si está disponible, de lo contrario, asignar una imagen genérica por defecto
            imgSrc = '../musica/portades/' + canco.Titol +".jpg";
        }
        novaCancoDiv.append('<img src="' + imgSrc + '" alt="' + canco.Titol + '" class="portada">');
        novaCancoDiv.append('<img src="../img/playImg.png" alt="icon" class="icono">');
        novaCancoDiv.append('<h4>' + canco.Titol + '</h4>');

        // Agregar los nombres de los artistas
        var artistas = canco.artistas.map(function(artista) {
            return artista.Nom_Artista;
        }).join(', ');
        novaCancoDiv.append('<p>' + artistas + '</p>');

        taula.append(novaCancoDiv);
    });

    // Agregar evento de clic a las imágenes con la clase 'icono'
    $('.icono').on('click', transferirInformacion);
    $('.portada').on('click', function() {
        var songTitle = $(this).siblings('h4').text();
        var artistInfo = $(this).siblings('p').text();
        var imgSrc = $(this).attr('src'); 
        localStorage.setItem('selectedSong', JSON.stringify({
            title: songTitle,
            artistInfo: artistInfo,
            imgSrc: imgSrc
        }));
        window.location.href = './pageSongs.php';
    });
    
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
    saltarCancons(index);
}

$(document).ready(function () {
    var randomImage = $('#random');
    randomImage.on('click', function () {
        if (randomImage.hasClass('clicked')) {
            randomImage.removeClass('clicked');
            randomImage.attr('src', '../img/simbols/random.svg');
        } else {
            window.reproducirCancionAleatoria();
            randomImage.addClass('clicked');
            randomImage.attr('src', '../img/simbols/crandom.svg');
        }

    });

    window.reproducirCancionAleatoria = function () {
        // Detener la reproducción actual si hay una
        $('#reproductor-audio')[0].pause();
        var randomIndex = Math.floor(Math.random() * canconsCarregades.length);
        reproducirCancionDesdeIndice(randomIndex);
    }


});


document.addEventListener('DOMContentLoaded', function () {
    // Obtén la lista de canciones y el campo de búsqueda
    const songList = document.getElementById('taula');
    const searchInput = document.getElementById('searchInput');

    // Agrega un evento de escucha al campo de búsqueda
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();

        // Filtra las canciones basadas en el término de búsqueda
        Array.from(songList.children).forEach(function (song) {
            const songTitle = song.querySelector('h4').textContent.toLowerCase();
            const artistName = song.querySelector('p').textContent.toLowerCase();

            if (songTitle.includes(searchTerm) || artistName.includes(searchTerm)) {
                song.style.display = 'block'; // Muestra la canción si coincide
            } else {
                song.style.display = 'none'; // Oculta la canción si no coincide
            }
        });
    });
});
function obtenerCookie(nombre) {
    var nombreEQ = nombre + '=';
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(nombreEQ) === 0) {
            return cookie.substring(nombreEQ.length, cookie.length);
        }
    }
    return null;
}