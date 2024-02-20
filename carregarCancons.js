var canconsCarregades = []; // Array per emmagatzemar les cançons ja carregades

function carregarCancons() {
    $.ajax({
        url: 'conexio.php',
        method: 'GET',
        success: function (data) {
            canconsCarregades = JSON.parse(data); // Emmagatzemar les cançons a nivell local
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
        novaCancoDiv.append('<img src="./musica/portades/' + canco.Img + '" alt="' + canco.Titol + '" class="portada">');
        novaCancoDiv.append('<img src="./img/playImg.png" alt="icon" class="icono">');
        novaCancoDiv.append('<h4>' + canco.Titol + '</h4>');

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

    var reproductorImg = $('#reproductor-img');
    var reproductorTitle = $('#reproductor-title');
    var reproductorArtist = $('#reproductor-artist');
    var reproductorAudio = $('#reproductor-audio');

    reproductorImg.attr('src', imgSrc);
    reproductorTitle.text(songTitle);
    reproductorArtist.text(artistInfo);
    reproductorAudio.attr('src', "./musica/mp3/" + songTitle + ".mp3");
    reproductorAudio[0].play(); // Iniciar la reproducción
}

$(document).ready(function () {
    carregarCancons();
});


document.addEventListener('DOMContentLoaded', function () {
    // Obtén la llista de cançons i el camp de cerca
    const searchInput = document.getElementById('searchInput');

    // Agrega un event de escolta al camp de cerca
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();

        // Filtra les cançons ja carregades
        const canconsFiltrades = canconsCarregades.filter(function (canco) {
            return canco.Titol.toLowerCase().includes(searchTerm);
        });

        // Mostra les cançons filtrades
        mostrarCancons(canconsFiltrades);
    });
});