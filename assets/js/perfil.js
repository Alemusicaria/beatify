// Funció per desar la personalització
function guardarPersonalizacion() {
    const opciones = {
        forma: document.getElementById('button-shape').value,
        color: document.getElementById('color-picker').value,
        fontSize: document.getElementById('font-size').value,
    };

    document.cookie = `personalizacion=${JSON.stringify(opciones)}; expires=Thu, 01 Jan 2025 00:00:00 UTC; path=/`;

    document.getElementById('customize-options').classList.add('hidden');
}

// Mostra les opcions de personalització quan es fa clic
document.getElementById('btn-customize').addEventListener('click', () => {
    document.getElementById('customize-options').classList.remove('hidden');
});

// Quan el botó de desar es fa clic, executa la funció per desar la personalització
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btn-save').addEventListener('click', guardarPersonalizacion);

    // Amaga la llista desplegable al començament
    $('.dropdown-list').hide();
});

// Funció per alternar la visualització de la llista desplegable
function toggleDropdown() {
    $('.dropdown-list').toggle();
}

// Amaga la llista desplegable quan es fa clic fora d'ella
$(document).on('click', function (e) {
    if (!$(e.target).closest('.perfil-dropdown').length) {
        $('.dropdown-list').hide();
    }
});
