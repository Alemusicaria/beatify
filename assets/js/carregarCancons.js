// Array per emmagatzemar les cançons carregades
var canconsCarregades = [];

// Variable per determinar si l'usuari és administrador
var admin = false;

// Verifica si l'administrador ha habilitat la reproducció automàtica
var reproAutoAdmin = localStorage.getItem('reproduccionAutomatica');
if (reproAutoAdmin === "true") {
    admin = true;
} else {
    admin = false;
}

// Obté el valor de la cookie 'Premium' per determinar si l'usuari és premium
var cookieValue = obtenerCookie('Premium');
var premiumUser = false;
if (cookieValue === "1") {
    premiumUser = true;
}

// Funció per saltar les cançons automàticament
function saltarCancons(index) {
    var currentIndex = index;
    var randomImage = $('#random');
    var saltosRealizados = 0;

    var nextSong = document.getElementById('NextSong');
    var afterSong = document.getElementById('AfterSong');

    nextSong.addEventListener('click', function () {
        if (!premiumUser && saltosRealizados >= 3) {
            return;
        }

        currentIndex += 1;
        if (currentIndex >= canconsCarregades.length) {
            currentIndex = 0;
        }
        saltosRealizados++;

        if (randomImage.hasClass('clicked')) {
            window.reproducirCancionAleatoria();
        } else {
            reproducirCancionDesdeIndice(currentIndex);
        }
    });

    afterSong.addEventListener('click', function () {
        currentIndex -= 1;
        if (currentIndex < 0) {
            currentIndex = canconsCarregades.length - 1;
        }

        if (premiumUser || saltosRealizados === 0) {
            if (randomImage.hasClass('clicked')) {
                window.reproducirCancionAleatoria();
            } else {
                reproducirCancionDesdeIndice(currentIndex);
            }
        }
        saltosRealizados--;
    });

    if (!premiumUser || admin === true) {
        randomImage.addClass('clicked');
        randomImage.attr('src', '../img/simbols/crandom.svg');
    }
}

// Inicialització de la funció quan la pàgina està carregada
document.addEventListener('DOMContentLoaded', function () {
    saltarCancons();
});

// Inicialització de la funció quan el document està preparat
$(document).ready(function () {
    // Funció per reproduir una cançó des d'un índex determinat
    window.reproducirCancionDesdeIndice = function (index) {
        $('#reproductor-audio')[0].pause();

        if (index >= 0 && index < canconsCarregades.length) {
            currentIndex = index;

            var selectedSong = canconsCarregades[currentIndex];
            var imgSrc;
            if (selectedSong.Titol_Album) {
                imgSrc = '../musica/portades/' + selectedSong.Titol_Album + '.jpg';
            } else {
                imgSrc = '../musica/portades/' + selectedSong.Titol + '.jpg';
            }
            var songTitle = selectedSong.Titol;

            $('#reproductor-img').attr('src', imgSrc);
            $('#reproductor-title').text(songTitle);
            $('#reproductor-artist').text("");
            $('#reproductor-audio').attr('src', "../musica/mp3/" + songTitle + ".mp3");
            $('#reproductor-audio')[0].play();
        } else {
            reproducirCancionDesdeIndice(0);
        }
    }

    // Gestiona l'event 'ended' per reproduir la següent cançó
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
            try {
                canconsCarregades = JSON.parse(data);
                mostrarCancons(canconsCarregades);
            } catch (error) {
                console.error('Error en analitzar les dades JSON:', error);
            }
        },
        error: function (error) {
            console.log('Error en carregar les cançons:', error);
        }
    });
}

// Funció per mostrar les cançons a la pàgina web
function mostrarCancons(cancons) {
    var taula = $('#taula');
    taula.empty();

    $.each(cancons, function (index, canco) {
        var novaCancoDiv = $('<div class="songs"></div>');
        var imgSrc;

        if (canco.Titol_Album) {
            imgSrc = '../musica/portades/' + canco.Titol_Album + ".jpg";
        } else {
            imgSrc = '../musica/portades/' + canco.Titol + ".jpg";
        }

        novaCancoDiv.append('<img src="' + imgSrc + '" alt="' + canco.Titol + '" class="portada">');
        novaCancoDiv.append('<img src="../img/playImg.png" alt="icon" class="icono">');
        novaCancoDiv.append('<h4>' + canco.Titol + '</h4>');

        var artistas = canco.artistas.map(function (artista) {
            return artista.Nom_Artista;
        }).join(', ');

        novaCancoDiv.append('<p>' + artistas + '</p>');
        taula.append(novaCancoDiv);
    });

    $('.icono').on('click', transferirInformacion);
}

// Funció per transferir informació al reproductor de música
function transferirInformacion(event) {
    var cancoDiv = $(this).closest('.songs');
    var imgSrc = cancoDiv.find('img.portada').attr('src');
    var songTitle = cancoDiv.find('h4').text();
    var artistInfo = cancoDiv.find('p').text();
    var index = $('.songs').index(cancoDiv);

    var reproductorImg = $('#reproductor-img');
    var reproductorTitle = $('#reproductor-title');
    var reproductorArtist = $('#reproductor-artist');
    var reproductorAudio = $('#reproductor-audio');

    reproductorImg.attr('src', imgSrc);
    reproductorTitle.text(songTitle);
    reproductorArtist.text(artistInfo);
    reproductorAudio.attr('src', "../musica/mp3/" + songTitle + ".mp3");
    reproductorAudio[0].play();

    window.reproducirCancionDesdeIndice(index);
    saltarCancons(index);
};

// Funció per gestionar la reproducció aleatòria de les cançons
$(document).ready(function () {
    var randomImage = $('#random');
    randomImage.on('click', function () {
        if (premiumUser === true) {
            if (randomImage.hasClass('clicked')) {
                randomImage.removeClass('clicked');
                randomImage.attr('src', '../img/simbols/random.svg');
            } else {
                window.reproducirCancionAleatoria();
                randomImage.addClass('clicked');
                randomImage.attr('src', '../img/simbols/crandom.svg');
            }
        }
    });

    window.reproducirCancionAleatoria = function () {
        $('#reproductor-audio')[0].pause();
        var randomIndex = Math.floor(Math.random() * canconsCarregades.length);
        reproducirCancionDesdeIndice(randomIndex);
    }
});

// Funció per obtenir el valor d'una cookie
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
