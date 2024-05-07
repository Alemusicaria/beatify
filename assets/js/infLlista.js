var selectedList = JSON.parse(localStorage.getItem('selectedList'));
var idLlista = selectedList.id_Llista;
if (selectedList) {
    var imgSrc = selectedList.img;
    $('.foto img').attr('src', "../musica/portades/" + imgSrc + ".jpg");
    var listTitle = selectedList.nomLlista;
    $('.txt h2').text(listTitle);
    var username = selectedList.id_User;
    $('.artista h3').text(username);
}
$.ajax({
    url: '../assets/php/obtainSongsofList.php',
    type: 'POST',
    data: { idLlista },
    success: function (response) {
        let tCancons = JSON.parse(response);
        console.log(tCancons);
        carregarCancons(tCancons);
    },
    error: function (error) {
        console.log('Error en obtener las canciones:', error);
    }
});
function carregarCancons(canconsCarregades) {
    taulaCancons(canconsCarregades);
}

function taulaCancons(canconsCarregades) {
    var tabla = document.getElementById('tablaCanciones');
    tabla.innerHTML = '';
    let numero = 1;
    canconsCarregades.forEach(function (titulo) {
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
    $('.playBlack').on('click', start);
}
function start(event) {
    var cancoDiv = $(this).closest('.listSongs');
    var imgSrc = cancoDiv.find('img.portadaList').attr('src');
    var songTitle = cancoDiv.find('h4').text();

    var reproductorImg = $('#reproductor-img');
    var reproductorTitle = $('#reproductor-title');
    var reproductorAudio = $('#reproductor-audio');

    reproductorImg.attr('src', imgSrc);
    reproductorTitle.text(songTitle);
    reproductorAudio.attr('src', "../musica/mp3/" + songTitle + ".mp3");
    reproductorAudio[0].play();
}
