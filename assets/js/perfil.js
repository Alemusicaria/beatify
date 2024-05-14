// Definir la funció toggleDropdown fora de $(document).ready()
function toggleDropdown() {
    $('.dropdown-list').toggle();
}

$(document).ready(function () {
    // Mostrar opcions de personalització en fer clic al botó
    $('#btn-customize').click(function () {
        $('#customize-options').removeClass('hidden');
    });

    // Desar personalització en fer clic al botó de desar
    $('#btn-save').click(guardarPersonalitzacio);

    // Ocultar la llista desplegable a l'inici
    $('.dropdown-list').hide();

    // Ocultar la llista desplegable en fer clic fora d'ella
    $(document).click(function (e) {
        if (!$(e.target).closest('.perfil-dropdown').length) {
            $('.dropdown-list').hide();
        }
    });
});

// Funció per desar la personalització
function guardarPersonalitzacio() {
    // Obté opcions de personalització des dels elements del formulari
    const opcions = {
        forma: $('#button-shape').val(),
        color: $('#color-picker').val(),
        fontSize: $('#font-size').val(),
        colorBarraAudio: $('#color-barrraAudio').val()
    };

    // Desa les opcions de personalització a una cookie amb data de caducitat
    document.cookie = `personalitzacio=${JSON.stringify(opcions)}; expires=Thu, 01 Jan 2025 00:00:00 UTC; path=/`;

    // Oculta les opcions de personalització després de desar
    $('#customize-options').addClass('hidden');
}
