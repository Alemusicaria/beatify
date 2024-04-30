var canconsCarregades = []; // Array per emmagatzemar les cançons ja carregades
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
    taula.empty(); // Limpiar la tabla antes de mostrar las canciones

    $.each(cancons, function (index, canco) {
        var novaCancoDiv = $('<div class="songs"></div>');

        // Utilizar la Foto del Álbum si está disponible
        var imgSrc;
        if (canco.Titol_Album) {
            imgSrc = '../musica/portades/' + canco.Titol_Album + ".jpg";
        } else {
            // Si no hay Titol_Album, utilizar Titol si está disponible, de lo contrario, asignar una imagen genérica por defecto
            imgSrc = '../musica/portades/' + canco.Titol + ".jpg";
        }
        novaCancoDiv.append('<img src="' + imgSrc + '" alt="' + canco.Titol + '" class="portada">');
        novaCancoDiv.append('<img src="../img/mas.png" alt="icon" class="icono">');
        novaCancoDiv.append('<h4>' + canco.Titol + '</h4>');
        novaCancoDiv.append('<h5 style="display: none;">' + canco.ID_Canco + '</h5>');

        // Agregar los nombres de los artistas
        var artistas = canco.artistas.map(function (artista) {
            return artista.Nom_Artista;
        }).join(', ');
        novaCancoDiv.append('<p>' + artistas + '</p>');

        taula.append(novaCancoDiv);
    });

    // Agregar evento de clic a las imágenes con la clase 'icono'
    $('.icono').on('click', afegirCancoLlista);
}

function afegirCancoLlista(event) {
    // Obtener el ID de la canción desde el elemento clicado
    var cancoID = $(this).siblings('h5').text(); // Suponiendo que el título de la canción contiene el ID

    // Crear un objeto FormData para enviar los datos al servidor
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
            // Limpiar el contenido anterior en caso de que haya
            $('#llistaSeleccionades').empty();

            // Recorrer todas las canciones y mostrarlas en el div
            $.each(response, function (index, canco) {
                $('#llistaSeleccionades').append('<div class="songs">' + canco.Titol + '</div>');
                // Aquí puedes agregar más información si es necesario, como el nombre del artista, etc.
            });
        },
        error: function (error) {
            console.log('Error en guardar la canción en la lista:', error.responseText); // Imprime el texto de respuesta del error
        }
    });
}


// Obtén la lista de canciones y el campo de búsqueda
const songList = document.getElementById('taula');
const searchInput = document.getElementById('searchInput');
console.log(searchInput);
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

