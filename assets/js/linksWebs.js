$(document).ready(function() {
    $('#crear').click(function() {
        $.ajax({
            url: './components/crearLlista.php',
            type: 'GET',
            success: function(data) {
                $('.contenedor-right').html(data);
            }
        });
    });
});