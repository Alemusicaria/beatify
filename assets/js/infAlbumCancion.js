document.addEventListener('DOMContentLoaded', function () {
    var selectedSong = JSON.parse(localStorage.getItem('selectedSong'));
    var artistas = selectedSong.artistInfo;
    var artistasArray = artistas.split(", ");
    if (selectedSong) {
        var imgSrc = selectedSong.imgSrc;
        $('.foto img').attr('src', imgSrc);

        // También puedes acceder a selectedSong.title y selectedSong.artistInfo
        var songTitle = selectedSong.title;
        var artistInfo = selectedSong.artistInfo;
        // Usa songTitle y artistInfo para establecer el título y la información del artista en tu div
        $('.txt h2').text(songTitle);
        $('.artista h3').text(artistInfo);
    }
    $('.play').on('click', iniciar);
    function iniciar(event) {
        var reproductorImg = $('#reproductor-img');
        var reproductorTitle = $('#reproductor-title');
        var reproductorArtist = $('#reproductor-artist');
        var reproductorAudio = $('#reproductor-audio');

        reproductorImg.attr('src', imgSrc);
        reproductorTitle.text(songTitle);
        reproductorArtist.text(artistInfo);
        reproductorAudio.attr('src', "../musica/mp3/" + songTitle + ".mp3");
        reproductorAudio[0].play();

    }
    //envio del array hacia el php
    $.ajax({
        url: '../assets/php/obtainSongs.php',
        type: 'POST',
        data: { artistas: artistasArray },
        success: function (response) {
            console.log(response); // Handle server response here
            taulaCancons(response);
        }
    });
    
    function taulaCancons(canconsCarregades) {
        var tabla = document.getElementById('tablaCanciones');
        tabla.innerHTML = '';
    
        canconsCarregades.forEach(function (titulo) { // Iterate over song titles directly
            var fila = document.createElement('tr');
    
            var tituloCancion = document.createElement('td');
            tituloCancion.textContent = titulo; // Use song title directly
    
            fila.appendChild(tituloCancion);
            tabla.appendChild(fila);
        });
    }


});


