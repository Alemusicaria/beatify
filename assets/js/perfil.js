function guardarPersonalizacion() {
    const opciones = {
        forma: document.getElementById('button-shape').value,
        color: document.getElementById('color-picker').value,
        fontSize: document.getElementById('font-size').value,
    };

    document.cookie = `personalizacion=${JSON.stringify(opciones)}; expires=Thu, 01 Jan 2025 00:00:00 UTC; path=/`;

    document.getElementById('customize-options').classList.add('hidden');
  
}

document.getElementById('btn-customize').addEventListener('click', () => {
    document.getElementById('customize-options').classList.remove('hidden');
});

document.getElementById('btn-save').addEventListener('click', guardarPersonalizacion);

// PERFIL
$(document).ready(function () {
    $('.dropdown-list').hide();

});
function toggleDropdown() {
    $('.dropdown-list').toggle();
}

$(document).on('click', function (e) {
    if (!$(e.target).closest('.perfil-dropdown').length) {
        $('.dropdown-list').hide();
    }
});