document.addEventListener('DOMContentLoaded', function () {
    var selectedSong = JSON.parse(localStorage.getItem('selectedSong'));
    var artistas = selectedSong.artistInfo;
    var artistasArray = artistas.split(", ");
    if (selectedSong) {
        var imgSrc = selectedSong.imgSrc;
        $('.foto img').attr('src', imgSrc);


        var songTitle = selectedSong.title;
        var artistInfo = selectedSong.artistInfo;
        $('.txt h2').text(songTitle);
        $('.artista h3').text(artistInfo);
    }
    $('.play').on('click', transferirInformacion);
    // Envío del array hacia el php
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
        $('.playBlack').on('click', transferirInformacion);
    }

});
