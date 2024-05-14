// S'obté la informació de la llista seleccionada des de la memòria local del navegador
var selectedList = JSON.parse(localStorage.getItem('selectedList'));

// Es guarda l'identificador de la llista
var idLlista = selectedList.id_Llista;

// Si s'ha trobat una llista seleccionada, es carreguen les seves dades a la pàgina
if (selectedList) {
    // S'obté la ruta de la imatge de la llista i s'assigna a l'element d'imatge corresponent
    var imgSrc = selectedList.img;
    $('.foto img').attr('src', "../musica/portades/" + imgSrc + ".jpg");

    // S'obté el títol de la llista i s'assigna a l'element de text corresponent
    var listTitle = selectedList.nomLlista;
    $('.txt h2').text(listTitle);

    // S'obté el nom d'usuari del creador de la llista i s'assigna a l'element de text corresponent
    var username = selectedList.id_User;
    $('.artista h3').text(username);
}

// Es realitza una sol·licitud AJAX per obtenir les cançons de la llista seleccionada
$.ajax({
    url: '../assets/php/obtainSongsofList.php',
    type: 'POST',
    data: { idLlista },
    success: function (response) {
        // Les dades de les cançons es converteixen de JSON a un objecte JavaScript
        let tCancons = JSON.parse(response);
        console.log(tCancons);

        // Es crida a la funció per carregar les cançons a la pàgina
        carregarCancons(tCancons);
    },
    error: function (error) {
        console.log('Error en obtenir les cançons:', error);
    }
});

// Funció per carregar les cançons a la taula de la pàgina
function carregarCancons(canconsCarregades) {
    taulaCancons(canconsCarregades);
}

// Funció per crear la taula de les cançons
function taulaCancons(canconsCarregades) {
    // S'obté l'element de la taula
    var tabla = document.getElementById('tablaCanciones');
    tabla.innerHTML = '';

    // S'inicialitza un comptador per al número de cançons
    let numero = 1;

    // Es recorre la llista de cançons carregades per afegir-les a la taula
    canconsCarregades.forEach(function (titulo) {
        // Es creen els elements HTML per a cada cançó
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

    // S'afegeix un esdeveniment d'escolta als botons de reproducció
    $('.playBlack').on('click', start);
}

// Funció per iniciar la reproducció d'una cançó
function start(event) {
    // S'obté el div de la cançó seleccionada
    var cancoDiv = $(this).closest('.listSongs');

    // S'obté la ruta de la imatge de la cançó i el títol de la cançó
    var imgSrc = cancoDiv.find('img.portadaList').attr('src');
    var songTitle = cancoDiv.find('h4').text();

    // S'actualitzen els elements del reproductor amb la informació de la cançó seleccionada
    var reproductorImg = $('#reproductor-img');
    var reproductorTitle = $('#reproductor-title');
    var reproductorAudio = $('#reproductor-audio');

    reproductorImg.attr('src', imgSrc);
    reproductorTitle.text(songTitle);
    reproductorAudio.attr('src', "../musica/mp3/" + songTitle + ".mp3");

    // Es reprodueix la cançó
    reproductorAudio[0].play();
}
