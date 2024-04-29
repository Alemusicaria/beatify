// Definir la función toggleDropdown fuera de $(document).ready()
function toggleDropdown() {
    $('.dropdown-list').toggle();
}

$(document).ready(function () {
    // Mostrar opciones de personalización al hacer clic en el botón
    $('#btn-customize').click(function () {
        $('#customize-options').removeClass('hidden');
    });

    // Guardar personalización al hacer clic en el botón de guardar
    $('#btn-save').click(guardarPersonalizacion);

    // Ocultar la lista desplegable al inicio
    $('.dropdown-list').hide();

    // Ocultar la lista desplegable al hacer clic fuera de ella
    $(document).click(function (e) {
        if (!$(e.target).closest('.perfil-dropdown').length) {
            $('.dropdown-list').hide();
        }
    });
});

// Función para guardar la personalización
function guardarPersonalizacion() {
    const opciones = {
        forma: $('#button-shape').val(),
        color: $('#color-picker').val(),
        fontSize: $('#font-size').val(),
        colorBarraAudio: $('#color-barrraAudio').val()
    };

    document.cookie = `personalizacion=${JSON.stringify(opciones)}; expires=Thu, 01 Jan 2025 00:00:00 UTC; path=/`;

    $('#customize-options').addClass('hidden');
}
