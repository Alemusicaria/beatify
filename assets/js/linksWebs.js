$(document).ready(function () {
    $.ajax({
        url: './components/inici.php',
        type: 'GET',
        success: function (data) {
            $('.contenedor-right').html(data);
        }
    });

    $('#crear').click(function () {
        $.ajax({
            url: './components/crearLlista.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });

    $('#asistencia').click(function () {
        $.ajax({
            url: './components/asistencia.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });

    $('#inici').click(function () {
        $.ajax({
            url: './components/inici.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });
});