function guardarPersonalizacion() {
    const opciones = {
        forma: document.getElementById('button-shape').value,
        color: document.getElementById('color-picker').value,
        fontSize: document.getElementById('font-size').value,
    };

    document.cookie = `personalizacion=${JSON.stringify(opciones)}; expires=Thu, 01 Jan 2030 00:00:00 UTC; path=/`;

    document.getElementById('customize-options').classList.add('hidden');
    aplicarPersonalizacion(); // Llama a la función para aplicar la personalización después de guardar
}

function cargarPersonalizacion() {
    const cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('personalizacion='));

    if (cookieValue) {
        return JSON.parse(cookieValue.split('=')[1]);
    }

    return null;
}

function aplicarPersonalizacion() {
    const opciones = cargarPersonalizacion();

    if (opciones) {
        const botones = document.querySelectorAll('button');

        botones.forEach(boton => {
            boton.style.borderRadius = opciones.forma === 'rounded' ? '10px' : '0';
            boton.style.backgroundColor = opciones.color;
            boton.style.fontSize = opciones.fontSize === 'small' ? '12px' :
                opciones.fontSize === 'medium' ? '16px' : '20px';
        });
    }
}

document.getElementById('btn-customize').addEventListener('click', () => {
    document.getElementById('customize-options').classList.remove('hidden');
});

document.getElementById('btn-save').addEventListener('click', guardarPersonalizacion);

window.addEventListener('load', aplicarPersonalizacion);
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