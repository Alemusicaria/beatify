document.addEventListener('DOMContentLoaded', function () {
    var selectedArtist = localStorage.getItem('selectedArtist');
    console.log(selectedArtist);

    $.ajax({
        url: '../assets/php/obtainInfArtist.php',
        type: 'POST',
        data: { selectedArtist },
        success: function (response) {
            console.log(response);
            let artista = JSON.parse(response);
            carregarArtista(artista);
        },
        error: function (error) {
            console.log('Error en obtener las canciones:', error);
        }
    });
    function carregarArtista(artista) {
        if (selectedArtist) {
            $('.foto img').attr('src', "../musica/artista/" + selectedArtist + ".jpg");
        
            $('.txt h2').text(selectedArtist);
            
            // Limpiamos el contenido actual de la etiqueta '.artista' antes de agregar los nuevos artistas
            $('.artista').empty();
        
            // Iteramos sobre el array de artistas y los agregamos al DOM
            for (var i = 0; i < artistasArray.length; i++) {
                var nombreArtista = artistasArray[i];
                var $nombreArtistaElement = $('<h3 class="nom-artista">').text(nombreArtista);
                $('.artista').append($nombreArtistaElement);
            }
        }
    }
});
