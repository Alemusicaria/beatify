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
            $('.foto img').attr('src', "../musica/artistes/" + selectedArtist + ".jpg");
        
            $('.txt h2').text(selectedArtist);

            $('.artista h3').text(artista.Info);
        
           
        }
    }
});
