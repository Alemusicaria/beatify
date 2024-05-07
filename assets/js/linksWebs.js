$(document).ready(function () {
    // Función para realizar la llamada AJAX a ./components/inici.php
    function cargarInici() {
        $.ajax({
            url: './components/inici.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    }

    // Llamada inicial al cargar la página
    cargarInici();

    // Evento de clic para el elemento #crear
    $('#crear').click(function () {
        $.ajax({
            url: './components/crearLlista.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });

    // Evento de clic para el elemento #asistencia
    $('#asistencia').click(function () {
        $.ajax({
            url: './components/asistencia.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });

    // Evento de clic para el elemento #inici
    $('#inici').click(function () {
        // Llamar a la función cargarInici en lugar de definir nuevamente la llamada AJAX
        cargarInici();
    });

    // Evento de clic para el elemento #obrirMicro
    $('#obrirMicro').click(function () {
        $.ajax({
            url: './components/obrirMicro.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });

    // Evento de clic para el elemento #obrirMicro
    $('#lletra').click(function () {
        $.ajax({
            url: './components/lletra.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });

    $('#premium').click(function () {
        $.ajax({
            url: './components/premium.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });
    
    $('#pagament').click(function () {
        $.ajax({
            url: './components/pagament.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data);
            }
        });
    });
});
